<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function show(Request $request)
    {
        // return view according to the current step stored in session
        return view('auth.register', [
            'step' => session('register_step', 1),
            'data' => session('register_data', [])
        ]);
    }
    public function progress(Request $request) {
        // get the target step from the request
        $targetStep = (int) $request->input('step');

        // validate the target step
        if (!in_array($targetStep, [1, 2, 3])) {
            $targetStep = 1;
        }

        // merge new data into the session
        $existingData = session('register_data', []);
        $newData = $request->except('_token', 'step');
        session(['register_data' => array_merge($existingData, $newData)]);

        // Set the session step to the target step
        session(['register_step' => $targetStep]);

        // final step


        return redirect('/register');
    }
}
