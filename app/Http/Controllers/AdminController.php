<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Add any necessary logic for the admin dashboard here

        return view('admin.dashboard');
    }
}
