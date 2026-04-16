<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function show()
    {
        return view('dashboard.profile.index', [
            'user' => auth()->user(),
        ]);
    }

    public function edit()
{
    return view('dashboard.profile.edit', [
        'user' => auth()->user(),
    ]);
}

public function update(\Illuminate\Http\Request $request)
{
    $user = auth()->user();

    $data = $request->validate([
        'first_name' => 'required|string|max:20',
        'last_name' => 'required|string|max:20',
        'phone' => 'required|string|min:9|max:20',
        'gender' => 'required|in:male,female,other',
        'address' => 'required|string|min:5|max:100',
        'photo' => 'required|string|min:10|max:300',
    ]);

    $user->update($data);

    return redirect()->route('dashboard.profile.show')->with('status', 'Profile updated successfully.');
}

}
