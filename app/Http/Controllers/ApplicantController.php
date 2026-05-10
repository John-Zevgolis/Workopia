<?php

namespace App\Http\Controllers;

use App\Mail\JobApplied;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Inertia\View\Components\App;

class ApplicantController extends Controller
{
    public function store(Request $request, Job $job): RedirectResponse {
        // Check if user has already applied
        $existingApplication = Applicant::where('job_id', $job->id)->where('user_id', $request->user()->id)->exists();

        if($existingApplication) {
            throw ValidationException::withMessages([
                'error_message' => 'You have already applied to this job.',
            ]);
        }

        // Validate incoming data
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'contact_phone' => 'string',
            'contact_email' => 'required|string|email',
            'message' => 'string',
            'location' => 'string',
            'resume' => 'required|file|mimes:pdf|max:2048'
        ]);

        // Handle resume upload
        if($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            $validatedData['resume_path'] = $path;
        }

        // Store the application
        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        $application->user_id = $request->user()->id;
        $application->save();

        // Send email to owner
        Mail::to($job->user->email)->send(new JobApplied($application, $job));

        return redirect()->back()->with('success', 'Your application has beeen submitted!');
    }

    public function destroy( Applicant $applicant): RedirectResponse {
        $applicant->delete();

        return redirect()->route('dashboard')->with('success', 'Applicant deleted successfully!');
    }
}
