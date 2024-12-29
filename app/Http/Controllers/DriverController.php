<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(Request $request) {
        if($request->has('status')) {
            $drivers = Driver::where('status', $request->status)->get();
            return successResponse("Drivers fetched successfully", $drivers);
        }

        if($request->has('rating')) {
            $drivers = Driver::where('rating', $request->rating)->get();
            return successResponse("Drivers fetched successfully", $drivers);  
        }

        $drivers = Driver::all();
        return successResponse("All drivers fetched successfully", $drivers);
    }

    public function addDriver(DriverRequest $request) {
        $driver = Driver::updateOrCreate([
            'name' => $request->name,
            'email' => $request->email
        ], $request->all());
        return successResponse("Driver added successfully", $driver);
    }

    public function updateDriver(Request $request, $driver_id) {
        $driver = Driver::findOrFail($driver_id);

        if($driver) {
            $driver->update($request->all());
        }
        return successResponse("Driver updated successfully", $driver);
    }

    public function deleteDriver($driver_id) {
        $driver = Driver::findOrFail($driver_id);

        $driver->delete();
        return successResponse("Action completed");
    }
}
