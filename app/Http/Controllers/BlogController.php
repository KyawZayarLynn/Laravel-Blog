<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use PDO;

class BlogController extends Controller
{
    public function index()
    {
            $filters = request(['category','search']);
            return view('blogs.index',[
                'blogs'  => Blog::with('category','author')
                ->filter($filters)
                ->latest()->paginate(3)
                ->withQueryString(),
            ]);
    }

    public function show(Blog $blog){
            return view('blogs.show',[
                'blog' => $blog,
                'randomBlogs' => Blog::inRandomOrder()->take(3)->get()
            ]);
        }
}
