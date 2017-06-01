<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


Route::get('/services/{service}/employees', function ($serviceId) {
    return App\Service::findOrFail($serviceId)->employees;
});

Route::get('/services/{services}/employees/{employee}/timeslots', 'Api\AppointmentsController@timeslots');

Route::post('/salon/{salon}/appointments', 'Api\AppointmentsController@requestAppointment');
