<?php

Route::group(['prefix' => 'proforma'], function () {
    Route::get('invoice/{slug}', 'Logingrupa\Studybook\Controllers\ProformasController@view')
        ->name('proforma.show');;
});
