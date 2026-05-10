<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request): Response {
        return inertia('Dashboard/Index', ['jobs' => $request->user()->jobListings()->with('applicants')->get()]);
    }
}
