<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Version
    |--------------------------------------------------------------------------
    |
    |
    */
    'version'=>'1.0.0',
    /*
    |--------------------------------------------------------------------------
    | Name
    |--------------------------------------------------------------------------
    |
    |
    */
    'default'=> [
        'hookList'=>[
            's_manage_menu'=>['name'=>'s_manage_menu', 'description'=>'管理中心菜单']
        ],
        'hookInject'=>[
            's_manage_menu'=>[
                [
                    'hook_name' => 's_manage_menu',
                    'files' => 'vendor/huasituo/hook/src/Hooks',
                    'class' => 'ConfigHook',
                    'function' => 'getManageMenu',
                ]
            ]
        ]
    ]
];
