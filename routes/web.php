<?php

use App\Notifications\BookingReviewed;

// App Authentication
Auth::routes();

// profile's profile
// Temporary Disabled
// Route::group(['domain' => "{profile}." . env('APP_URL')], function ($profile) {
//     Route::get('/', 'BookingController@show');
// });

Route::get('salons/{profile}', 'BookingController@show');

// Front Pages
Route::get('/', 'PagesController@landing');
Route::get('features', 'PagesController@features');
Route::get('pricing', 'PagesController@pricing');
Route::get('support', 'PagesController@support');
Route::get('kontakt', 'PagesController@contact');
Route::get('impressions', 'PagesController@impressions');
Route::get('impressum', 'PagesController@impressum');
Route::get('datenschutz', 'PagesController@privacy');
Route::get('agb', 'PagesController@agb');

// Blog
Route::get('blog', function () {
    return view('pages.blog.index');
});

// Application
Route::group(['prefix' => 'salon', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index');

    // Employees
    Route::get('employees', 'EmployeesController@index');
    Route::post('employees', 'EmployeesController@store');
    Route::get('employees/{employee}', 'EmployeesController@show');
    Route::patch('employees/{employee}', 'EmployeesController@update');
    Route::delete('employees/{employee}', 'EmployeesController@destroy');
    Route::put('employees/{employee}/working-days/{day}', 'EmployeesController@editWorkingDay');

    // Customers
    Route::get('customers', 'CustomersController@index');
    Route::post('customers', 'CustomersController@store');
    Route::patch('customers/{customer}', 'CustomersController@update');
    Route::delete('customers/{customer}', 'CustomersController@destroy');

    // Services
    Route::get('services', 'ServicesController@index');
    Route::get('services/{service}', 'ServicesController@show');
    Route::post('services', 'ServicesController@store');
    Route::patch('services/{service}', 'ServicesController@update');
    Route::delete('services/{service}', 'ServicesController@destroy');

    Route::patch('services/{service}/employees/{employee}', 'ServicesController@toggleService');

    // profile
    Route::get('profile', 'SalonController@index');
    Route::put('profile/logo', 'SalonController@changeLogo');
    Route::patch('profile', 'SalonController@update');
    Route::put('profile/working-days/{day}', 'SalonController@editWorkingDay');

    // Appointments
    Route::get('appointments/{appointment}', 'AppointmentsController@show');
    Route::put('appointments/{appointment}/status', 'AppointmentsController@changeStatus');

    // Calendar
    Route::get('calendar', 'CalendarController@index');
});

Route::get('test', function () {
    // Test

    return view('test');
});
