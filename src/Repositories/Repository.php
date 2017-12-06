<?php

namespace Huasituo\Hook\Repositories;

use Huasituo\Hook\Model\HookInjectModel;

use Huasituo\Hook\Contracts\Repository as RepositoryContract;
use Cache;

class Repository implements RepositoryContract
{

	/**
	 * List of all hooks set in config/hooks.php
	 *
	 * @var	array
	 */
	protected $hooks =	array();

	/**
	 * Array with class objects to use hooks methods
	 *
	 * @var array
	 */
	protected $_objects = array();

	/**
	 * In progress flag
	 *
	 * Determines whether hook is in progress, used to prevent infinte loops
	 *
	 * @var	bool
	 */
	protected $_in_progress = FALSE;

	protected $returns =	array();
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
	    $cacheName = 'hookInject';
	    if (!Cache::has(md5($cacheName))) {
	        $hook = HookInjectModel::setAllCache();
	    } else {
	        $hook = Cache::get(md5($cacheName));
	    }
		$this->hooks =& $hook;
	}

	public function call_hook($which = '', $params = array(), $isreturn = FALSE) 
	{
		if ( ! isset($this->hooks[$which])) {
			if($isreturn) {
				return $params;
			}
			return FALSE;
		}

		if (is_array($this->hooks[$which]) && ! isset($this->hooks[$which]['function'])) {
			foreach ($this->hooks[$which] as $key=>$val)
			{
				$this->_run_hook($val, $which, $params, $isreturn);
			}
		} else {
			$this->_run_hook($this->hooks[$which], $which, $params, $isreturn);
		}
		if($isreturn) {
			return isset($this->returns[$which]) ? $this->returns[$which] : '';
		}
		return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Run Hook
	 *
	 * Runs a particular hook
	 *
	 * @param	array	$data	Hook details
	 * @return	bool	TRUE on success or FALSE on failure
	 */
	protected function _run_hook($data, $which = '', $params = array())
	{
		if (is_callable($data)) {
			is_array($data) ? $data[0]->{$data[1]}() : $data();
			return TRUE;
		} elseif ( ! is_array($data)) {
			return FALSE;
		}

		if ($this->_in_progress === TRUE) {
			return;
		}
		if(!isset($data['files']) || !$data['files']) {
			$data['files'] = 'vendor/huasituo/hook/src/Hooks';
		}
		if ( !isset($data['files']) ) {
			return false;
		}
		$hookClass = self::hook_class($data['files'], $data['class']);
		$class		= empty($data['class']) ? FALSE : $data['class'];
		$function	= empty($data['fun']) ? FALSE : $data['fun'];
		if ($class === FALSE AND $function === FALSE) {
			return false;
		}
		$_params		= '';
		if (isset($data['params']) && !$params) {
			$_params = $data['params'];
		}  else  {
			$_params = $params;
		}
        //echo 44;
		$this->_in_progress = TRUE;

		if(isset($this->returns[$which]))
		{
			$_params = $this->returns[$which];
		}
		if ($class !== FALSE) {
			// The object is stored?
			if (isset($this->_objects[$class])) {
				if (method_exists($this->_objects[$class], $function)) {
					$hook_return = $this->_objects[$class]->$function($_params);
				} else {
					return $this->_in_progress = FALSE;
				}
			} else {
				class_exists($class, FALSE) OR require base_path($hookClass . '.php');
				if ( ! class_exists($class, FALSE) OR ! method_exists($class, $function)) {
					return $this->_in_progress = FALSE;
				}
				$this->_objects[$class] = new $class();
				$hook_return = $this->_objects[$class]->$function($_params);
			}
		} else {
			class_exists($class, FALSE) OR require base_path($hookClass . '.php');
			if ( ! function_exists($function)) {
				return $this->_in_progress = FALSE;
			}
			$hook_return = $function($_params);
		}
		$this->returns[$which] = $hook_return;
		$this->_in_progress = FALSE;
		return TRUE;
	}
    
    /**
     * Return the full path to the given  class.
     *
     * @param  string  $class
     * @return string
     */
    protected function hook_class($namespace, $class)
    {
        return "{$namespace}/{$class}";
    }
}
