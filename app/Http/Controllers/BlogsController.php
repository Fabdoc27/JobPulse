<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);
        $query = $request->input('search');
        $blogsQuery = Blog::query();

        if ($query) {
            $blogsQuery->where('title', 'like', '%'.$query.'%')
                ->orWhereJsonContains('tags', $query);
        }

        $blogs = $blogsQuery->latest()->paginate(5);

        return view('blogs.index', compact('user', 'blogs'));
    }

    public function create(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        return view('blogs.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'tags' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $fileNameToStore = 'blogs-'.md5(uniqid()).time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('blogs'), $fileNameToStore);
        }

        $tagsString = trim($request->input('tags'));
        $tagsArray = array_map('trim', explode(',', $tagsString));

        Blog::create([
            'title' => $request->input('title'),
            'img_url' => $fileNameToStore ?? null,
            'tags' => $tagsArray,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);
        $blog = Blog::findOrFail($id);

        return view('blogs.show', compact('user', 'blog'));
    }

    public function edit(Request $request, $id)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);
        $blog = Blog::findOrFail($id);

        return view('blogs.edit', compact('user', 'blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'tags' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->has('tags') && ! empty($request->input('tags'))) {
            $tagsString = trim($request->input('tags'));
            $tagsArray = array_map('trim', explode(',', $tagsString));
        } else {
            $tagsArray = $blog->tags;
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $fileNameToStore = 'blogs-'.md5(uniqid()).time().'.'.$image->getClientOriginalExtension();

            $oldFilePath = $blog->img_url ?? null;

            if ($oldFilePath && File::exists(public_path('blogs/'.$oldFilePath))) {
                File::delete(public_path('blogs/'.$oldFilePath));
            }

            $image->move(public_path('blogs'), $fileNameToStore);
        } else {
            $fileNameToStore = $blog->img_url ?? null;
        }

        $blog->update([
            'title' => $request->input('title'),
            'img_url' => $fileNameToStore ?? null,
            'tags' => $tagsArray,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog post Updated successfully.');
    }

    public function destroy(Request $request)
    {
        $blogId = $request->input('blog_id');
        $blog = Blog::findOrFail($blogId);

        if ($blog->img_url) {
            $imagePath = public_path('blogs/'.$blog->img_url);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
