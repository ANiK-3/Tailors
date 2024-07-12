<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Tailor;

class AppointmentController extends Controller
{
    public function show($id)
    {
        return view('appointments.show', ['tailor_id' => $id]);
    }
    public function create(Request $req)
    {
        $validatedData = $req->validate([
            'customer_id' => 'required|exists:users,id',
            'tailor_id' => 'required|exists:tailors,id',
            'appointment_date' => 'required|date',
            'fabric_provided_by_customer' => 'required|boolean',
        ]);

        $tailor = Tailor::find($validatedData['tailor_id']);
        $appointment = $tailor->appointments()->create([
            'customer_id' => $validatedData['customer_id'],
            'appointment_date' => $validatedData['appointment_date'],
            'status_id' => 2,
            'fabric_provided_by_customer' => $validatedData['fabric_provided_by_customer'],
        ]);

        return redirect()->route('home')->with('message', 'Appointment created successfully');
    }
    public function updateStatus()
    {
    }
}
