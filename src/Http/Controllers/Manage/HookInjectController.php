<?php 

namespace Huasituo\Hook\Http\Controllers\Manage;

use Huasituo\Hstcms\Http\Controllers\Manage\BasicController;
use Huasituo\Hook\Model\HookModel;
use Huasituo\Hook\Model\HookInjectModel;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class HookInjectController extends BasicController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($hook_name, Request $request)
    {
        $this->navs = [
            'return'=>['name'=>hst_lang('hstcms::public.go.back'), 'url'=>route('manageHookIndex')],
            'index'=>['name'=>hst_lang('hook::public.kook.inject'), 'url'=>route('manageHookInjectIndex', ['name'=>$hook_name])],
            'add'=>['name'=>hst_lang('hook::public.kook.add.inject'), 'url'=>route('manageHookInjectAdd', ['name'=>$hook_name]), 'title'=>hst_lang('hook::public.kook.add.inject'), 'class'=>'J_dialog']
        ];
        $hook = HookModel::where('name', $hook_name)->first();
        $list = HookInjectModel::where('hook_name', $hook_name)->get()->toArray();
        $view = [
            'hook_name'=>$hook_name,
            'list'=>$list,
            'info'=>$hook,
            'navs'=>$this->getNavs('index')
        ];
    	return $this->loadTemplate('hook::manage.inject_index', $view);
    }

    public function add($hook_name, Request $request)
    {
        if(!$hook_name) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hook::public.hook.empty');
        }
        $view = [
            'hook_name'=>$hook_name
        ];
        return $this->loadTemplate('hook::manage.inject_add', $view);
    }

    public function addSave($hook_name, Request $request)
    {
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hook::public.hook.empty');
        }

        $validator = Validator::make($request->all(), [
            'alias' => 'required',
            'files' => 'required',
            'class' => 'required',
            'fun' => 'required'
        ],[
            'alias.required'=>hst_lang('hook::public.alias.empty'),
            'files.required'=>hst_lang('hook::public.files.empty'),
            'class.required'=>hst_lang('hook::public.class.empty'),
            'fun.required'=>hst_lang('hook::public.fun.empty'),
        ]);

        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $hookInject = HookInjectModel::where('hook_name', trim($hook_name))->where('alias', $request->get('alias'))->first();
        if($hookInject) {
            return $this->showError('hook::public.hook.inject.noone');
        }
        HookInjectModel::addInfo(trim($hook_name), trim($request->get('alias')), trim($request->get('files')), trim($request->get('class')), trim($request->get('fun')), trim($request->get('description')));

        $this->addOperationLog(hst_lang('hook::public.kook.add.inject').':'.trim($hook_name).trim($request->get('alias')), '', ['hook_name'=>trim($hook_name), 'alias'=>trim($request->get('alias')), 'files'=>trim($request->get('files')), 'description'=>trim($request->get('description')), 'class'=>trim($request->get('class')), 'fun'=>trim($request->get('fun'))], array());
        return $this->showMessage('hstcms::public.add.success'); 
    }

    public function edit($hook_name, $id)
    {
        if(!$hook_name || !$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hook::public.hook.empty');
        }
        $hookInject = HookInjectModel::where('hook_name', $hook_name)->where('id', $id)->first();
        if(!$hookInject) {
            return $this->showError('hook::public.no.inject');
        }
        $view = [
            'hook_name'=> $hook_name,
            'id'=> $id,
            'info'=> $hookInject,
        ];
        return $this->loadTemplate('hook::manage.inject_edit', $view);
    }

    public function editSave($hook_name, Request $request)
    {
        $id = $request->get('id');
        if(!$hook_name || !$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hook::public.hook.empty');
        }
        $hookInject = HookInjectModel::where('hook_name', $hook_name)->where('id', $id)->first();
        if(!$hookInject) {
            return $this->showError('hook::public.no.inject');
        }


        $validator = Validator::make($request->all(), [
            'alias' => 'required',
            'files' => 'required',
            'class' => 'required',
            'fun' => 'required'
        ],[
            'alias.required'=>hst_lang('hook::public.alias.empty'),
            'files.required'=>hst_lang('hook::public.files.empty'),
            'class.required'=>hst_lang('hook::public.class.empty'),
            'fun.required'=>hst_lang('hook::public.fun.empty'),
        ]);

        if ($validator->fails()) {
            return $this->showError($validator->errors(), 2);
        }
        $hookInject = HookInjectModel::where('hook_name', trim($hook_name))->where('alias', $request->get('alias'))->first();
        if($hookInject && $hookInject['id'] != $id) {
            return $this->showError('hook::public.hook.inject.noone');
        }

        HookInjectModel::editInfo($id, trim($hook_name), trim($request->get('alias')), trim($request->get('files')), trim($request->get('class')), trim($request->get('fun')), trim($request->get('description')));
        $this->addOperationLog(hst_lang('hook::public.kook.edit.inject').':'.$hook_name.trim($request->get('alias')), '', ['hook_name'=>trim($hook_name), 'alias'=>trim($request->get('alias')), 'files'=>trim($request->get('files')), 'description'=>trim($request->get('description')), 'class'=>trim($request->get('class')), 'fun'=>trim($request->get('fun'))], $hookInject->toArray());
        return $this->showMessage('hstcms::public.edit.success'); 
    }

    public function delete($hook_name, $id)
    {
        if(!$hook_name || !$id) {
            return $this->showError('hstcms::public.no.id');
        }
        $hook = HookModel::where('name', $hook_name)->first();
        if(!$hook) {
            return $this->showError('hook::public.hook.empty');
        }
        $hookInject = HookInjectModel::where('hook_name', $hook_name)->where('id', $id)->first();
        if(!$hookInject) {
            return $this->showError('hook::public.no.inject');
        }
        HookInjectModel::del('id', $id);
        $this->addOperationLog(hst_lang('hook::public.kook.delete.inject').':'.$hook_name.$hookInject['alias'], '', array(), $hookInject->toArray());
        return $this->showMessage('hstcms::public.delete.success'); 
    }
}

