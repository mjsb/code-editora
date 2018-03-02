<?php

Route::group(['as' => 'codeeduuser.'], function (){
    Route::group(['prefix' => 'admin'], function (){
        Route::resource('users', 'UsersController');
    });

    Route::get('email-verification/error', 'UsersConfirmationController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}', 'UsersConfirmationController@getVerification')->name('email-verification.check');

});



