<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeasurementsRequest;
use App\Models\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class MeasurementController extends Controller
{
    public function show(User $user)
    {
        // if (Gate::denies('view_measurements', $user->id)) {
        //     abort(401);
        // }

        if (Gate::allows('tailor')) {
            $measurements = $user->measurements()->where('tailor_id', Auth::id())->first();
            return view('measurements.index', compact('user', 'measurements'));
        }
        $measurements = $user->measurements()->first();
        return view('measurements.index', compact('user', 'measurements'));
    }
    public function store(MeasurementsRequest $request, User $user)
    {
        $measurement = $request->validated();

        // if the user is tailor
        if (Gate::allows('tailor')) {
            Measurement::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'tailor_id' => Auth::id(),
                ],
                $measurement
            );
            return redirect()->route('measurements.show', $user->id)->with('success', 'Measurement saved successfully!');
        }
        $measurementExists = Measurement::where('user_id', $user->id)
            ->whereNull('tailor_id')
            ->exists();

        if ($measurementExists) {
            // Update the existing measurement
            Measurement::update(
                ['user_id' => $user->id] +
                $measurement
            );
        } else {
            // Create a new measurement
            Measurement::create([
                'user_id' => $user->id,
            ] + $measurement);
        }
        return redirect()->route('measurements.show', $user->id)->with('success', 'Measurement saved successfully!');
    }
}
