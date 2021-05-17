<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Only allow guests to view login page
    public function __construct() {
        $this->middleware(['guest']);
    }

    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        // Validate
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return back()->with('status', 'Invalid login details');
        };

        return redirect()->route('dashboard');
    }
}
