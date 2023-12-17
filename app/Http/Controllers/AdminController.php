<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFormRequest;
use App\Mail\NewBlogMail;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'blogs' => auth()->user()->blogs()->latest()->paginate(5)
        ]);
    }

    public function create()
    {
        return view('admin.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(BlogFormRequest $request)
    {
        $cleanData = $request->validated();
        $cleanData['user_id'] = auth()->id();
        if($request->has('new_cat'))
        {
            $newCategoryData = [
                'name' => $request->input('new_cat'),
                'slug' => $request->input('new_cat_slug')
            ];

            $newCategory = Category::create($newCategoryData);
            $cleanData['category_id'] = $newCategory->id;
        }
        $cleanData['photo'] = '/storage/' . request('photo')->store('/blogs');

        Blog::create($cleanData);
        
        $subscribers = Subscriber::all();

        foreach($subscribers as $subscriber){
            Mail::to($subscriber->email)->queue(new NewBlogMail($subscriber));
        }

        return redirect('/admin');
    }

    public function edit(Blog $blog)
    {
        return view('admin.edit',[
            'categories' => Category::all(),
            'blog' => $blog
        ]);
    }

    public function update(Blog $blog,BlogFormRequest $request)
    {
        $cleanData = $request->validated();

        if($request->has('new_cat'))
        {
            $newCategoryData = [
                'name' => $request->input('new_cat'),
                'slug' => $request->input('new_cat_slug')
            ];

            $newCategory = Category::create($newCategoryData);
            $cleanData['category_id'] = $newCategory->id;
        }
        
        if(request('photo')){
            $cleanData['photo'] = '/storage/' . request('photo')->store('/blogs');

            File::delete(public_path($blog->photo));
        }

        $blog->update($cleanData);

        return redirect('/admin');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back();
    }
}
