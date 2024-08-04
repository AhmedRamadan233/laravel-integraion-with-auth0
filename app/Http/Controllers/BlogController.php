<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $name = $user->nickname ?? '';

        $blogs = Blog::with('images', 'user')->get();
        return view('index', compact('name', 'blogs'));
    }


    public function create()
    {
        $user = auth()->user();
        $user_id = $user->sid;

        return view('create', compact('user_id'));
    }



    public function store(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->sid;
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // التحقق من الصور

        ]);

        $blog = Blog::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');

                Image::create([
                    'blog_id' => $blog->id,
                    'image' => $path,
                ]);
            }
        }

        return  redirect()->route('blogs.index');
    }

    public function edit($id)
    {
        $user = auth()->user();

        $blog = Blog::findOrFail($id);
        return view('edit', compact('blog'));
    }



    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $user_id = $user->sid;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update([
            'user_id' => $user_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');

                Image::create([
                    'blog_id' => $blog->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }


    public function destroy($id)
    {
        $user = auth()->user();

        $blog = Blog::findOrFail($id);

        foreach ($blog->images as $image) {

            $image->delete();
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
