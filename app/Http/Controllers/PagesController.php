<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Models\Blog;
use App\Models\CompanyDetail;
use App\Models\Job;
use App\Models\JobCandidate;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function page(Request $request, $page)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        $pageContent = Page::where('page_name', $page)->first();

        return view('contents.create', compact('user', 'pageContent', 'page'));
    }

    public function pageContent(Request $request)
    {
        $request->validate([
            'page_name' => 'nullable|string',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'history' => 'nullable|string',
            'vision' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $pageName = $request->input('page_name');

        $data = [
            'page_name' => $pageName,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'history' => $request->input('history'),
            'vision' => $request->input('vision'),
        ];

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $fileNameToStore = 'pages-'.md5(uniqid()).time().'.'.$image->getClientOriginalExtension();

            $oldFilePath = Page::where('page_name', $pageName)->value('img_url');

            if ($oldFilePath && File::exists(public_path('pages/'.$oldFilePath))) {
                File::delete(public_path('pages/'.$oldFilePath));
            }

            $image->move(public_path('pages'), $fileNameToStore);

            $data['img_url'] = $fileNameToStore;
        }

        Page::updateOrCreate(['page_name' => $pageName], $data);

        return redirect()->back()->with('success', 'Page content updated successfully.');
    }

    public function homePage(Request $request)
    {
        $homeContent = Page::where('page_name', 'home')->first();

        $topCompanies = CompanyDetail::withCount('jobs')
            ->orderByDesc('jobs_count')
            ->take(5)
            ->get();

        $jobCategories = ['developer', 'designer', 'digital marketer', 'UI/UX', 'cyber security', 'other'];

        $recentJobs = Job::where('status', 'active')->where('deadline', '>', now())->latest();

        if ($request->has('category')) {
            $recentJobs->where('category', $request->category);
        }

        $latestJobs = $recentJobs->take(5)->get();

        return view('pages.home', compact('homeContent', 'topCompanies', 'latestJobs', 'jobCategories'));
    }

    public function jobPage(Request $request)
    {
        $jobCategories = ['developer', 'designer', 'digital marketer', 'UI/UX', 'cyber security', 'other'];

        $jobContent = Page::where('page_name', 'jobs')->first();

        $jobs = Job::where('status', 'active')->where('deadline', '>', now())->latest();

        if ($request->has('category')) {
            $jobs->where('category', $request->category);
        }

        if ($request->has('search')) {
            $searchQuery = $request->search;
            $jobs->where('title', 'like', '%'.$searchQuery.'%');
        }

        $jobs = $jobs->paginate(8);

        return view('pages.jobs', compact('jobs', 'jobCategories', 'jobContent'));
    }

    public function jobDetails(Job $job)
    {
        $isApplied = false;

        if (auth()->check()) {
            $candidateDetails = auth()->user()->candidateDetails;

            if ($candidateDetails) {
                $isApplied = JobCandidate::where('job_id', $job->id)
                    ->where('candidate_id', $candidateDetails->id)
                    ->exists();
            }
        }

        return view('pages.jobView', compact('job', 'isApplied'));
    }

    public function aboutPage()
    {
        $aboutContent = Page::where('page_name', 'about')->first();

        $topCompanies = CompanyDetail::withCount('jobs')
            ->orderByDesc('jobs_count')
            ->take(5)
            ->get();

        return view('pages.about', compact('aboutContent', 'topCompanies'));
    }

    public function contactPage()
    {
        $contactContent = Page::where('page_name', 'contact')->first();

        $topCompanies = CompanyDetail::withCount('jobs')
            ->orderByDesc('jobs_count')
            ->take(5)
            ->get();

        return view('pages.contact', compact('contactContent', 'topCompanies'));
    }

    public function visitorMail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $formData = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        $ownerEmail = env('OWNER_EMAIL');
        Mail::to($ownerEmail)->send(new ContactFormMail($formData));

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function blogPage(Request $request)
    {
        $query = $request->input('search');
        $blogsQuery = Blog::query();

        if ($query) {
            $blogsQuery->where('title', 'like', '%'.$query.'%')
                ->orWhereJsonContains('tags', $query);
        }

        $blogs = $blogsQuery->latest()->paginate(6);

        return view('pages.blogs', compact('blogs'));
    }

    public function blogDetails(Blog $blog)
    {
        return view('pages.blogDetails', compact('blog'));
    }
}
