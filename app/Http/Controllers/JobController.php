<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return inertia('Jobs/Index', ['jobs' => Job::latest()->paginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        // if(!Auth::check()) {
        //     return redirect()->route('login');
        // }

        return inertia('Jobs/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        // Check for image
        if($request->hasFile('company_logo')) {
            // Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        $request->user()->jobListings()->create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): Response
    {
        return inertia('Jobs/Show', ['job' => $job, 'mapboxToken' => env('MAPBOX_API_KEY')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): Response
    {
        Gate::authorize('update', $job);

        return inertia('Jobs/Edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job): RedirectResponse
    {
        Gate::authorize('update', $job);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url'
        ]);

        // Check for image
        if($request->hasFile('company_logo')) {
            // Delete old logo
            Storage::disk('public')->delete($job->company_logo);

            // Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;
        } else {
            unset($validatedData['company_logo']);
        }

        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job, Request $request): RedirectResponse
    {
        Gate::authorize('delete', $job);

        // if logo, then delete it
        if($job->company_logo) {
            Storage::disk('public')->delete('company_logo');
        }

        $job->delete();

        if($request->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job listing deleted successfully!');
        }

        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully!');
    }

    public function search(Request $request): Response {
        $keywords = strtolower($request->input('keywords'));
        $location = strtolower($request->input('location'));

        $query = Job::query();

        if($keywords) {
            $query->where(function($q) use($keywords) {
                $q->where('title', 'like', "%{$keywords}%")->orWhere('description', 'like', "%{$keywords}%")->orWhere('tags', 'like', "%{$keywords}%");
            });
        }

        if($location) {
            $query->where(function($q) use($location) {
                $q->where('address', 'like', "%{$location}%")->orWhere('city', 'like', "%{$location}%")->orWhere('state', 'like', "%{$location}%")->orWhere('zipcode', 'like', "%{$location}%");
            });
        }

        $jobs = $query->paginate(12);

        return inertia('Jobs/Index', ['jobs' => $jobs, 'filters' => $request->only(['keywords', 'location'])]);
    }
}
