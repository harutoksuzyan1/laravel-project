<?php

namespace App\Http\Controllers;

use App\{
    Salon, WorkingDay
};
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateSalon;

class SalonController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salon = $this->salon();

        return view('app.profile.index', compact('salon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalon $request)
    {
        $this->salon()->update($request->all());

        return redirect()->back()->with('alert', 'Employee is edited successfully!');
    }

    /**
     * Edit the specefied working day of the salon
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editWorkingDay($day)
    {
        $this->salon()->editWorkingHours($day, request()->all());

        if (request()->ajax()) {
            return response()->json(['status' => 'Working day plan is succesfully changed!'], 201);
        }

        abort(403, 'Sorry, not sorry!');
    }

    /**
     * Update profile's logo
     *
     * @return void
     */
    public function changeLogo(Request $request)
    {
        $this->validate($request, [
            'logo' => 'required|image'
        ]);

        $this->salon()->saveLogo($this->storeLogo($request));

        if (request()->ajax()) {
            return response()->json(['status' => 'Logo is updated succesfully!'], 201);
        }

        abort(403, 'Sorry, not sorry!');
    }

    /**
     * Store a newly uploaded salon's logo
     *
     * @param Request $request
     * @return false|string
     */
    protected function storeLogo(Request $request)
    {
        if ($this->logoExists($this->salon())) {
            Storage::delete($this->salon()->logo);
        }

        return $request->file('logo')->store('public/logos');
    }

    /**
     * Checks if the current, non - default logo exists
     *
     * @param Salon $salon
     * @return bool
     */
    protected function logoExists()
    {
        return Storage::exists($this->salon()->logo) && $this->salon()->logo != 'public/logos/default.png';
    }
}
