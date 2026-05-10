<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class BookmarkController extends Controller
{
    public function index(Request $request): Response {
        $user = $request->user();

        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);

        return inertia('Jobs/Bookmarked', ['bookmarks' => $bookmarks]);
    }

    public function store(Job $job, Request $request): RedirectResponse {
        $user = $request->user();

        // Check if the job is already bookmarked
        if($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is already bookmarked');
        }

        // Create new bookmark
        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('success', 'Job bookmarked successfully!');
    }

    public function destroy(Job $job, Request $request): RedirectResponse {
        $user = $request->user();

        // Check if the job is not bookmarked
        if(!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is not bookmarked');
        }

        // Remove bookmark
        $user->bookmarkedJobs()->detach($job->id);

        return back()->with('success', 'Bookmark removed successfully!');
    }
}
