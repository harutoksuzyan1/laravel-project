<?php

namespace App\Http\Controllers;

use App\{Appointment, salon, Customer};
use App\Notifications\BookingRequested;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    /**
     * Display the specefied appointment
     */
    public function show($appointmentId)
    {
        return Appointment::findOrFail($appointmentId);
    }

    /**
     * Change a status of the specefied appointment
     */
    public function changeStatus(Request $request, $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);

        $appointment->status = $request->input('status');

        $appointment->save();

        return redirect()->back();
    }

    /**
     * Store the specefied appointment
     */
    public function store(Request $request) {
        $attributes = $request->all();

        $salon = salon::findOrFail($attributes['appointment']['salon_id']);

        $customer = Customer::updateOrCreate([
            'email' => $attributes['customer']['email']],
            $attributes['customer']
        );

        $data = array_merge($attributes['appointment'], ['customer_id' => $customer->id]);

        $appointment = Appointment::create($data);

        if ($appointment) {
            $customer->notify(new BookingRequested($appointment));
            $salon->notify(new BookingRequested($appointment));
        }

        return 'Done';
    }
}
