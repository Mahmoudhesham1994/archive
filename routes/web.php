<?php

//Route::redirect('/', '/login');

Route::get('/', 'HomeController@index');


Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin
    Route::get('archives/show_two', 'Admin\ArchivesController@show_two');

   Route::get('archives/show_select2', 'Admin\MessagesController@show_select2');
   Route::get('archives/dashpord', 'Admin\MessagesController@dashord');

 //  Route::get('messages/needreplay', 'MessagesController@needreplay');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');
    
        
              Route::post('permissions/editpost', 'PermissionsController@editpost');
      Route::post('permissions/showpost', 'PermissionsController@showpost');

    

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');
    
    
      Route::post('roles/editpost', 'RolesController@editpost');
      Route::post('roles/showpost', 'RolesController@showpost');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
      Route::post('users/editpost', 'UsersController@editpost');
      Route::post('users/showpost', 'UsersController@showpost');

    // Contacts
    Route::delete('contacts/destroy', 'ContactsController@massDestroy')->name('contacts.massDestroy');
    Route::resource('contacts', 'ContactsController');

    
              Route::post('contacts/editpost', 'ContactsController@editpost');
      Route::post('contacts/showpost', 'ContactsController@showpost');

    
    // Priorities
    Route::delete('priorities/destroy', 'PrioritiesController@massDestroy')->name('priorities.massDestroy');
    Route::resource('priorities', 'PrioritiesController');
    
    
    Route::post('priorities/editpost', 'PrioritiesController@editpost');
    
     Route::post('priorities/showpost', 'PrioritiesController@showpost');

    

    // Doc Types
    Route::delete('doc-types/destroy', 'DocTypesController@massDestroy')->name('doc-types.massDestroy');
    Route::resource('doc-types', 'DocTypesController');

        Route::post('doc-types/editpost', 'DocTypesController@editpost');
    
     Route::post('doc-types/showpost', 'DocTypesController@showpost');

    
    
    
    // Messages
    Route::delete('messages/destroy', 'MessagesController@massDestroy')->name('messages.massDestroy');
    Route::post('messages/media', 'MessagesController@storeMedia')->name('messages.storeMedia');
    Route::post('messages/ckmedia', 'MessagesController@storeCKEditorImages')->name('messages.storeCKEditorImages');
    Route::resource('messages', 'MessagesController');
  Route::post('messages/search', 'MessagesController@search');
   Route::get('messages/delete/{id}', 'MessagesController@delete');
   Route::get('message/needreplay', 'MessagesController@needreplay');
  Route::get('message/exp', 'MessagesController@exp');
    Route::get('message/emp', 'MessagesController@emp');
    
     Route::post('messages/editpost', 'MessagesController@editpost');
    
     Route::post('messages/showpost', 'MessagesController@showpost');
  
    
    
    
    // Msg Types
    Route::delete('msg-types/destroy', 'MsgTypesController@massDestroy')->name('msg-types.massDestroy');
    Route::resource('msg-types', 'MsgTypesController');
    
      Route::post('msg-types/editpost', 'MsgTypesController@editpost');
    
     Route::post('msg-types/showpost', 'MsgTypesController@showpost');

    
    
    

    // Msg Statuses
    Route::delete('msg-statuses/destroy', 'MsgStatusesController@massDestroy')->name('msg-statuses.massDestroy');
    Route::resource('msg-statuses', 'MsgStatusesController');

          Route::post('msg-statuses/editpost', 'MsgStatusesController@editpost');
      Route::post('msg-statuses/showpost', 'MsgStatusesController@showpost');

    
    
    // Archives
    Route::delete('archives/destroy', 'ArchivesController@massDestroy')->name('archives.massDestroy');
    Route::post('archives/media', 'ArchivesController@storeMedia')->name('archives.storeMedia');
    Route::post('archives/ckmedia', 'ArchivesController@storeCKEditorImages')->name('archives.storeCKEditorImages');
    Route::resource('archives', 'ArchivesController');
      Route::post('archives/search', 'ArchivesController@search');
    
       Route::get('archives/delete/{id}', 'ArchivesController@delete');
       Route::get('archive/countmonth', 'ArchivesController@countmonth');


         Route::post('archives/editpost', 'ArchivesController@editpost');
    
     Route::post('archives/showpost', 'ArchivesController@showpost');

    
    
    


});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});