<?php



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



use Illuminate\Support\Facades\Artisan;



Route::get('config-clear', function () {

    Artisan::call('cache:clear');

    Artisan::call('route:clear');

    Artisan::call('config:clear');



    dd("Cache is cleared");

});





Auth::routes();



//Route::get('/', 'HomeController@index')->name('home');



Route::group(['middleware' => 'auth'], function () {



    Route::get('logout', 'Auth\LoginController@logout');



    //    Dashboard

    Route::get('/', [

        'uses' => 'DashboardController@index',

        'as' => 'dashboard'

    ]);



    //    profile

    Route::get('/profile', [

        'uses' => 'ProfileController@index',

        'as' => 'profile'

    ]);



    Route::post('/profile/update/{id}', [

        'uses' => 'ProfileController@update',

        'as' => 'profile.update'

    ]);



    Route::get('/profile/deletecv', [

        'uses' => 'ProfileController@deletecv',

        'as' => 'profile.deletecv'

    ]);



    Route::post('/profile/uploadcv', [

        'uses' => 'ProfileController@uploadcv',

        'as' => 'profile.uploadcv'

    ]);





    //    User

    Route::get('/user', [

        'uses' => 'UsersController@index',

        'as' => 'user'

    ])->middleware('user.module_show');



    Route::get('/user/create', [

        'uses' => 'UsersController@create',

        'as' => 'user.create'

    ])->middleware('user.create');



    Route::post('/user/store', [

        'uses' => 'UsersController@store',

        'as' => 'user.store'

    ])->middleware('user.create');





    Route::get('/user/edit/{id}', [

        'uses' => 'UsersController@edit',

        'as' => 'user.edit'

    ])->middleware('user.edit');



    Route::post('/user/update/{id}', [

        'uses' => 'UsersController@update',

        'as' => 'user.update'

    ])->middleware('user.edit');



    Route::get('/user/show/{id}', [

        'uses' => 'UsersController@show',

        'as' => 'user.show'

    ]);



    Route::get('/user/destroy/{id}', [

        'uses' => 'UsersController@destroy',

        'as' => 'user.destroy'

    ])->middleware('user.delete');



    Route::get('/user/trashed', [

        'uses' => 'UsersController@trashed',

        'as' => 'user.trashed'

    ])->middleware('user.trash_show');



    Route::post('/user/trashed/show', [

        'uses' => 'UsersController@trashedShow',

        'as' => 'user.trashed.show'

    ]);





    Route::get('/user/restore/{id}', [

        'uses' => 'UsersController@restore',

        'as' => 'user.restore'

    ])->middleware('user.restore');



    Route::get('/user/kill/{id}', [

        'uses' => 'UsersController@kill',

        'as' => 'user.kill'

    ])->middleware('user.permanently_delete');



    Route::get('/user/active/search', [

        'uses' => 'UsersController@activeSearch',

        'as' => 'user.active.search'

    ]);



    Route::get('/user/trashed/search', [

        'uses' => 'UsersController@trashedSearch',

        'as' => 'user.trashed.search'

    ]);



    Route::get('/user/active/action', [

        'uses' => 'UsersController@activeAction',

        'as' => 'user.active.action'

    ]);



    Route::get('/user/trashed/action', [

        'uses' => 'UsersController@trashedAction',

        'as' => 'user.trashed.action'

    ]);





    Route::post('users/password', [

        'uses' => 'ProfileController@changePassword',

        'as' => 'users.password'

    ]);



    Route::get('/user/active/usertype', [

        'uses' => 'UsersController@userType',

        'as' => 'user.active.usertype'

    ]);



    Route::get('/user/userdetails/{id}', [

        'uses' => 'UsersController@userdetails',

        'as' => 'user.userdetails'

    ]);

    



    //    User End









//    Project

    Route::get('/project', [

        'uses' => 'ProjectsController@index',

        'as' => 'project'

    ])->middleware('project.module_show');



    Route::get('/project/create', [

        'uses' => 'ProjectsController@create',

        'as' => 'project.create'

    ])->middleware('project.create');



    Route::post('/project/store', [

        'uses' => 'ProjectsController@store',

        'as' => 'project.store'

    ])->middleware('project.create');





    Route::get('/project/edit/{id}', [

        'uses' => 'ProjectsController@edit',

        'as' => 'project.edit'

    ])->middleware('project.edit');



    Route::post('/project/update/{id}', [

        'uses' => 'ProjectsController@update',

        'as' => 'project.update'

    ])->middleware('project.edit');



    Route::get('/project/show/{id}', [

        'uses' => 'ProjectsController@show',

        'as' => 'project.show'

    ]);



    Route::get('/project/destroy/{id}', [

        'uses' => 'ProjectsController@destroy',

        'as' => 'project.destroy'

    ])->middleware('project.delete');



    Route::get('/project/trashed', [

        'uses' => 'ProjectsController@trashed',

        'as' => 'project.trashed'

    ])->middleware('project.trash_show');



    Route::post('/project/trashed/show', [

        'uses' => 'ProjectsController@trashedShow',

        'as' => 'project.trashed.show'

    ]);





    Route::get('/project/restore/{id}', [

        'uses' => 'ProjectsController@restore',

        'as' => 'project.restore'

    ])->middleware('project.restore');



    Route::get('/project/kill/{id}', [

        'uses' => 'ProjectsController@kill',

        'as' => 'project.kill'

    ])->middleware('project.permanently_delete');



    Route::get('/project/active/search', [

        'uses' => 'ProjectsController@activeSearch',

        'as' => 'project.active.search'

    ]);



    Route::get('/project/trashed/search', [

        'uses' => 'ProjectsController@trashedSearch',

        'as' => 'project.trashed.search'

    ]);



    Route::get('/project/active/action', [

        'uses' => 'ProjectsController@activeAction',

        'as' => 'project.active.action'

    ]);



    Route::get('/project/trashed/action', [

        'uses' => 'ProjectsController@trashedAction',

        'as' => 'project.trashed.action'

    ]);

    Route::get('/project/update_status/{id}/{status}/{type?}', [

        'uses' => 'ProjectsController@update_status',

        'as' => 'project.update_status'

    ]);

    

    //end project



    //    Activity

    Route::get('/activity', [

        'uses' => 'ActivitysController@index',

        'as' => 'activity'

    ])->middleware('activity.module_show');



    Route::get('/activity/create', [

        'uses' => 'ActivitysController@create',

        'as' => 'activity.create'

    ])->middleware('activity.create');



    Route::post('/activity/store', [

        'uses' => 'ActivitysController@store',

        'as' => 'activity.store'

    ])->middleware('activity.create');





    Route::get('/activity/edit/{id}', [

        'uses' => 'ActivitysController@edit',

        'as' => 'activity.edit'

    ])->middleware('activity.edit');



    Route::post('/activity/update/{id}', [

        'uses' => 'ActivitysController@update',

        'as' => 'activity.update'

    ])->middleware('activity.edit');



  

    Route::get('/activity/update_status/{id}/{status}', [

        'uses' => 'ActivitysController@update_status',

        'as' => 'activity.update_status'

    ]);

    



    Route::get('/activity/show/{id}', [

        'uses' => 'ActivitysController@show',

        'as' => 'activity.show'

    ]);



    Route::get('/activity/destroy/{id}', [

        'uses' => 'ActivitysController@destroy',

        'as' => 'activity.destroy'

    ])->middleware('activity.delete');



    Route::get('/activity/trashed', [

        'uses' => 'ActivitysController@trashed',

        'as' => 'activity.trashed'

    ])->middleware('activity.trash_show');



    Route::post('/activity/trashed/show', [

        'uses' => 'ActivitysController@trashedShow',

        'as' => 'activity.trashed.show'

    ]);





    Route::get('/activity/restore/{id}', [

        'uses' => 'ActivitysController@restore',

        'as' => 'activity.restore'

    ])->middleware('activity.restore');



    Route::get('/activity/kill/{id}', [

        'uses' => 'ActivitysController@kill',

        'as' => 'activity.kill'

    ])->middleware('activity.permanently_delete');



    Route::get('/activity/active/search', [

        'uses' => 'ActivitysController@activeSearch',

        'as' => 'activity.active.search'

    ]);



    Route::get('/activity/trashed/search', [

        'uses' => 'ActivitysController@trashedSearch',

        'as' => 'activity.trashed.search'

    ]);



    Route::get('/activity/active/action', [

        'uses' => 'ActivitysController@activeAction',

        'as' => 'activity.active.action'

    ]);



    Route::get('/activity/trashed/action', [

        'uses' => 'ActivitysController@trashedAction',

        'as' => 'activity.trashed.action'

    ]);

    

    Route::post('/activity/get_activity_to_department', [

        'uses' => 'ActivitysController@get_activity_to_department',

        'as' => 'activity.get_activity_to_department'            

    ]);

    //end activity



    //    Cost_item

    Route::get('/cost_item', [

        'uses' => 'CostItemsController@index',

        'as' => 'cost_item'

    ])->middleware('cost_item.module_show');



    Route::get('/cost_item/create', [

        'uses' => 'CostItemsController@create',

        'as' => 'cost_item.create'

    ])->middleware('cost_item.create');



    Route::post('/cost_item/store', [

        'uses' => 'CostItemsController@store',

        'as' => 'cost_item.store'

    ])->middleware('cost_item.create');





    Route::get('/cost_item/edit/{id}', [

        'uses' => 'CostItemsController@edit',

        'as' => 'cost_item.edit'

    ])->middleware('cost_item.edit');



    Route::post('/cost_item/update/{id}', [

        'uses' => 'CostItemsController@update',

        'as' => 'cost_item.update'

    ])->middleware('cost_item.edit');



    Route::get('/cost_item/show/{id}', [

        'uses' => 'CostItemsController@show',

        'as' => 'cost_item.show'

    ]);



    Route::get('/cost_item/destroy/{id}', [

        'uses' => 'CostItemsController@destroy',

        'as' => 'cost_item.destroy'

    ])->middleware('cost_item.delete');



    Route::get('/cost_item/trashed', [

        'uses' => 'CostItemsController@trashed',

        'as' => 'cost_item.trashed'

    ])->middleware('cost_item.trash_show');



    Route::post('/cost_item/trashed/show', [

        'uses' => 'CostItemsController@trashedShow',

        'as' => 'cost_item.trashed.show'

    ]);





    Route::get('/cost_item/restore/{id}', [

        'uses' => 'CostItemsController@restore',

        'as' => 'cost_item.restore'

    ])->middleware('cost_item.restore');



    Route::get('/cost_item/kill/{id}', [

        'uses' => 'CostItemsController@kill',

        'as' => 'cost_item.kill'

    ])->middleware('cost_item.permanently_delete');



    Route::get('/cost_item/active/search', [

        'uses' => 'CostItemsController@activeSearch',

        'as' => 'cost_item.active.search'

    ]);



    Route::get('/cost_item/trashed/search', [

        'uses' => 'CostItemsController@trashedSearch',

        'as' => 'cost_item.trashed.search'

    ]);



    Route::get('/cost_item/active/action', [

        'uses' => 'CostItemsController@activeAction',

        'as' => 'cost_item.active.action'

    ]);



    Route::get('/cost_item/trashed/action', [

        'uses' => 'CostItemsController@trashedAction',

        'as' => 'cost_item.trashed.action'

    ]);



    Route::post('/cost_item/get_sub_activity', [

        'uses' => 'CostItemsController@get_sub_activity',

        'as' => 'cost_item.get_sub_activity'            

    ]);

    Route::get('/cost_item/update_status/{id}/{status}', [

        'uses' => 'CostItemsController@update_status',

        'as' => 'cost_item.update_status'

    ]);

    

    //end Cost_item

    //start Reallocation

    Route::get('/reallocation', [

        'uses' => 'ReallocationController@index',

        'as' => 'reallocation'

    ]);

    Route::get('/reallocation/create', [

        'uses' => 'ReallocationController@create',

        'as' => 'reallocation.create'

    ]);

    Route::post('/reallocation/store', [

        'uses' => 'ReallocationController@store',

        'as' => 'reallocation.store'

    ])->middleware('department.create');

    

    //    department start

    Route::get('/department', [

        'uses' => 'DepartmentController@index',

        'as' => 'department'

    ])->middleware('department.module_show');



    Route::get('/department/create', [

        'uses' => 'DepartmentController@create',

        'as' => 'department.create'

    ])->middleware('department.create');



    Route::post('/department/store', [

        'uses' => 'DepartmentController@store',

        'as' => 'department.store'

    ])->middleware('department.create');





    Route::get('/department/edit/{id}', [

        'uses' => 'DepartmentController@edit',

        'as' => 'department.edit'

    ])->middleware('department.edit');



    Route::post('/department/update/{id}', [

        'uses' => 'DepartmentController@update',

        'as' => 'department.update'

    ])->middleware('department.edit');



    Route::get('/department/show/{id}', [

        'uses' => 'DepartmentController@show',

        'as' => 'department.show'

    ]);



    Route::get('/department/destroy/{id}', [

        'uses' => 'DepartmentController@destroy',

        'as' => 'department.destroy'

    ])->middleware('department.delete');



    Route::get('/department/trashed', [

        'uses' => 'DepartmentController@trashed',

        'as' => 'department.trashed'

    ])->middleware('department.trash_show');



    Route::post('/department/trashed/show', [

        'uses' => 'DepartmentController@trashedShow',

        'as' => 'department.trashed.show'

    ]);





    Route::get('/department/restore/{id}', [

        'uses' => 'DepartmentController@restore',

        'as' => 'department.restore'

    ])->middleware('department.restore');



    Route::get('/department/kill/{id}', [

        'uses' => 'DepartmentController@kill',

        'as' => 'department.kill'

    ])->middleware('department.permanently_delete');



    Route::get('/department/active/search', [

        'uses' => 'DepartmentController@activeSearch',

        'as' => 'department.active.search'

    ]);



    Route::get('/department/trashed/search', [

        'uses' => 'DepartmentController@trashedSearch',

        'as' => 'department.trashed.search'

    ]);



    Route::get('/department/active/action', [

        'uses' => 'DepartmentController@activeAction',

        'as' => 'department.active.action'

    ]);



    Route::get('/department/trashed/action', [

        'uses' => 'DepartmentController@trashedAction',

        'as' => 'department.trashed.action'

    ]);





    //    Department End





    //    department start

    Route::get('/departmentnew', [

        'uses' => 'DepartmentController@index',

        'as' => 'departmentnew'

    ])->middleware('departmentnew.module_show');



    Route::get('/departmentnew/create', [

        'uses' => 'DepartmentController@create',

        'as' => 'departmentnew.create'

    ])->middleware('departmentnew.create');



    Route::post('/departmentnew/store', [

        'uses' => 'DepartmentController@store',

        'as' => 'departmentnew.store'

    ])->middleware('departmentnew.create');





    Route::get('/departmentnew/edit/{id}', [

        'uses' => 'DepartmentController@edit',

        'as' => 'departmentnew.edit'

    ])->middleware('departmentnew.edit');



    Route::post('/departmentnew/update/{id}', [

        'uses' => 'DepartmentController@update',

        'as' => 'departmentnew.update'

    ])->middleware('departmentnew.edit');



    Route::get('/departmentnew/show/{id}', [

        'uses' => 'DepartmentController@show',

        'as' => 'departmentnew.show'

    ]);



    Route::get('/departmentnew/destroy/{id}', [

        'uses' => 'DepartmentController@destroy',

        'as' => 'departmentnew.destroy'

    ])->middleware('departmentnew.delete');



    Route::get('/departmentnew/trashed', [

        'uses' => 'DepartmentController@trashed',

        'as' => 'departmentnew.trashed'

    ])->middleware('departmentnew.trash_show');



    Route::post('/departmentnew/trashed/show', [

        'uses' => 'DepartmentController@trashedShow',

        'as' => 'departmentnew.trashed.show'

    ]);





    Route::get('/departmentnew/restore/{id}', [

        'uses' => 'DepartmentController@restore',

        'as' => 'departmentnew.restore'

    ])->middleware('departmentnew.restore');



    Route::get('/departmentnew/kill/{id}', [

        'uses' => 'DepartmentController@kill',

        'as' => 'departmentnew.kill'

    ])->middleware('departmentnew.permanently_delete');



    Route::get('/departmentnew/active/search', [

        'uses' => 'DepartmentController@activeSearch',

        'as' => 'departmentnew.active.search'

    ]);



    Route::get('/departmentnew/trashed/search', [

        'uses' => 'DepartmentController@trashedSearch',

        'as' => 'departmentnew.trashed.search'

    ]);



    Route::get('/departmentnew/active/action', [

        'uses' => 'DepartmentController@activeAction',

        'as' => 'departmentnew.active.action'

    ]);



    Route::get('/departmentnew/trashed/action', [

        'uses' => 'DepartmentController@trashedAction',

        'as' => 'departmentnew.trashed.action'

    ]);







    //    departmentnew End



    //   project Approval start

    Route::get('/project_approval', [

        'uses' => 'ProjectApprovalController@index',

        'as' => 'project_approval'

    ])->middleware('project_approval.module_show');



    Route::get('/project_approval/create', [

        'uses' => 'ProjectApprovalController@create',

        'as' => 'project_approval.create'

    ])->middleware('project_approval.create');



    Route::post('/project_approval/store', [

        'uses' => 'ProjectApprovalController@store',

        'as' => 'project_approval.store'

    ])->middleware('project_approval.create');



    Route::get('/project_approval/edit/{id}', [

        'uses' => 'ProjectApprovalController@edit',

        'as' => 'project_approval.edit'

    ])->middleware('project_approval.edit');



    Route::post('/project_approval/update/{id}', [

        'uses' => 'ProjectApprovalController@update',

        'as' => 'project_approval.update'

    ])->middleware('project_approval.edit');



    Route::get('/project_approval/show/{id}', [

        'uses' => 'ProjectApprovalController@show',

        'as' => 'project_approval.show'

    ]);



    Route::get('/project_approval/destroy/{id}', [

        'uses' => 'ProjectApprovalController@destroy',

        'as' => 'project_approval.destroy'

    ])->middleware('project_approval.delete');



    Route::get('/project_approval/trashed', [

        'uses' => 'ProjectApprovalController@trashed',

        'as' => 'project_approval.trashed'

    ])->middleware('project_approval.trash_show');



    Route::post('/project_approval/trashed/show', [

        'uses' => 'ProjectApprovalController@trashedShow',

        'as' => 'project_approval.trashed.show'

    ]);



    Route::get('/project_approval/restore/{id}', [

        'uses' => 'ProjectApprovalController@restore',

        'as' => 'project_approval.restore'

    ])->middleware('project_approval.restore');



    Route::get('/project_approval/kill/{id}', [

        'uses' => 'ProjectApprovalController@kill',

        'as' => 'project_approval.kill'

    ])->middleware('project_approval.permanently_delete');



    Route::get('/project_approval/active/search', [

        'uses' => 'ProjectApprovalController@activeSearch',

        'as' => 'project_approval.active.search'

    ]);



    Route::get('/project_approval/trashed/search', [

        'uses' => 'ProjectApprovalController@trashedSearch',

        'as' => 'project_approval.trashed.search'

    ]);



    Route::get('/project_approval/active/action', [

        'uses' => 'ProjectApprovalController@activeAction',

        'as' => 'project_approval.active.action'

    ]);



    Route::get('/project_approval/trashed/action', [

        'uses' => 'ProjectApprovalController@trashedAction',

        'as' => 'project_approval.trashed.action'

    ]);

    //    project approval End



    //   reallcoation Approval start

    Route::get('/reallocation_approval', [

        'uses' => 'ReallocationApprovalController@index',

        'as' => 'reallocation_approval'

    ])->middleware('reallocation_approval.module_show');



    Route::get('/reallocation_approval/create', [

        'uses' => 'ReallocationApprovalController@create',

        'as' => 'reallocation_approval.create'

    ])->middleware('reallocation_approval.create');



    Route::post('/reallocation_approval/store', [

        'uses' => 'ReallocationApprovalController@store',

        'as' => 'reallocation_approval.store'

    ])->middleware('reallocation_approval.create');



    Route::get('/reallocation_approval/edit/{id}', [

        'uses' => 'ReallocationApprovalController@edit',

        'as' => 'reallocation_approval.edit'

    ])->middleware('reallocation_approval.edit');



    Route::post('/reallocation_approval/update/{id}', [

        'uses' => 'ReallocationApprovalController@update',

        'as' => 'reallocation_approval.update'

    ])->middleware('reallocation_approval.edit');



    Route::get('/reallocation_approval/show/{id}', [

        'uses' => 'ReallocationApprovalController@show',

        'as' => 'reallocation_approval.show'

    ]);



    Route::get('/reallocation_approval/destroy/{id}', [

        'uses' => 'ReallocationApprovalController@destroy',

        'as' => 'reallocation_approval.destroy'

    ])->middleware('reallocation_approval.delete');



    Route::get('/reallocation_approval/trashed', [

        'uses' => 'ReallocationApprovalController@trashed',

        'as' => 'reallocation_approval.trashed'

    ])->middleware('reallocation_approval.trash_show');



    Route::post('/reallocation_approval/trashed/show', [

        'uses' => 'ReallocationApprovalController@trashedShow',

        'as' => 'reallocation_approval.trashed.show'

    ]);



    Route::get('/reallocation_approval/restore/{id}', [

        'uses' => 'ReallocationApprovalController@restore',

        'as' => 'reallocation_approval.restore'

    ])->middleware('reallocation_approval.restore');



    Route::get('/reallocation_approval/kill/{id}', [

        'uses' => 'ReallocationApprovalController@kill',

        'as' => 'reallocation_approval.kill'

    ])->middleware('reallocation_approval.permanently_delete');



    Route::get('/reallocation_approval/active/search', [

        'uses' => 'ReallocationApprovalController@activeSearch',

        'as' => 'reallocation_approval.active.search'

    ]);



    Route::get('/reallocation_approval/trashed/search', [

        'uses' => 'ReallocationApprovalController@trashedSearch',

        'as' => 'reallocation_approval.trashed.search'

    ]);



    Route::get('/reallocation_approval/active/action', [

        'uses' => 'ReallocationApprovalController@activeAction',

        'as' => 'reallocation_approval.active.action'

    ]);



    Route::get('/reallocation_approval/trashed/action', [

        'uses' => 'ReallocationApprovalController@trashedAction',

        'as' => 'reallocation_approval.trashed.action'

    ]);

    //    reallcoation approval End



    //    Settings



    Route::get('/settings/general', [
        'uses' => 'SettingsController@general_show',
        'as' => 'settings.general'
    ])->middleware('settings.all');

    Route::post('/settings/general/update', [
        'uses' => 'SettingsController@general_update',
        'as' => 'settings.general.update'
    ]);

    Route::get('/settings/system', [
        'uses' => 'SettingsController@system_show',
        'as' => 'settings.system'
    ])->middleware('settings.show');

    Route::post('/settings/system/update', [
        'uses' => 'SettingsController@system_update',
        'as' => 'settings.system.update'
    ]);

    Route::get('/settings/smtp', ['uses' => 'SettingsController@smtp_show','as' => 'settings.smtp']);
    Route::post('/settings/smtp/update', ['uses' => 'SettingsController@smtp_update','as' => 'settings.smtp.update']);

    Route::get('/activity/import', [ 'uses' => 'ActivitysController@import', 'as' => 'activity.import']);
    Route::get('/activity/export', [ 'uses' => 'ActivitysController@exportdata', 'as' => 'activity.export']);


    Route::get('/settings/quater', [

        'uses' => 'SettingsController@quarter_show',

        'as' => 'settings.quater'

    ])->middleware('settings.show');



    Route::post('/settings/quater/update', [

        'uses' => 'SettingsController@quarter_update',

        'as' => 'settings.quater.update'

    ]);



    Route::get('/settings/smtp', [

        'uses' => 'SettingsController@smtp_show',

        'as' => 'settings.smtp'

    ])->middleware('settings.show');



    Route::post('/settings/smtp/update', [

        'uses' => 'SettingsController@smtp_update',

        'as' => 'settings.smtp.update'

    ]);



    Route::get('/settings/bankaccount', [

        'uses' => 'SettingsController@bankaccount_show',

        'as' => 'settings.bankaccount'

    ])->middleware('settings.show');



    Route::post('/settings/bankaccount/update', [

        'uses' => 'SettingsController@bankaccount_update',

        'as' => 'settings.bankaccount.update'

    ]);



    Route::get('/settings/bankaccount/destroy/{id}', [

        'uses' => 'SettingsController@bankaccount_destroy',

        'as' => 'settings.bankaccount.destroy'

    ]);



    Route::get('/settings/bankaccount/edit/{id}', [

        'uses' => 'SettingsController@general_show',

        'as' => 'settings.bankaccount.edit'

    ]);

    Route::get('/settings/supportDonor', [
        'uses' => 'SettingsController@supportDonor_show',
        'as' => 'settings.supportDonor'
    ])->middleware('settings.show');

    Route::post('/settings/supportDonor/addnew', [
        'uses' => 'SettingsController@supportDonor_addnew',
        'as' => 'settings.supportDonor.addnew'
    ]);

    Route::post('/settings/supportDonor/update', [
        'uses' => 'SettingsController@supportDonor_update',
        'as' => 'settings.supportDonor.update'
    ]);

    Route::get('/settings/supportDonor/edit/{id}', [
        'uses' => 'SettingsController@general_show',
        'as' => 'settings.supportDonor.edit'
    ]);

    Route::get('/settings/supportDonor/destroy/{id}', [
        'uses' => 'SettingsController@supportDonor_destroy',
        'as' => 'settings.supportDonor.destroy'
    ]);

    Route::get('/settings/region', [
        'uses' => 'SettingsController@region_show',
        'as' => 'settings.region'
    ])->middleware('settings.show');

    Route::post('/settings/region/addnew', [
        'uses' => 'SettingsController@region_addnew',
        'as' => 'settings.region.addnew'
    ]);

    Route::post('/settings/region/update', [
        'uses' => 'SettingsController@region_update',
        'as' => 'settings.region.update'
    ]);

    Route::get('/settings/region/edit/{id}', [
        'uses' => 'SettingsController@general_show',
        'as' => 'settings.region.edit'
    ]);

    Route::get('/settings/region/destroy/{id}', [
        'uses' => 'SettingsController@region_destroy',
        'as' => 'settings.region.destroy'
    ]);

    Route::get('/settings/organizationLeader', [
        'uses' => 'SettingsController@organizationLeader_show',
        'as' => 'settings.organizationLeader'
    ])->middleware('settings.show');

    Route::post('/settings/organizationLeader/update', [
        'uses' => 'SettingsController@organizationLeader_update',
        'as' => 'settings.organizationLeader.update'
    ]);

    Route::get('/settings/organizationLeader/edit/{id}', [
        'uses' => 'SettingsController@general_show',
        'as' => 'settings.organizationLeader.edit'
    ]);

    Route::get('/settings/organizationLeader/destroy/{id}', [
        'uses' => 'SettingsController@organizationLeader_destroy',
        'as' => 'settings.organizationLeader.destroy'
    ]);


    Route::get('/settings/costType', [
        'uses' => 'SettingsController@costType_show',
        'as' => 'settings.costType'
    ])->middleware('settings.show');

    Route::post('/settings/costType/update', [
        'uses' => 'SettingsController@costType_update',
        'as' => 'settings.costType.update'
    ]);

    Route::get('/settings/costType/edit/{id}', [
        'uses' => 'SettingsController@general_show',
        'as' => 'settings.costType.edit'
    ]);

    Route::get('/settings/costType/destroy/{id}', [
        'uses' => 'SettingsController@costType_destroy',
        'as' => 'settings.costType.destroy'
    ]);
    
    //    EmailTemplate start

    Route::get('/emailTemplate', [
        'uses' => 'EmailTemplateController@index',
        'as' => 'emailTemplate'
    ])->middleware('emailTemplate.module_show');

    Route::get('/emailTemplate/create', [
        'uses' => 'EmailTemplateController@create',
        'as' => 'emailTemplate.create'
    ])->middleware('emailTemplate.create');

    Route::post('/emailTemplate/store', [
        'uses' => 'EmailTemplateController@store',
        'as' => 'emailTemplate.store'
    ])->middleware('emailTemplate.create');

    Route::get('/emailTemplate/edit/{id}', [
        'uses' => 'EmailTemplateController@edit',
        'as' => 'emailTemplate.edit'
    ])->middleware('emailTemplate.edit');

    Route::post('/emailTemplate/update/{id}', [
        'uses' => 'EmailTemplateController@update',
        'as' => 'emailTemplate.update'
    ])->middleware('emailTemplate.edit');

    Route::get('/emailTemplate/show/{id}', [
        'uses' => 'EmailTemplateController@show',
        'as' => 'emailTemplate.show'
    ]); 

    Route::get('/emailTemplate/destroy/{id}', [

        'uses' => 'EmailTemplateController@destroy',

        'as' => 'emailTemplate.destroy'

    ])->middleware('emailTemplate.delete');



    Route::get('/emailTemplate/trashed', [

        'uses' => 'EmailTemplateController@trashed',

        'as' => 'emailTemplate.trashed'

    ])->middleware('emailTemplate.trash_show');



    Route::post('/emailTemplate/trashed/show', [

        'uses' => 'EmailTemplateController@trashedShow',

        'as' => 'emailTemplate.trashed.show'

    ]);





    Route::get('/emailTemplate/restore/{id}', [

        'uses' => 'EmailTemplateController@restore',

        'as' => 'emailTemplate.restore'

    ])->middleware('emailTemplate.restore');



    Route::get('/emailTemplate/kill/{id}', [

        'uses' => 'EmailTemplateController@kill',

        'as' => 'emailTemplate.kill'

    ])->middleware('emailTemplate.permanently_delete');



    Route::get('/emailTemplate/active/search', [

        'uses' => 'EmailTemplateController@activeSearch',

        'as' => 'emailTemplate.active.search'

    ]);



    Route::get('/emailTemplate/trashed/search', [

        'uses' => 'EmailTemplateController@trashedSearch',

        'as' => 'emailTemplate.trashed.search'

    ]);



    Route::get('/emailTemplate/active/action', [

        'uses' => 'EmailTemplateController@activeAction',

        'as' => 'emailTemplate.active.action'

    ]);



    Route::get('/emailTemplate/trashed/action', [

        'uses' => 'EmailTemplateController@trashedAction',

        'as' => 'emailTemplate.trashed.action'

    ]);

    

    //    EmailTemplate End

    //    Notification start

    Route::get('/notificationset', ['uses' => 'NotificationsetController@index','as' => 'notificationset'])->middleware('notificationset.module_show');
    Route::get('/notificationset/create', ['uses' => 'NotificationsetController@create','as' => 'notificationset.create'])->middleware('notificationset.create');
    Route::post('/notificationset/store', ['uses' => 'NotificationsetController@store','as' => 'notificationset.store'])->middleware('notificationset.create');
    Route::get('/notificationset/edit/{id}', ['uses' => 'NotificationsetController@edit','as' => 'notificationset.edit'])->middleware('notificationset.edit');
    Route::post('/notificationset/update/{id}', ['uses' => 'NotificationsetController@update','as' => 'notificationset.update'])->middleware('notificationset.edit');
    Route::get('/notificationset/show/{id}', [ 'uses' => 'NotificationsetController@show','as' => 'notificationset.show']); 
    Route::get('/notificationset/destroy/{id}', [ 'uses' => 'NotificationsetController@destroy','as' => 'notificationset.destroy'])->middleware('notificationset.delete');
    Route::get('/notificationset/trashed', ['uses' => 'NotificationsetController@trashed','as' => 'notificationset.trashed'])->middleware('notificationset.trash_show');
    Route::post('/notificationset/trashed/show', [ 'uses' => 'NotificationsetController@trashedShow','as' => 'notificationset.trashed.show']);
    Route::get('/notificationset/restore/{id}', ['uses' => 'NotificationsetController@restore','as' => 'notificationset.restore'])->middleware('notificationset.restore');
    Route::get('/notificationset/kill/{id}', ['uses' => 'NotificationsetController@kill','as' => 'notificationset.kill'])->middleware('notificationset.permanently_delete');
    Route::get('/notificationset/active/search', ['uses' => 'NotificationsetController@activeSearch','as' => 'notificationset.active.search']);
    Route::get('/notificationset/trashed/search', ['uses' => 'NotificationsetController@trashedSearch','as' => 'notificationset.trashed.search']);
    Route::get('/notificationset/active/action', ['uses' => 'NotificationsetController@activeAction','as' => 'notificationset.active.action']);
    Route::get('/notificationset/trashed/action', ['uses' => 'NotificationsetController@trashedAction','as' => 'notificationset.trashed.action']);

    //    notification End



    //    Role Manage

    Route::get('/role-manage', [

        'uses' => 'RoleManageController@index',

        'as' => 'role-manage'

    ])->middleware('role.module_show');



    Route::get('/role-manage/show/{id}', [

        'uses' => 'RoleManageController@show',

        'as' => 'role-manage.show'

    ])->middleware('role.show');



    Route::get('/role-manage/create', [

        'uses' => 'RoleManageController@create',

        'as' => 'role-manage.create'

    ])->middleware('role.create');



    Route::post('/role-manage/store', [

        'uses' => 'RoleManageController@store',

        'as' => 'role-manage.store'

    ])->middleware('role.create');





    Route::get('/role-manage/edit/{id}', [

        'uses' => 'RoleManageController@edit',

        'as' => 'role-manage.edit'

    ])->middleware('role.edit');

    Route::post('/role-manage/update/{id}', [

        'uses' => 'RoleManageController@update',

        'as' => 'role-manage.update'

    ])->middleware('role.edit');





    Route::get('/role-manage/destroy/{id}', [

        'uses' => 'RoleManageController@destroy',

        'as' => 'role-manage.destroy'

    ])->middleware('role.delete');



    Route::get('/role-manage/pdf/{id}', [

        'uses' => 'RoleManageController@pdf',

        'as' => 'role-manage.pdf'

    ])->middleware('role.pdf');





    Route::get('/role-manage/trashed', [

        'uses' => 'RoleManageController@trashed',

        'as' => 'role-manage.trashed'

    ])->middleware('role.trash_show');





    Route::get('/role-manage/restore/{id}', [

        'uses' => 'RoleManageController@restore',

        'as' => 'role-manage.restore'

    ])->middleware('role.restore');





    Route::get('/role-manage/kill/{id}', [

        'uses' => 'RoleManageController@kill',

        'as' => 'role-manage.kill'

    ])->middleware('role.permanently_delete');



    Route::get('/role-manage/active/search', [

        'uses' => 'RoleManageController@activeSearch',

        'as' => 'role-manage.active.search'

    ]);



    Route::get('/role-manage/trashed/search', [

        'uses' => 'RoleManageController@trashedSearch',

        'as' => 'role-manage.trashed.search'

    ]);



    Route::get('/role-manage/active/action', [

        'uses' => 'RoleManageController@activeAction',

        'as' => 'role-manage.active.action'

    ])->middleware('role.delete');



    Route::get('/role-manage/trashed/action', [

        'uses' => 'RoleManageController@trashedAction',

        'as' => 'role-manage.trashed.action'

    ]);



    //    role-manage End





    //    Branch Manage

    Route::get('/branch', [

        'uses' => 'BranchController@index',

        'as' => 'branch'

    ])->middleware('branch.module_show');



    Route::get('/branch/show/{id}', [

        'uses' => 'BranchController@show',

        'as' => 'branch.show'

    ])->middleware('branch.show');



    Route::get('/branch/create', [

        'uses' => 'BranchController@create',

        'as' => 'branch.create'

    ])->middleware('branch.create');



    Route::post('/branch/store', [

        'uses' => 'BranchController@store',

        'as' => 'branch.store'

    ])->middleware('branch.create');





    Route::get('/branch/edit/{id}', [

        'uses' => 'BranchController@edit',

        'as' => 'branch.edit'

    ])->middleware('branch.edit');

    Route::post('/branch/update/{id}', [

        'uses' => 'BranchController@update',

        'as' => 'branch.update'

    ])->middleware('branch.edit');





    Route::get('/branch/destroy/{id}', [

        'uses' => 'BranchController@destroy',

        'as' => 'branch.destroy'

    ])->middleware('branch.delete');



    Route::get('/branch/pdf/{id}', [

        'uses' => 'BranchController@pdf',

        'as' => 'branch.pdf'

    ])->middleware('branch.pdf');





    Route::get('/branch/trashed', [

        'uses' => 'BranchController@trashed',

        'as' => 'branch.trashed'

    ])->middleware('branch.trash_show');





    Route::get('/branch/restore/{id}', [

        'uses' => 'BranchController@restore',

        'as' => 'branch.restore'

    ])->middleware('branch.restore');





    Route::get('/branch/kill/{id}', [

        'uses' => 'BranchController@kill',

        'as' => 'branch.kill'

    ])->middleware('branch.permanently_delete');



    Route::get('/branch/active/search', [

        'uses' => 'BranchController@activeSearch',

        'as' => 'branch.active.search'

    ]);



    Route::get('/branch/trashed/search', [

        'uses' => 'BranchController@trashedSearch',

        'as' => 'branch.trashed.search'

    ]);



    Route::get('/branch/active/action', [

        'uses' => 'BranchController@activeAction',

        'as' => 'branch.active.action'

    ])->middleware('branch.delete');



    Route::get('/branch/trashed/action', [

        'uses' => 'BranchController@trashedAction',

        'as' => 'branch.trashed.action'

    ]);

    //    Branch Manage End





    //    Ledger  Start



    //   Type Start

    Route::get('/ledger/type', [

        'uses' => 'IncomeExpenseTypeController@index',

        'as' => 'income_expense_type'

    ])->middleware('income_expense_type.all');



    Route::get('/ledger/type/show/{id}', [

        'uses' => 'IncomeExpenseTypeController@show',

        'as' => 'income_expense_type.show'

    ])->middleware('income_expense_type.show');



    Route::get('/ledger/type/create', [

        'uses' => 'IncomeExpenseTypeController@create',

        'as' => 'income_expense_type.create'

    ])->middleware('income_expense_type.create');



    Route::post('/ledger/type/store', [

        'uses' => 'IncomeExpenseTypeController@store',

        'as' => 'income_expense_type.store'

    ])->middleware('income_expense_type.create');



    /*

    Route::get('/ledger/type/edit/{id}', [

        'uses' => 'IncomeExpenseTypeController@edit',

        'as' => 'income_expense_type.edit'

    ])->middleware('income_expense_type.edit');

    Route::post('/ledger/type/update/{id}', [

        'uses' => 'IncomeExpenseTypeController@update',

        'as' => 'income_expense_type.update'

    ])->middleware('income_expense_type.edit');





    Route::get('/ledger/type/destroy/{id}', [

        'uses' => 'IncomeExpenseTypeController@destroy',

        'as' => 'income_expense_type.destroy'

    ])->middleware('income_expense_type.delete');



    */



    Route::get('/ledger/type/pdf/{id}', [

        'uses' => 'IncomeExpenseTypeController@pdf',

        'as' => 'income_expense_type.pdf'

    ])->middleware('income_expense_type.pdf');





    Route::get('/ledger/type/trashed', [

        'uses' => 'IncomeExpenseTypeController@trashed',

        'as' => 'income_expense_type.trashed'

    ])->middleware('income_expense_type.trash_show');





    Route::get('/ledger/type/restore/{id}', [

        'uses' => 'IncomeExpenseTypeController@restore',

        'as' => 'income_expense_type.restore'

    ])->middleware('income_expense_type.restore');





    Route::get('/ledger/type/kill/{id}', [

        'uses' => 'IncomeExpenseTypeController@kill',

        'as' => 'income_expense_type.kill'

    ])->middleware('income_expense_type.permanently_delete');



    Route::get('/ledger/type/active/search', [

        'uses' => 'IncomeExpenseTypeController@activeSearch',

        'as' => 'income_expense_type.active.search'

    ]);



    Route::get('/ledger/type/trashed/search', [

        'uses' => 'IncomeExpenseTypeController@trashedSearch',

        'as' => 'income_expense_type.trashed.search'

    ]);



    Route::get('/ledger/type/active/action', [

        'uses' => 'IncomeExpenseTypeController@activeAction',

        'as' => 'income_expense_type.active.action'

    ])->middleware('income_expense_type.delete');



    Route::get('/ledger/type/trashed/action', [

        'uses' => 'IncomeExpenseTypeController@trashedAction',

        'as' => 'income_expense_type.trashed.action'

    ]);



    // Type End





    //   Group Start

    Route::get('/ledger/group', [

        'uses' => 'IncomeExpenseGroupController@index',

        'as' => 'income_expense_group'

    ])->middleware('income_expense_group.all');



    Route::get('/ledger/group/show/{id}', [

        'uses' => 'IncomeExpenseGroupController@show',

        'as' => 'income_expense_group.show'

    ])->middleware('income_expense_group.show');



    Route::get('/ledger/group/create', [

        'uses' => 'IncomeExpenseGroupController@create',

        'as' => 'income_expense_group.create'

    ])->middleware('income_expense_group.create');



    Route::post('/ledger/group/store', [

        'uses' => 'IncomeExpenseGroupController@store',

        'as' => 'income_expense_group.store'

    ])->middleware('income_expense_group.create');





    Route::get('/ledger/group/edit/{id}', [

        'uses' => 'IncomeExpenseGroupController@edit',

        'as' => 'income_expense_group.edit'

    ])->middleware('income_expense_group.edit');

    Route::post('/ledger/group/update/{id}', [

        'uses' => 'IncomeExpenseGroupController@update',

        'as' => 'income_expense_group.update'

    ])->middleware('income_expense_group.edit');





    Route::get('/ledger/group/destroy/{id}', [

        'uses' => 'IncomeExpenseGroupController@destroy',

        'as' => 'income_expense_group.destroy'

    ])->middleware('income_expense_group.delete');



    Route::get('/ledger/group/pdf/{id}', [

        'uses' => 'IncomeExpenseGroupController@pdf',

        'as' => 'income_expense_group.pdf'

    ])->middleware('income_expense_group.pdf');





    Route::get('/ledger/group/trashed', [

        'uses' => 'IncomeExpenseGroupController@trashed',

        'as' => 'income_expense_group.trashed'

    ])->middleware('income_expense_group.trash_show');





    Route::get('/ledger/group/restore/{id}', [

        'uses' => 'IncomeExpenseGroupController@restore',

        'as' => 'income_expense_group.restore'

    ])->middleware('income_expense_group.restore');





    Route::get('/ledger/group/kill/{id}', [

        'uses' => 'IncomeExpenseGroupController@kill',

        'as' => 'income_expense_group.kill'

    ])->middleware('income_expense_group.permanently_delete');



    Route::get('/ledger/group/active/search', [

        'uses' => 'IncomeExpenseGroupController@activeSearch',

        'as' => 'income_expense_group.active.search'

    ]);



    Route::get('/ledger/group/trashed/search', [

        'uses' => 'IncomeExpenseGroupController@trashedSearch',

        'as' => 'income_expense_group.trashed.search'

    ]);



    Route::get('/ledger/group/active/action', [

        'uses' => 'IncomeExpenseGroupController@activeAction',

        'as' => 'income_expense_group.active.action'

    ])->middleware('income_expense_group.delete');



    Route::get('/ledger/group/trashed/action', [

        'uses' => 'IncomeExpenseGroupController@trashedAction',

        'as' => 'income_expense_group.trashed.action'

    ]);



    // Group End





    //    ledger - name Start

    Route::get('/ledger/name', [

        'uses' => 'IncomeExpenseHeadController@index',

        'as' => 'income_expense_head'

    ])->middleware('income_expense_head.all');



    Route::get('/ledger/name/show/{id}', [

        'uses' => 'IncomeExpenseHeadController@show',

        'as' => 'income_expense_head.show'

    ])->middleware('income_expense_head.show');



    Route::get('/ledger/name/create', [

        'uses' => 'IncomeExpenseHeadController@create',

        'as' => 'income_expense_head.create'

    ])->middleware('income_expense_head.create');



    Route::post('/ledger/name/store', [

        'uses' => 'IncomeExpenseHeadController@store',

        'as' => 'income_expense_head.store'

    ])->middleware('income_expense_head.create');





    Route::get('/ledger/name/edit/{id}', [

        'uses' => 'IncomeExpenseHeadController@edit',

        'as' => 'income_expense_head.edit'

    ])->middleware('income_expense_head.edit');

    Route::post('/ledger/name/update/{id}', [

        'uses' => 'IncomeExpenseHeadController@update',

        'as' => 'income_expense_head.update'

    ])->middleware('income_expense_head.edit');





    Route::get('/ledger/name/destroy/{id}', [

        'uses' => 'IncomeExpenseHeadController@destroy',

        'as' => 'income_expense_head.destroy'

    ])->middleware('income_expense_head.delete');



    Route::get('/ledger/name/pdf/{id}', [

        'uses' => 'IncomeExpenseHeadController@pdf',

        'as' => 'income_expense_head.pdf'

    ])->middleware('income_expense_head.pdf');





    Route::get('/ledger/name/trashed', [

        'uses' => 'IncomeExpenseHeadController@trashed',

        'as' => 'income_expense_head.trashed'

    ])->middleware('income_expense_head.trash_show');





    Route::get('/ledger/name/restore/{id}', [

        'uses' => 'IncomeExpenseHeadController@restore',

        'as' => 'income_expense_head.restore'

    ])->middleware('income_expense_head.restore');





    Route::get('/ledger/name/kill/{id}', [

        'uses' => 'IncomeExpenseHeadController@kill',

        'as' => 'income_expense_head.kill'

    ])->middleware('income_expense_head.permanently_delete');



    Route::get('/ledger/name/active/search', [

        'uses' => 'IncomeExpenseHeadController@activeSearch',

        'as' => 'income_expense_head.active.search'

    ]);



    Route::get('/ledger/name/trashed/search', [

        'uses' => 'IncomeExpenseHeadController@trashedSearch',

        'as' => 'income_expense_head.trashed.search'

    ]);



    Route::get('/ledger/name/active/action', [

        'uses' => 'IncomeExpenseHeadController@activeAction',

        'as' => 'income_expense_head.active.action'

    ])->middleware('income_expense_head.delete');



    Route::get('/ledger/name/trashed/action', [

        'uses' => 'IncomeExpenseHeadController@trashedAction',

        'as' => 'income_expense_head.trashed.action'

    ]);



    // ledger name End





    //    Ledger  End





    //    Bank Cash Start

    Route::get('/bank-cash', [

        'uses' => 'BankCashController@index',

        'as' => 'bank_cash'

    ])->middleware('bank_cash.all');



    Route::get('/bank-cash/show/{id}', [

        'uses' => 'BankCashController@show',

        'as' => 'bank_cash.show'

    ])->middleware('bank_cash.show');



    Route::get('/bank-cash/create', [

        'uses' => 'BankCashController@create',

        'as' => 'bank_cash.create'

    ])->middleware('bank_cash.create');



    Route::post('/bank-cash/store', [

        'uses' => 'BankCashController@store',

        'as' => 'bank_cash.store'

    ])->middleware('bank_cash.create');





    Route::get('/bank-cash/edit/{id}', [

        'uses' => 'BankCashController@edit',

        'as' => 'bank_cash.edit'

    ])->middleware('bank_cash.edit');



    Route::post('/bank-cash/update/{id}', [

        'uses' => 'BankCashController@update',

        'as' => 'bank_cash.update'

    ])->middleware('bank_cash.edit');





    Route::get('/bank-cash/destroy/{id}', [

        'uses' => 'BankCashController@destroy',

        'as' => 'bank_cash.destroy'

    ])->middleware('bank_cash.delete');



    Route::get('/bank-cash/pdf/{id}', [

        'uses' => 'BankCashController@pdf',

        'as' => 'bank_cash.pdf'

    ])->middleware('bank_cash.pdf');





    Route::get('/bank-cash/trashed', [

        'uses' => 'BankCashController@trashed',

        'as' => 'bank_cash.trashed'

    ])->middleware('bank_cash.trash_show');





    Route::get('/bank-cash/restore/{id}', [

        'uses' => 'BankCashController@restore',

        'as' => 'bank_cash.restore'

    ])->middleware('bank_cash.restore');





    Route::get('/bank-cash/kill/{id}', [

        'uses' => 'BankCashController@kill',

        'as' => 'bank_cash.kill'

    ])->middleware('bank_cash.permanently_delete');



    Route::get('/bank-cash/active/search', [

        'uses' => 'BankCashController@activeSearch',

        'as' => 'bank_cash.active.search'

    ]);



    Route::get('/bank-cash/trashed/search', [

        'uses' => 'BankCashController@trashedSearch',

        'as' => 'bank_cash.trashed.search'

    ]);



    Route::get('/bank-cash/active/action', [

        'uses' => 'BankCashController@activeAction',

        'as' => 'bank_cash.active.action'

    ])->middleware('bank_cash.delete');



    Route::get('/bank-cash/trashed/action', [

        'uses' => 'BankCashController@trashedAction',

        'as' => 'bank_cash.trashed.action'

    ]);



    // Bank Cash End





    //    initial_income_expense_head_balance Start

    Route::get('/initial-ledger-balance', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@index',

        'as' => 'initial_income_expense_head_balance'

    ])->middleware('initial_income_expense_head_balance.all');



    Route::get('/initial-ledger-balance/show/{id}', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@show',

        'as' => 'initial_income_expense_head_balance.show'

    ])->middleware('initial_income_expense_head_balance.show');



    Route::get('/initial-ledger-balance/create', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@create',

        'as' => 'initial_income_expense_head_balance.create'

    ])->middleware('initial_income_expense_head_balance.create');



    Route::post('/initial-income-expense-head-balance/store', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@store',

        'as' => 'initial_income_expense_head_balance.store'

    ])->middleware('initial_income_expense_head_balance.create');





    Route::get('/initial-ledger-balance/edit/{id}', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@edit',

        'as' => 'initial_income_expense_head_balance.edit'

    ])->middleware('initial_income_expense_head_balance.edit');



    Route::post('/initial-ledger-balance/update/{id}', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@update',

        'as' => 'initial_income_expense_head_balance.update'

    ])->middleware('initial_income_expense_head_balance.edit');





    Route::get('/initial-ledger-balance/destroy/{id}', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@destroy',

        'as' => 'initial_income_expense_head_balance.destroy'

    ])->middleware('initial_income_expense_head_balance.delete');



    Route::get('/initial-ledger-balance/pdf/{id}', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@pdf',

        'as' => 'initial_income_expense_head_balance.pdf'

    ])->middleware('initial_income_expense_head_balance.pdf');





    Route::get('/initial-ledger-balance/trashed', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@trashed',

        'as' => 'initial_income_expense_head_balance.trashed'

    ])->middleware('initial_income_expense_head_balance.trash_show');





    Route::get('/initial-income-expense-head-balance/restore/{id}', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@restore',

        'as' => 'initial_income_expense_head_balance.restore'

    ])->middleware('initial_income_expense_head_balance.restore');





    Route::get('/initial-income-expense-head-balance/kill/{id}', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@kill',

        'as' => 'initial_income_expense_head_balance.kill'

    ])->middleware('initial_income_expense_head_balance.permanently_delete');



    Route::get('/initial-income-expense-head-balance/active/search', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@activeSearch',

        'as' => 'initial_income_expense_head_balance.active.search'

    ]);



    Route::get('/initial-income-expense-head-balance/trashed/search', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@trashedSearch',

        'as' => 'initial_income_expense_head_balance.trashed.search'

    ]);



    Route::get('/initial-income-expense-head-balance/active/action', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@activeAction',

        'as' => 'initial_income_expense_head_balance.active.action'

    ])->middleware('initial_income_expense_head_balance.delete');



    Route::get('/initial-income-expense-head-balance/trashed/action', [

        'uses' => 'InitialIncomeExpenseHeadBalanceController@trashedAction',

        'as' => 'initial_income_expense_head_balance.trashed.action'

    ]);



    // initial_income_expense_head_balance End





    //    initial_bank_cash_balance Start

    Route::get('/initial-bank-cash-balance', [

        'uses' => 'InitialBankCashBalanceController@index',

        'as' => 'initial_bank_cash_balance'

    ])->middleware('initial_bank_cash_balance.all');



    Route::get('/initial-bank-cash-balance/show/{id}', [

        'uses' => 'InitialBankCashBalanceController@show',

        'as' => 'initial_bank_cash_balance.show'

    ])->middleware('initial_bank_cash_balance.show');



    Route::get('/initial-bank-cash-balance/create', [

        'uses' => 'InitialBankCashBalanceController@create',

        'as' => 'initial_bank_cash_balance.create'

    ])->middleware('initial_bank_cash_balance.create');



    Route::post('/initial-bank-cash-balance/store', [

        'uses' => 'InitialBankCashBalanceController@store',

        'as' => 'initial_bank_cash_balance.store'

    ])->middleware('initial_bank_cash_balance.create');





    Route::get('/initial-bank-cash-balance/edit/{id}', [

        'uses' => 'InitialBankCashBalanceController@edit',

        'as' => 'initial_bank_cash_balance.edit'

    ])->middleware('initial_bank_cash_balance.edit');



    Route::post('/initial-bank-cash-balance/update/{id}', [

        'uses' => 'InitialBankCashBalanceController@update',

        'as' => 'initial_bank_cash_balance.update'

    ])->middleware('initial_bank_cash_balance.edit');





    Route::get('/initial-bank-cash-balance/destroy/{id}', [

        'uses' => 'InitialBankCashBalanceController@destroy',

        'as' => 'initial_bank_cash_balance.destroy'

    ])->middleware('initial_bank_cash_balance.delete');



    Route::get('/initial-bank-cash-balance/pdf/{id}', [

        'uses' => 'InitialBankCashBalanceController@pdf',

        'as' => 'initial_bank_cash_balance.pdf'

    ])->middleware('initial_bank_cash_balance.pdf');





    Route::get('/initial-bank-cash-balance/trashed', [

        'uses' => 'InitialBankCashBalanceController@trashed',

        'as' => 'initial_bank_cash_balance.trashed'

    ])->middleware('initial_bank_cash_balance.trash_show');





    Route::get('/initial-bank-cash-balance/restore/{id}', [

        'uses' => 'InitialBankCashBalanceController@restore',

        'as' => 'initial_bank_cash_balance.restore'

    ])->middleware('initial_bank_cash_balance.restore');





    Route::get('/initial-bank-cash-balance/kill/{id}', [

        'uses' => 'InitialBankCashBalanceController@kill',

        'as' => 'initial_bank_cash_balance.kill'

    ])->middleware('initial_bank_cash_balance.permanently_delete');



    Route::get('/initial-bank-cash-balance/active/search', [

        'uses' => 'InitialBankCashBalanceController@activeSearch',

        'as' => 'initial_bank_cash_balance.active.search'

    ]);



    Route::get('/initial-bank-cash-balance/trashed/search', [

        'uses' => 'InitialBankCashBalanceController@trashedSearch',

        'as' => 'initial_bank_cash_balance.trashed.search'

    ]);



    Route::get('/initial-bank-cash-balance/active/action', [

        'uses' => 'InitialBankCashBalanceController@activeAction',

        'as' => 'initial_bank_cash_balance.active.action'

    ])->middleware('initial_bank_cash_balance.delete');



    Route::get('/initial-bank-cash-balance/trashed/action', [

        'uses' => 'InitialBankCashBalanceController@trashedAction',

        'as' => 'initial_bank_cash_balance.trashed.action'

    ]);



    // initial_bank_cash_balance End





    //  DrVoucher Start

    Route::get('/dr-voucher', [

        'uses' => 'DrVoucherController@index',

        'as' => 'dr_voucher'

    ])->middleware('dr_voucher.all');



    Route::get('/dr-voucher/show/{id}', [

        'uses' => 'DrVoucherController@show',

        'as' => 'dr_voucher.show'

    ])->middleware('dr_voucher.show');



    Route::get('/dr-voucher/create', [

        'uses' => 'DrVoucherController@create',

        'as' => 'dr_voucher.create'

    ])->middleware('dr_voucher.create');



    Route::post('/dr-voucher/store', [

        'uses' => 'DrVoucherController@store',

        'as' => 'dr_voucher.store'

    ])->middleware('dr_voucher.create');





    Route::get('/dr-voucher/edit/{id}', [

        'uses' => 'DrVoucherController@edit',

        'as' => 'dr_voucher.edit'

    ])->middleware('dr_voucher.edit');



    Route::post('/dr-voucher/update/{id}', [

        'uses' => 'DrVoucherController@update',

        'as' => 'dr_voucher.update'

    ])->middleware('dr_voucher.edit');





    Route::get('/dr-voucher/destroy/{id}', [

        'uses' => 'DrVoucherController@destroy',

        'as' => 'dr_voucher.destroy'

    ])->middleware('dr_voucher.delete');



    Route::get('/dr-voucher/pdf/{id}', [

        'uses' => 'DrVoucherController@pdf',

        'as' => 'dr_voucher.pdf'

    ])->middleware('dr_voucher.pdf');





    Route::get('/dr-voucher/trashed', [

        'uses' => 'DrVoucherController@trashed',

        'as' => 'dr_voucher.trashed'

    ])->middleware('dr_voucher.trash_show');





    Route::get('/dr-voucher/restore/{id}', [

        'uses' => 'DrVoucherController@restore',

        'as' => 'dr_voucher.restore'

    ])->middleware('dr_voucher.restore');





    Route::get('/dr-voucher/kill/{id}', [

        'uses' => 'DrVoucherController@kill',

        'as' => 'dr_voucher.kill'

    ])->middleware('dr_voucher.permanently_delete');



    Route::get('/dr-voucher/active/search', [

        'uses' => 'DrVoucherController@activeSearch',

        'as' => 'dr_voucher.active.search'

    ]);



    Route::get('/dr-voucher/trashed/search', [

        'uses' => 'DrVoucherController@trashedSearch',

        'as' => 'dr_voucher.trashed.search'

    ]);



    Route::get('/dr-voucher/active/action', [

        'uses' => 'DrVoucherController@activeAction',

        'as' => 'dr_voucher.active.action'

    ])->middleware('dr_voucher.delete');



    Route::get('/dr-voucher/trashed/action', [

        'uses' => 'DrVoucherController@trashedAction',

        'as' => 'dr_voucher.trashed.action'

    ]);



    // DrVoucher End





    //  cr_voucher Start

    Route::get('/cr-voucher', [

        'uses' => 'CrVoucherController@index',

        'as' => 'cr_voucher'

    ])->middleware('cr_voucher.all');



    Route::get('/cr-voucher/show/{id}', [

        'uses' => 'CrVoucherController@show',

        'as' => 'cr_voucher.show'

    ])->middleware('cr_voucher.show');



    Route::get('/cr-voucher/create', [

        'uses' => 'CrVoucherController@create',

        'as' => 'cr_voucher.create'

    ])->middleware('cr_voucher.create');



    Route::post('/cr-voucher/store', [

        'uses' => 'CrVoucherController@store',

        'as' => 'cr_voucher.store'

    ])->middleware('cr_voucher.create');





    Route::get('/cr-voucher/edit/{id}', [

        'uses' => 'CrVoucherController@edit',

        'as' => 'cr_voucher.edit'

    ])->middleware('cr_voucher.edit');



    Route::post('/cr-voucher/update/{id}', [

        'uses' => 'CrVoucherController@update',

        'as' => 'cr_voucher.update'

    ])->middleware('cr_voucher.edit');





    Route::get('/cr-voucher/destroy/{id}', [

        'uses' => 'CrVoucherController@destroy',

        'as' => 'cr_voucher.destroy'

    ])->middleware('cr_voucher.delete');



    Route::get('/cr-voucher/pdf/{id}', [

        'uses' => 'CrVoucherController@pdf',

        'as' => 'cr_voucher.pdf'

    ])->middleware('cr_voucher.pdf');





    Route::get('/cr-voucher/trashed', [

        'uses' => 'CrVoucherController@trashed',

        'as' => 'cr_voucher.trashed'

    ])->middleware('cr_voucher.trash_show');





    Route::get('/cr-voucher/restore/{id}', [

        'uses' => 'CrVoucherController@restore',

        'as' => 'cr_voucher.restore'

    ])->middleware('cr_voucher.restore');





    Route::get('/cr-voucher/kill/{id}', [

        'uses' => 'CrVoucherController@kill',

        'as' => 'cr_voucher.kill'

    ])->middleware('cr_voucher.permanently_delete');



    Route::get('/cr-voucher/active/search', [

        'uses' => 'CrVoucherController@activeSearch',

        'as' => 'cr_voucher.active.search'

    ]);



    Route::get('/cr-voucher/trashed/search', [

        'uses' => 'CrVoucherController@trashedSearch',

        'as' => 'cr_voucher.trashed.search'

    ]);



    Route::get('/cr-voucher/active/action', [

        'uses' => 'CrVoucherController@activeAction',

        'as' => 'cr_voucher.active.action'

    ])->middleware('cr_voucher.delete');



    Route::get('/cr-voucher/trashed/action', [

        'uses' => 'CrVoucherController@trashedAction',

        'as' => 'cr_voucher.trashed.action'

    ]);



    // cr_voucher End





    //  jnl_voucher Start

    Route::get('/journal-voucher', [

        'uses' => 'JournalVoucherController@index',

        'as' => 'jnl_voucher'

    ])->middleware('jnl_voucher.all');



    Route::get('/journal-voucher/show/{id}', [

        'uses' => 'JournalVoucherController@show',

        'as' => 'jnl_voucher.show'

    ])->middleware('jnl_voucher.show');



    Route::get('/journal-voucher/create', [

        'uses' => 'JournalVoucherController@create',

        'as' => 'jnl_voucher.create'

    ])->middleware('jnl_voucher.create');



    Route::post('/journal-voucher/store', [

        'uses' => 'JournalVoucherController@store',

        'as' => 'jnl_voucher.store'

    ])->middleware('jnl_voucher.create');





    Route::get('/journal-voucher/edit/{id}', [

        'uses' => 'JournalVoucherController@edit',

        'as' => 'jnl_voucher.edit'

    ])->middleware('jnl_voucher.edit');



    Route::post('/journal-voucher/update/{id}', [

        'uses' => 'JournalVoucherController@update',

        'as' => 'jnl_voucher.update'

    ])->middleware('jnl_voucher.edit');





    Route::get('/journal-voucher/destroy/{id}', [

        'uses' => 'JournalVoucherController@destroy',

        'as' => 'jnl_voucher.destroy'

    ])->middleware('jnl_voucher.delete');



    Route::get('/journal-voucher/pdf/{id}', [

        'uses' => 'JournalVoucherController@pdf',

        'as' => 'jnl_voucher.pdf'

    ])->middleware('jnl_voucher.pdf');





    Route::get('/journal-voucher/trashed', [

        'uses' => 'JournalVoucherController@trashed',

        'as' => 'jnl_voucher.trashed'

    ])->middleware('jnl_voucher.trash_show');





    Route::get('/journal-voucher/restore/{id}', [

        'uses' => 'JournalVoucherController@restore',

        'as' => 'jnl_voucher.restore'

    ])->middleware('jnl_voucher.restore');





    Route::get('/journal-voucher/kill/{id}', [

        'uses' => 'JournalVoucherController@kill',

        'as' => 'jnl_voucher.kill'

    ])->middleware('jnl_voucher.permanently_delete');



    Route::get('/journal-voucher/active/search', [

        'uses' => 'JournalVoucherController@activeSearch',

        'as' => 'jnl_voucher.active.search'

    ]);



    Route::get('/journal-voucher/trashed/search', [

        'uses' => 'JournalVoucherController@trashedSearch',

        'as' => 'jnl_voucher.trashed.search'

    ]);



    Route::get('/journal-voucher/active/action', [

        'uses' => 'JournalVoucherController@activeAction',

        'as' => 'jnl_voucher.active.action'

    ])->middleware('jnl_voucher.delete');



    Route::get('/journal-voucher/trashed/action', [

        'uses' => 'JournalVoucherController@trashedAction',

        'as' => 'jnl_voucher.trashed.action'

    ]);



    // jnl_voucher End





    //  contra_voucher Start

    Route::get('/contra-voucher', [

        'uses' => 'ContraVoucherController@index',

        'as' => 'contra_voucher'

    ])->middleware('contra_voucher.all');



    Route::get('/contra-voucher/show/{id}', [

        'uses' => 'ContraVoucherController@show',

        'as' => 'contra_voucher.show'

    ])->middleware('contra_voucher.show');



    Route::get('/contra-voucher/create', [

        'uses' => 'ContraVoucherController@create',

        'as' => 'contra_voucher.create'

    ])->middleware('contra_voucher.create');



    Route::post('/contra-voucher/store', [

        'uses' => 'ContraVoucherController@store',

        'as' => 'contra_voucher.store'

    ])->middleware('contra_voucher.create');





    Route::get('/contra-voucher/edit/{id}', [

        'uses' => 'ContraVoucherController@edit',

        'as' => 'contra_voucher.edit'

    ])->middleware('contra_voucher.edit');



    Route::post('/contra-voucher/update/{id}', [

        'uses' => 'ContraVoucherController@update',

        'as' => 'contra_voucher.update'

    ])->middleware('contra_voucher.edit');





    Route::get('/contra-voucher/destroy/{id}', [

        'uses' => 'ContraVoucherController@destroy',

        'as' => 'contra_voucher.destroy'

    ])->middleware('contra_voucher.delete');



    Route::get('/contra-voucher/pdf/{id}', [

        'uses' => 'ContraVoucherController@pdf',

        'as' => 'contra_voucher.pdf'

    ])->middleware('contra_voucher.pdf');





    Route::get('/contra-voucher/trashed', [

        'uses' => 'ContraVoucherController@trashed',

        'as' => 'contra_voucher.trashed'

    ])->middleware('contra_voucher.trash_show');





    Route::get('/contra-voucher/restore/{id}', [

        'uses' => 'ContraVoucherController@restore',

        'as' => 'contra_voucher.restore'

    ])->middleware('contra_voucher.restore');





    Route::get('/contra-voucher/kill/{id}', [

        'uses' => 'ContraVoucherController@kill',

        'as' => 'contra_voucher.kill'

    ])->middleware('contra_voucher.permanently_delete');



    Route::get('/contra-voucher/active/search', [

        'uses' => 'ContraVoucherController@activeSearch',

        'as' => 'contra_voucher.active.search'

    ]);



    Route::get('/contra-voucher/trashed/search', [

        'uses' => 'ContraVoucherController@trashedSearch',

        'as' => 'contra_voucher.trashed.search'

    ]);



    Route::get('/contra-voucher/active/action', [

        'uses' => 'ContraVoucherController@activeAction',

        'as' => 'contra_voucher.active.action'

    ])->middleware('contra_voucher.delete');



    Route::get('/contra-voucher/trashed/action', [

        'uses' => 'ContraVoucherController@trashedAction',

        'as' => 'contra_voucher.trashed.action'

    ]);



    // contra_voucher End





    //    Accounts Report Start



    //    ledger



    Route::get('/reports/accounts/ledger', [

        'uses' => 'AccountsReportController@ledger_index',

        'as' => 'reports.accounts.ledger'

    ])->middleware('report.ledger.all');





    Route::post('/reports/accounts/ledger/branch-wise/report', [

        'uses' => 'AccountsReportController@ledger_branch_wise_report',

        'as' => 'reports_accounts_ledger.branch_wise.report'

    ])->middleware('report.ledger.all');



    Route::post('/reports/accounts/ledger/income-expense-head-wise/report', [

        'uses' => 'AccountsReportController@ledger_income_expense_head_wise_report',

        'as' => 'reports_accounts_ledger.income_expense_head_wise.report'

    ])->middleware('report.ledger.all');



    Route::post('/reports/accounts/ledger/bank-cash-wise/report', [

        'uses' => 'AccountsReportController@ledger_bank_cash_wise_report',

        'as' => 'reports_accounts_ledger.bank_cash_wise.report'

    ])->middleware('report.ledger.all');





    //    Trial Balance

    Route::get('/reports/accounts/trial-balance', [

        'uses' => 'Reports\Accounts\TrialBalanceController@index',

        'as' => 'reports.accounts.trial_balance'

    ])->middleware('report.TrialBalance.all');



    Route::post('/reports/accounts/trial-balance/report', [

        'uses' => 'Reports\Accounts\TrialBalanceController@branch_wise',

        'as' => 'reports.accounts.trial_balance.branch_wise.report'

    ])->middleware('report.TrialBalance.all');



    //    Cost Of Revenue Manage

    Route::get('/reports/accounts/cost-of-revenue', [

        'uses' => 'Reports\Accounts\CostOfRevenueController@index',

        'as' => 'reports.accounts.cost_of_revenue'

    ])->middleware('report.CostOfRevenue.all');



    Route::post('/reports/accounts/cost-of-revenue/report', [

        'uses' => 'Reports\Accounts\CostOfRevenueController@branch_wise',

        'as' => 'reports.accounts.cost_of_revenue.report'

    ])->middleware('report.CostOfRevenue.all');





    //    Profit & Loss Account

    Route::get('/reports/accounts/profit-or-loss-account', [

        'uses' => 'Reports\Accounts\ProfitAndLossAccountController@index',

        'as' => 'reports.accounts.profit_or_loss_account'

    ])->middleware('report.ProfitOrLossAccount.all');



    Route::post('/reports/accounts/profit-or-loss-account/report', [

        'uses' => 'Reports\Accounts\ProfitAndLossAccountController@branch_wise',

        'as' => 'reports.accounts.profit_or_loss_account.report'

    ])->middleware('report.ProfitOrLossAccount.all');



    //    Retained Earnings

    Route::get('/reports/accounts/retained-earnings', [

        'uses' => 'Reports\Accounts\RetainedEarningsController@index',

        'as' => 'reports.accounts.retained_earnings'

    ])->middleware('report.RetainedEarning.all');



    Route::post('/reports/accounts/retained-earnings/report', [

        'uses' => 'Reports\Accounts\RetainedEarningsController@branch_wise',

        'as' => 'reports.accounts.retained_earnings.report'

    ])->middleware('report.RetainedEarning.all');





    //    Fixed Asset Schedule

    Route::get('/reports/accounts/fixed-asset-schedule', [

        'uses' => 'Reports\Accounts\FixedAssetScheduleController@index',

        'as' => 'reports.accounts.fixed_asset_schedule'

    ])->middleware('report.FixedAssetsSchedule.all');



    Route::post('/reports/accounts/fixed-asset-schedule/report', [

        'uses' => 'Reports\Accounts\FixedAssetScheduleController@branch_wise',

        'as' => 'reports.accounts.fixed_asset_schedule.report'

    ])->middleware('report.FixedAssetsSchedule.all');





    //  Balance sheet

    Route::get('/reports/accounts/balance-sheet', [

        'uses' => 'Reports\Accounts\BalanceSheetController@index',

        'as' => 'reports.accounts.balance_sheet'

    ])->middleware('report.StatementOfFinancialPosition.all');



    Route::post('/reports/accounts/balance-sheet/report', [

        'uses' => 'Reports\Accounts\BalanceSheetController@branch_wise',

        'as' => 'reports.accounts.balance_sheet.report'

    ])->middleware('report.StatementOfFinancialPosition.all');





    //  Cash Flow

    Route::get('/reports/accounts/cash-flow', [

        'uses' => 'Reports\Accounts\CashFlowController@index',

        'as' => 'reports.accounts.cash_flow'

    ]);



    Route::post('/reports/accounts/cash-flow/report', [

        'uses' => 'Reports\Accounts\CashFlowController@branch_wise',

        'as' => 'reports.accounts.cash_flow.report'

    ]);





    //  Receive Payment

    Route::get('/reports/accounts/receive-payment', [

        'uses' => 'Reports\Accounts\ReceivePaymentController@index',

        'as' => 'reports.accounts.receive_payment'

    ])->middleware('report.ReceiveAndPayment.all');



    Route::post('/reports/accounts/receive-payment/report', [

        'uses' => 'Reports\Accounts\ReceivePaymentController@branch_wise',

        'as' => 'reports.accounts.receive_payment.report'

    ])->middleware('report.ReceiveAndPayment.all');





    //  Notes start

    Route::get('/reports/accounts/notes', [

        'uses' => 'Reports\Accounts\NotesController@index',

        'as' => 'reports.accounts.notes'

    ])->middleware('report.Notes.all');



    Route::post('/reports/accounts/notes/type_wise/report', [

        'uses' => 'Reports\Accounts\NotesController@type_wise',

        'as' => 'reports.accounts.notes.type_wise.report'

    ])->middleware('report.Notes.all');



    Route::post('/reports/accounts/notes/group_wise/report', [

        'uses' => 'Reports\Accounts\NotesController@group_wise',

        'as' => 'reports.accounts.notes.group_wise.report'

    ])->middleware('report.Notes.all');





    //    Notes End



    //    Accounts Report End





    //    General Report Start



    //    Branch Start



    Route::get('/reports/general/branch', [

        'uses' => 'Reports\General\GeneralReportController@branch',

        'as' => 'reports.general.branch'

    ])->middleware('report.general_report.branch.all');



    Route::post('/reports/general/branch/report', [

        'uses' => 'Reports\General\GeneralReportController@branch_report',

        'as' => 'reports.general.branch.report'

    ]);





    //    Branch End





    //    Ledger Start



    Route::get('/reports/general/ledger', [

        'uses' => 'Reports\General\GeneralReportController@ledger_type',

        'as' => 'reports.general.ledger.type'

    ])->middleware('report.general_report.ledger.all');



    Route::post('/reports/general/ledger/type/report', [

        'uses' => 'Reports\General\GeneralReportController@ledger_type_report',

        'as' => 'reports.general.ledger.type.report'

    ]);





    Route::post('/reports/general/ledger/group/report', [

        'uses' => 'Reports\General\GeneralReportController@ledger_group_report',

        'as' => 'reports.general.ledger.group.report'

    ]);



    Route::post('/reports/general/ledger/name/report', [

        'uses' => 'Reports\General\GeneralReportController@ledger_name_report',

        'as' => 'reports.general.ledger.name.report'

    ]);





    //    Ledger End



    //    Bank Cash Start

    Route::get('/reports/general/bank-cash', [

        'uses' => 'Reports\General\GeneralReportController@bank_cash',

        'as' => 'reports.general.bank_cash'

    ])->middleware('report.general_report.BankCash.all');



    Route::post('/reports/general/ledger/bank-cash/report', [

        'uses' => 'Reports\General\GeneralReportController@bank_cash_report',

        'as' => 'reports.general.bank_cash.report'

    ]);

    //    Bank Cash End





    //    Voucher start

    Route::get('/reports/general/voucher', [

        'uses' => 'Reports\General\GeneralReportController@voucher',

        'as' => 'reports.general.voucher'

    ])->middleware('report.general_report.Voucher.all');





    Route::post('/reports/general/voucher/report', [

        'uses' => 'Reports\General\GeneralReportController@voucher_report',

        'as' => 'reports.general.voucher.report'

    ]);

    //    Voucher start



    //    General Report End





});

