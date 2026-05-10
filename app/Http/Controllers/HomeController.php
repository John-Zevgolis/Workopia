<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response {
        return inertia('Index/Index', ['jobs' => Job::latest()->limit(6)->get()]);
    }
}
