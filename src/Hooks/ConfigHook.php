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
        $data['hook'] = [
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
}
