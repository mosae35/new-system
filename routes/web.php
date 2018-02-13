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



Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware'=>['web','auth','admin']],function(){

    // inside work
    Route::resource('/process', 'ProcessController');
    //Route::post('process/details/{id}','ProcessController@save_details');
    Route::get('/used/{id}/delete','ProcessController@delete_used');
    Route::get('/used/{id}/change','ProcessController@edit_out');
    Route::get('/used/{id}/update','ProcessController@edit_used_2');
    Route::patch('used/edit/{id}','ProcessController@update_used');
    Route::patch('used/update/{id}','ProcessController@change_used');
    Route::post('process/used/{id}','ProcessController@save_used');
    Route::get('used/{id}/destroy','ProcessController@delete_another_used');
    // out work
    Route::resource('/out_process','OutProcessController');
  //  Route::post('out_process/details/{id}','OutProcessController@save_details');
    Route::post('out_process/used/{id}','OutProcessController@save_used');
    Route::get('/out/{id}/change','OutProcessController@edit_out');
    Route::patch('out/edit/{id}','OutProcessController@update_out');
    Route::get('/used/{id}/update','OutProcessController@edit_used');
    Route::patch('/used/update/{id}','OutProcessController@change_used');
    Route::get('/out/{id}/delete','OutProcessController@delete_used');
    Route::get('used/{id}/destroy','OutProcessController@delete_another_used');
    // insert accounts
    Route::resource('/insert_account','InsertAccountController');
    Route::post('process/pay/{id}','InsertAccountController@pay');
    //get_money
    Route::post('process/get','InsertAccountController@pop_money');
    //outerAccounts
    Route::resource('/out_account','OutAccountController');
    Route::post('out_process/pay/{id}','OutAccountController@pay');
    Route::post('out_process/get','OutAccountController@pop_money');
    //RemainPayment
    Route::resource('/remain_payment','RemainPaymentController');
    Route::post('/search','RemainPaymentController@doctor_search');
    //employ
    Route::resource('/employ','EmployController');
    Route::post('/employee/absent/{id}','EmployController@employee_abcent');
    Route::get('absent/{id}/remove','EmployController@absent_remove');
    Route::get('hour/{id}/remove','EmployController@hour_remove');
    Route::get('amount/{id}/remove','EmployController@balance_remove');
    Route::post('employ/add_hour/{id}','EmployController@add_hour');
    Route::post('employ/money/{id}','EmployController@employ_get_mony');
    Route::post('employ/account/{id}','EmployController@employ_account');
    //store
    Route::resource('store','StoreController');
    // sort_b
    Route::get('add_sort_b','StoreController@show_sort_b');
    Route::post('add/sort_b','StoreController@add_sort_b');
    Route::post('remove_sort_b/{id}','StoreController@remove_sort_b');
    Route::get('edit/sort_b/{id}','StoreController@edit_sort_b');
    Route::patch('sort_b/update/{id}','StoreController@sort_b_update');
    // sort_c
    Route::get('add_sort_c','StoreController@show_sort_c');
    Route::post('add/sort_c','StoreController@add_sort_c');
    Route::post('remove_sort_c/{id}','StoreController@remove_sort_c');
    Route::get('edit/sort_c/{id}','StoreController@edit_sort_c');
    Route::patch('sort_c/update/{id}','StoreController@sort_c_update');

    //out_store
    Route::resource('out_store','OutStoreController');
    // out_sort_b
    Route::get('out_add_sort_b','OutStoreController@show_sort_b');
    Route::post('out_add/sort_b','OutStoreController@add_sort_b');
    Route::post('out_remove_sort_b/{id}','OutStoreController@remove_sort_b');
    Route::get('out_edit/sort_b/{id}','OutStoreController@edit_sort_b');
    Route::patch('out_sort_b/update/{id}','OutStoreController@sort_b_update');


    // out_sort_c
    Route::get('out_add_sort_c','OutStoreController@show_sort_c');
    Route::post('out_add/sort_c','OutStoreController@add_sort_c');
    Route::post('out_remove_sort_c/{id}','OutStoreController@remove_sort_c');
    Route::get('out_edit/sort_c/{id}','OutStoreController@edit_sort_c');
    Route::patch('out_sort_c/update/{id}','OutStoreController@sort_c_update');


    // requirments
    Route::resource('requirement','requirementsController');
    Route::resource('machien','MachienController');

    // search by ajax
    Route::get('/out_work','OutProcessController@ajax');
    Route::get('/in_work','ProcessController@ajax');
    Route::get('/in_account','InsertAccountController@ajax');
    Route::get('/out_acount','OutAccountController@ajax');
    Route::get('/in','RemainPaymentController@ajax');
    Route::get('/out','RemainPaymentController@ajax_out');
    Route::get('/employ_search','EmployController@ajax');

    //store_search
    Route::get('/sort_a_search','StoreController@ajax_a');
    Route::get('/sort_b_search','StoreController@ajax_b');
    Route::get('/sort_c_search','StoreController@ajax_c');

    //out_store_search
    Route::get('/out_sort_a_search','OutStoreController@ajax_a');
    Route::get('/out_sort_b_search','OutStoreController@ajax_b');
    Route::get('/out_sort_c_search','OutStoreController@ajax_c');

    //user_admin
    Route::resource('/user','AdminController');

    //edit_password
    Route::post('edit/password/{id}','AdminController@edit_password');
   // Route::post('update_password/{id}','AdminController@update_pass');

    //ajax
    Route::get('work','ProcessController@ajax_k1');
    Route::get('work_2','ProcessController@ajax_k2');
    Route::get('work_3','ProcessController@ajax_k3');

    //ajax
    Route::get('out_out_work','OutProcessController@ajax_k1');
    Route::get('out/work_2','OutProcessController@ajax_k2');
    Route::get('out_work_3','OutProcessController@ajax_k3');


    Route::get('out_with_this/{id}','ProcessController@save_details');
    Route::get('out_with_out/{id}','OutProcessController@save_details');
   // Route::post('machien/add','ProcessController@machien_add');
    //out_machie
    Route::get('slam','ProcessController@machien');
    Route::get('machien/edit/{id}/{process_id}','ProcessController@machien_edit');
    Route::get('machien/delete/{id}','ProcessController@machien_delete');
    Route::post('machien/update/{id}/{process_id}','ProcessController@machien_update');

    //out_work_machie
    Route::get('/good/main','OutProcessController@out_machien');
    Route::get('out/machien/edit/{id}/{out_process_id}','OutProcessController@out_machien_edit');
    Route::get('out/machien/delete/{id}','OutProcessController@out_machien_delete');
    Route::post('out/machien/update/{id}/{out_process_id}','OutProcessController@out_machien_update');

    //total_store
    Route::post('total/sort/a','TotalStoreController@add_sort_a');
    Route::post('total/sort/b','TotalStoreController@add_sort_b');
    Route::post('total/sort/c','TotalStoreController@add_sort_c');

    Route::get('edit/total_a/{id}','TotalStoreController@edit_sort_a');
    Route::get('edit/total_b/{id}','TotalStoreController@edit_sort_b');
    Route::get('edit/total_c/{id}','TotalStoreController@edit_sort_c');

    Route::post('update/total_a/{id}','TotalStoreController@update_sort_a');
    Route::post('update/total_b/{id}','TotalStoreController@update_sort_b');
    Route::post('update/total_c/{id}','TotalStoreController@update_sort_c');


    //out work
    Route::get('good/machiens','OutProcessController@all_machiens');
    Route::get('out/data','OutProcessController@all_required');



    //main work
    Route::get('new/data','ProcessController@all_name_machiens');
    Route::get('old/data','ProcessController@all_name_required');


    //ajax save used
    Route::get('out/used_1','ProcessController@ajax_get_sort_used_1');
    Route::get('out/used_2','ProcessController@ajax_get_sort_used_2');
    Route::get('out/used_3','ProcessController@ajax_get_sort_used_3');

    //ajax save out_used
    Route::get('out/used_1/out','OutProcessController@ajax_get_sort_out_used_1');
    Route::get('out/used_2/out','OutProcessController@ajax_get_sort_out_used_2');
    Route::get('out/used_3/out','OutProcessController@ajax_get_sort_out_used_3');

});











