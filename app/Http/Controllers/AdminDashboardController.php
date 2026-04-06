<?php

namespace App\Http\Controllers;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function allUsers()
    {
        if(!auth()->user()->role === 'admin') {
            return view('dashboards.user');
        } else {
            return view('dashboards.admin', [
                'users' => User::all()
            ]);
        }
    }
}
