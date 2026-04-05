<?php

namespace App\Http\Controllers;
use App\Mail\UserCredentialsMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            // get the data from the session
            $data = session('register_data', []);

            // just visiting step 3 — show the page
            if (!$request->isMethod('post') || !$request->has('submit')) {
                return redirect('/register');
            }

            // handle form submission
            if (!$request->has('agreement')) {
                return redirect()->back()
                    ->withErrors(['agreement' => 'You must agree to the terms and conditions.'])
                    ->withInput();
            }

            $validator = Validator::make($data, [
                'first_name' => 'required|string|max:20',
                'last_name'  => 'required|string|max:20',
                'email'      => 'required|email|unique:users,email',
                'photo'      => 'required|string|min:15|max:300',
                'gender'     => 'required|string|min:4|max:6',
                'phone'      => 'required|string|min:9|max:20',
                'address'    => 'required|string|min:10|max:50',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated_data = $validator->validated();

            // Generate a unique userID with 'VX' prefix and 6 random digits
            do {
                $validated_data['userID'] = 'VX' . rand(100000, 999999);
            } while (\App\Models\User::where('userID', $validated_data['userID'])->exists());


            $user = User::create($validated_data);

            if (!$user) {
                return redirect()->back()
                    ->withErrors(['registration' => 'Failed to create user. Please try again.'])
                    ->withInput();
            }

            session()->forget(['register_step', 'register_data']);

            $user->refresh();

            $userID   = $user->userID;

            Mail::to($user->email)->send(
                new UserCredentialsMail(
                    name: $user->first_name,
                    userId: $userID
                )
            );

            return redirect('/register/success');
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
                'userid' => 'required|string|size:8',
                'password' => 'nullable|string|min:6|max:20',
            ]
        );
        $user = User::where('userID', $credential['userid'])->first();

        if(!$user) {
            throw ValidationException::withMessages([
                'user' => ['Invalid user or password nf.'],
            ]);
        }
        
        if($user->password_set === 0) {
            // log the user in without password and redirect to reset password page
            Auth::login($user);
            // regenerate session to prevent fixation attacks
            $request->session()->regenerate();

            return redirect('/reset-password');
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
