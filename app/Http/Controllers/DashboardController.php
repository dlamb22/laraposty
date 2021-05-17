<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Check if user is logged in before showing dashboard
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index() {
        return view('member.dashboard');
    }
}
