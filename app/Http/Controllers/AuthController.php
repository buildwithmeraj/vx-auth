<?php

namespace App\Http\Controllers;
use App\Mail\UserCredentialsMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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

            // add a random reset token for password setups
            $validated_data['reset_token'] = $this->generateToken(32);

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

    private function generateToken($length) {
        return Str::password($length ?? 8, true, true, false, false);
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

            return redirect('/reset-password?token=' . $user->reset_token);
        }

        Auth::login($user, $request->has('remember'));
        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    public function resetPassword(Request $request)
    {
        // get the token from the request
        $token = $request->input('reset_token');

        // validate the token
        if (!$token) {
            return redirect('/reset-password?token='.$token)->withErrors(['token' => 'Invalid or missing token.']);
        }

        // find the user with the matching reset token
        $user = User::where('reset_token', $token)->first();

        if (!$user) {
            return redirect('/reset-password?token='.$token)->withErrors(['token' => 'Invalid or expired token.']);
        }

        // get passwords from the request
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        if(!$password || !$confirm_password) {
            return redirect('/reset-password?token='.$token)->withErrors(['password' => 'Password and confirmation are required.']);
        }

        if($password !== $confirm_password) {
            return redirect('/reset-password?token='.$token)->withErrors(['password' => 'Passwords do not match.']);
        }

        // update the user's password and clear the reset token
        $user = User::find($user->id);
        $user->password = bcrypt($password);
        $user->password_set = 1;
        $user->reset_token = null;
        $user->save();

        // logout the user after password reset
        Auth::logout();

        return redirect('/login')->with('status', 'Password reset successful. Please log in with your new password.');
    }
}
