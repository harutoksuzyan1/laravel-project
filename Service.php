<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'buffer_before',
        'buffer_after',
        'target'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['isActive'];

    /**
     * Determine if the specified service is active
     */
    public function getIsActiveAttribute()
    {
        return !! $this->employees->count();
    }

    /**
     * Set the service's name first letter upper case
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = lcfirst($value);
    }

    /**
     * Get the service's price in euros
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * Set the service's price in cents
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    /**
     * Get the service's duration in minutes
     */
    public function getDurationAttribute($value)
    {
        return $value / 60;
    }

    /**
     * Set the service's price in seconds
     */
    public function setDurationAttribute($value)
    {
        $this->attributes['duration'] = $value * 60;
    }

    /**
     * Get the total duration of an service with buffering time
     */
    public function getTotalDurationAttribute()
    {
        return $this->buffer_before + $this->duration + $this->buffer_after;
    }

    /**
     * Get the salon that is associated with the specified service
     */
    public function salon()
    {
        return $this->belongsTo(salon::class);
    }

    /**
     * Get the Employees that belongs to the Service.
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    /**
     * Get appoinments that are booked at the specefied salon.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
