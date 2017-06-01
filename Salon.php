<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'profile_url',
        'website',
        'phone',
        'zip',
        'street',
        'city',
        'description',
        'logo',
        'facebook',
        'twitter',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['logoPath'];

    public function owns($model)
    {
        return $this->id == $model->salon_id;
    }

    /**
     * Get the salons's logo path
     *
     * @return mixed
     */
    public function getLogoPathAttribute()
    {
        return str_replace('public', 'storage', $this->attributes['logo']);
    }

    /**
     * Get the user that is associated with the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    /**
     * Get the working plan that is associated with the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function workingDays()
    {
        return $this->morphMany('App\WorkingDay', 'workable');
    }

    /**
     * Get the specefied working day
     *
     * @param $day
     * @return mixed
     */
    public function workingDay($day)
    {
        return $this->workingDays()->where('weekday', $day)->first();
    }

    /**
     * Edit working hours of the specefied employee
     *
     * @param $plan
     * @param $day
     * @return mixed
     */
    public function editWorkingHours($day, $plan)
    {
        return $this->workingDay($day)->update($plan);
    }

    /**
     * Get employees that work in the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get customers that are associated with the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * Get appoinments that are booked at the specefied profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the services that belong to the profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get the specefied service that belongs to the Salon
     *
     * @param $serviceId
     * @return mixed
     */
    public function service($serviceId)
    {
        return $this->services()->where('id', $serviceId)->firstOrFail();
    }

    /**
     * Add a new service
     *
     * @param Service $service
     * @return Model
     */
    public function addService(Service $service)
    {
        return $this->services()->save($service);
    }

    /**
     * Hire a new employee
     *
     * @param $employee
     * @return mixed
     */
    public function hire($employee)
    {
        return $this->employees()->save($employee)->withInitialWorkingPlan();
    }

    /**
     * Save a logo of the specefied salon
     *
     * @param $path
     * @return $this
     */
    public function saveLogo($path)
    {
        $this->logo = $path;

        $this->save();

        return $this;
    }

    /**
     * Book an appointment for the specefied salon
     *
     * @param $data
     * @return Model
     */
    public function bookAppointment($data)
    {
        return $this->appointments()->create($data);
    }
}
