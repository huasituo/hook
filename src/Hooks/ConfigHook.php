<?php 

class ConfigHook
{
    /**
     * 后台菜单钩子
     *
     * @param array $data 菜单数组
     * @return array
     */
    function getManageMenu($data)
    {
        $data['manageHookIndex'] = [
            'name' => 'Hook',
            'ename' => 'manageHookIndex',
            'icon' => '',
            'url' => 'manageHookIndex',
            'parent' => 'system',
            'parents' => 'tool',
            'level' => 3,
            'module' => 'manage'
        ];
        return $data;
    }

    /**
     * 后台权限点
     *
     * @param array $data 数组
     * @return array
     */
    function getCommonRoleUri($data)
    {
        $data['manageHookIndex'] = [
            'name' => hst_lang('hstcms::public.manage'),
            'remark' => 'HOOK',
            'ename' => 'manageHookIndex',
            'uri' => 'hook',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookAdd'] = [
            'name' => hst_lang('hstcms::public.add'),
            'remark' => 'HOOK',
            'ename' => 'manageHookAdd',
            'uri' => 'hook/add',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookAddSave'] = [
            'name' => hst_lang('hstcms::public.add', 'hstcms::public.save'),
            'remark' => 'HOOK',
            'ename' => 'manageHookAddSave',
            'uri' => 'hook/add/save',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookEdit'] = [
            'name' => hst_lang('hstcms::public.edit'),
            'remark' => 'HOOK',
            'ename' => 'manageHookEdit',
            'uri' => 'hook/edit/{name}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookEditSave'] = [
            'name' => hst_lang('hstcms::public.edit', 'hstcms::public.save'),
            'remark' => 'HOOK',
            'ename' => 'manageHookEditSave',
            'uri' => 'hook/edit/save',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookDelete'] = [
            'name' => hst_lang('hstcms::public.delete'),
            'remark' => 'HOOK',
            'ename' => 'manageHookDelete',
            'uri' => 'hook/delete/{name}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookCache'] = [
            'name' => hst_lang('hstcms::public.cache'),
            'remark' => 'HOOK',
            'ename' => 'manageHookCache',
            'uri' => 'hook/cache',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];

        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.manage'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.add'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}/add',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.add', 'hstcms::public.save'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}/add/save',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.edit'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}/edit/{id}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectIndex'] = [
            'name' => hst_lang('hstcms::public.edit', 'hstcms::public.save'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectIndex',
            'uri' => 'hook/inject/{name}/edit/save',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        $data['manageHookInjectDelete'] = [
            'name' => hst_lang('hstcms::public.delete'),
            'remark' => 'Hook Inject',
            'ename' => 'manageHookInjectDelete',
            'uri' => 'hook/inject/{name}/delete/{id}',
            'parent' => 'manageHookIndex',
            'module' => 'manage'
        ];
        return $data;
    }
}
