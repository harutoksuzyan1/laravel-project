<?php

namespace App;

use Datetime;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salon_id',
        'employee_id',
        'service_id',
        'customer_id',
        'start',
        'end',
        'status',
        'notes'
    ];

    /**
     * The relations to append to the model's array form.
     *
     * @var array
     */
    protected $with = ['service', 'employee', 'customer'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['title', 'dateForHumans', 'timeForHumans'];

    /**
     * Get the appointment's title.
     *
     * @return string
     */
    public function getTitleAttribute()
    {
        return sprintf('%s - %s', $this->employee->name, $this->service->name);
    }

    /**
     * Get the appointment's date human readable.
     *
     * @return string
     */
    public function getDateForHumansAttribute()
    {
        return date('d. F Y', strtotime($this->attributes['start']));
    }

    /**
     * Get the appointment's time human readable.
     *
     * @return string
     */
    public function getTimeForHumansAttribute()
    {
        return date('H:i', strtotime($this->attributes['start']));
    }

    /**
     * Get the profile that is associated with the specified service.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salon()
    {
        return $this->belongsTo(salon::class);
    }

    /**
     * Get a service that is related to the specefied appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service() {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get a customer that is related to the specefied appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get a employee that is related to the specefied appointment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
