<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//后台路由
Route::group([
    'domain'=> config('hstcms.manage.route.domain'),
    'prefix' => config('hstcms.manage.route.prefix'),
    'middleware'=>['web','manage.checkauth', 'manage.request.log']
], function() {
    // //菜单
    // Route::get('/menu/nav', 'Manage\MenuController@nav')->name('manageMenuNav');
    // Route::get('/menu/nav/add', 'Manage\MenuController@navAdd')->name('manageMenuNavAdd');
    // Route::post('/menu/nav/add/save', 'Manage\MenuController@navAddSave')->name('manageMenuNavAddSave');
    // Route::get('/menu/nav/edit/{id}', 'Manage\MenuController@navEdit')->name('manageMenuNavEdit');
    // Route::post('/menu/nav/edit/save', 'Manage\MenuController@navEditSave')->name('manageMenuNavEditSave');
    // Route::post('/menu/nav/delete/{id}', 'Manage\MenuController@navDelete')->name('manageMenuNavDelete');
    //权限点
    Route::get('/hook/role', 'Manage\MenuController@role')->name('manageMenuRole');
    Route::get('/hook/role/add', 'Manage\MenuController@roleAdd')->name('manageMenuRoleAdd');
    Route::post('/hook/role/add/save', 'Manage\MenuController@roleAddSave')->name('manageMenuRoleAddSave');
    Route::get('/hook/role/edit/{id}', 'Manage\MenuController@roleEdit')->name('manageMenuRoleEdit');
    Route::post('/hook/role/edit/save', 'Manage\MenuController@roleEditSave')->name('manageMenuRoleEditSave');
    Route::post('/hook/role/delete/{id}', 'Manage\MenuController@roleDelete')->name('manageMenuRoleDelete');
});


