<?php

namespace App\Http\Controllers;

use App\{Service, Employee};
use Auth;
use App\Http\Requests\UpdateService;
use Illuminate\Http\Request;

class ServicesController extends AppController
{
    /**
     * Display a listing of the Services
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('app.services.index', ['services' => $this->salon()->services]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'duration' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'description' => 'min:6'
        ]);

        $this->salon()->addService(new Service($request->all()));

        return redirect()->back()->with('alert', 'Service successfully stored!');
    }

    /**
     * Update the specified service in storage.
     *
     * @param UpdateService $request
     * @param $serviceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateService $request, Service $service)
    {
        $this->authorize('service-update', $service);

        $service->update($request->all());

        return redirect()->back()->with('alert', 'Service successfully updated!');
    }

    /**
     *  Atach or detach the specefied service to a employee
     *
     * @param $service
     * @param $employee
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function toggleService(Service $service, Employee $employee)
    {
        $this->authorize('service-toggle', [$service, $employee]);

        $service->employees()->toggle($employee->id);

        if (request()->ajax()) {
            return response()->json(['status' => 'Service successfully toggled!'], 201);
        }

        abort(403, 'Sorry, not sorry!');
    }

    /**
     * Display the specified service.
     *
     * @param $serviceId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Service $service)
    {
        $employees = $this->salon()->employees;

        $this->authorize('service-view', $service);

        return view('app.services.profile.show', compact('service', 'employees'));
    }

    /**
     * Remove the specified service from storage.
     *
     * @param $serviceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Service $service)
    {
        $this->authorize('service-delete', $service);

        $service->delete();

        return redirect()->back()->with('alert', 'Service successfully deleted!');
    }
}
