<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Contacts
    Route::apiResource('contacts', 'ContactsApiController');

    // Priorities
    Route::apiResource('priorities', 'PrioritiesApiController');

    // Doc Types
    Route::apiResource('doc-types', 'DocTypesApiController');

    // Messages
    Route::post('messages/media', 'MessagesApiController@storeMedia')->name('messages.storeMedia');
    Route::apiResource('messages', 'MessagesApiController');

    // Msg Types
    Route::apiResource('msg-types', 'MsgTypesApiController');

    // Msg Statuses
    Route::apiResource('msg-statuses', 'MsgStatusesApiController');

    // Archives
    Route::post('archives/media', 'ArchivesApiController@storeMedia')->name('archives.storeMedia');
    Route::apiResource('archives', 'ArchivesApiController');

});