<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;

class JobPostingController extends Controller
{
    public function index()
{
    return inertia('JobPostings/Index', [
        'jobPostings' => JobPosting::with('skills')->get(),
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'company_name' => 'required',
        'experience' => 'required',
        'location' => 'required',
        'skills' => 'array',
    ]);

    $job = JobPosting::create($validated);

    if ($request->skills) {
        $job->skills()->sync($request->skills);
    }

    return redirect()->route('job-postings.index');
}

public function destroy($id)
{
    JobPosting::findOrFail($id)->delete();
    return redirect()->route('job-postings.index')->with('success', 'job deleted successfully!');
}
}
