<?php 

namespace Huasituo\Hook\Http\Controllers\Manage;

use Huasituo\Hstcms\Http\Controllers\Manage\BasicController;
use Huasituo\Hook\Model\HookModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class HookController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
        $this->navs = [
            'index'=>['name'=>hst_lang('hook::public.hook'), 'url'=>'manageHookIndex'],
            'add'=>['name'=>hst_lang('hook::public.hook.add'), 'url'=>'manageHookAdd', 'class'=>'J_dialog', 'title'=>hst_lang('hook::public.hook.add')],
            'cache'=>['name'=>hst_lang('hstcms::public.update.cache'), 'url'=>'manageHookCache']
        ];
    }

    public function index(Request $request)
    {
        $list = HookModel::getAll(1);
        $view = [
            'list'=>$list,
            'navs'=>$this->getNavs('index')
        ];
    	return $this->loadTemplate('hook::manage.index', $view);
    }

    public function add(Request $request)
    {
        return $this->loadTemplate('hook::manage.add');
    }

    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'document' => 'required'
        ],[
            'name.required'=>hst_lang('hook::public.name.empty'),
            'document.required'=>hst_lang('hook::public.document.empty')
        ]);

        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $hook = HookModel::where('name', trim($request->get('name')))->first();
        if($hook) {
            return $this->showError('hook::public.name.noone');
        }
        HookModel::addInfo(trim($request->get('name')), trim($request->get('description')), trim($request->get('document')));
        $this->addOperationLog(hst_lang('hook::public.hook.add').':'.trim($request->get('name')), '', ['name'=>trim($request->get('name')), 'description'=>trim($request->get('description')), 'document'=>trim($request->get('document'))], array());
        return $this->showMessage('hstcms::public.add.success'); 
    }

    public function edit($name)
    {
        if(!$name) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $name)->first();
        if(!$hook) {
            return $this->showError('hstcms::public.no.data');
        }
        $view = [
            'name'=> $name,
            'info'=> $hook,
        ];
        return $this->loadTemplate('hook::manage.edit', $view);
    }

    public function editSave(Request $request)
    {
        $name = $request->get('name');
        if(!$name) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $name)->first();
        if(!$hook) {
            return $this->showError('hstcms::public.no.data');
        }
        $validator = Validator::make($request->all(), [
            'document' => 'required'
        ],[
            'document.required'=>hst_lang('hook::public.document.empty')
        ]);
        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }

        HookModel::editInfo(trim($request->get('name')), trim($request->get('description')), trim($request->get('document')));
        $this->addOperationLog(hst_lang('hook::public.hook.edit').':'.$hook['name'], '', ['name'=>trim($request->get('name')), 'description'=>trim($request->get('description')), 'document'=>trim($request->get('document'))], $hook->toArray());
        return $this->showMessage('hstcms::public.edit.success'); 
    }

    public function delete($name)
    {
        if(!$name) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $name)->first();
        if(!$hook) {
            return $this->showError('hstcms::public.no.data');
        }
        HookModel::del(trim($name));
        $this->addOperationLog(hst_lang('hook::public.hook.delete').':'.$name, '', array(), $hook->toArray());
        return $this->showMessage('hstcms::public.delete.success'); 
    }

    public function cache() {
        HookModel::setCache();
        $this->addOperationLog(hst_lang('hook::public.hook.cache'));
        return $this->showMessage('hstcms::public.successful', 'manageHookIndex', 1); 
    }
}

