<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegistrationForm(Request $request)
    {
        // return view according to the current step stored in session
        return view('auth.register', [
            'step' => session('register_step', 1),
            'data' => session('register_data', [])
        ]);
    }
    public function registrationProcess(Request $request) {
        // get the target step from the request
        $targetStep = (int) $request->input('step');

        // validate the target step
        if (!in_array($targetStep, [1, 2, 3])) {
            $targetStep = 1;
        }

        // get current session data and merge with new data from the request
        $existingData = session('register_data', []);
        $newData = $request->except('_token', 'step');

        // merge new data into the session
        session(['register_data' => array_merge($existingData, $newData)]);

        // Set the session step to the target step
        session(['register_step' => $targetStep]);

        // if it is the final step
        if ($targetStep == 3) {
            $data = session('register_data', []);

            if (!$request->has('agreement')) {
                return redirect()->back()
                    ->withErrors(['agreement' => 'You must agree to the terms and conditions.'])
                    ->withInput();
            }

            // now validate all the data before creating the user
            $validator = Validator::make($data, [
                'first_name' => 'required|string|max:20',
                'last_name' => 'required|string|max:20',
                'email' => 'required|email|unique:users,email',
                'photo' => 'required|string|min:15|max:300',
                'gender' => 'required|string|min:4|max:6',
                'phone' => 'required|string|min:9|max:20',
                'address' => 'required|string|min:10|max:50',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // prepare validated data for user creation
            $validated_data = $validator->validated();

            // create the user
            $user = User::create($validated_data);

            if($user) {
                // clear the session data after successful registration
                session()->forget(['register_step', 'register_data']);

                // get updated user data to send email with the userID and password
                $user->refresh();

                // get userID and password from the created user
                $userID = $user->userID;
                $password = $user->default_password;

                // redirect to the success page
                return redirect('/register/success');
            } else {
                return redirect()->back()
                    ->withErrors(['registration' => 'Failed to create user. Please try again.'])
                    ->withInput();
            }
        }

        return redirect('/register');
    }


    public function showLoginForm(Request $request)
    {
        // return view according to the current step stored in session
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {

        $credential = $request->validate(
            [
                'user' => 'required|string|size:8',
                'password' => 'required|string|min:6|max:20',
            ]
        );
        $user = User::where('userID', $credential['user'])->first();

        if(!$user) {
            throw ValidationException::withMessages([
                'user' => ['Invalid user or password.'],
            ]);
        }

        if($user->password === "") {
            throw ValidationException::withMessages([
                'user' => ['Password was not set, please check your the email to set your pa.'],
            ]);
        }

        if(!Auth::attempt($credential, true))  {
            throw ValidationException::withMessages([
                'user' => ['Invalid user or password.'],
            ]);
        }
        $request->session()->regenerate();

        return redirect('/login');
    }
}
