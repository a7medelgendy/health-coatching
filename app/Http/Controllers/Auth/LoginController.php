<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function verifyUser(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'The password field is required.',
        ]);

        // Get the user based on the email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid login details');
        }

        // Compare the password
        if (Hash::check($request->password, $user->password)) {
            // Password matches, so log in the user
            Auth::login($user);
            //save user data in session
            session(['user' => $user]);

            // Redirect the user based on the role
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('customer.profile');
            }
        } else {
            // Password does not match
            return redirect()->back()->with('error', 'Invalid login details');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
