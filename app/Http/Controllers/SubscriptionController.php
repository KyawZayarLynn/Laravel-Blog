<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    public function toggle(Blog $blog)
    {
        if($blog->isSubscribedBy(auth()->user()))
        {
            $blog->subscribedUsers()->detach(auth()->id());
        }
        else{
            $blog->subscribedUsers()->attach(auth()->id());
        }
        return back();
    }

    public function store()
    {
        request()->validate([
            'email' => ['required','email',Rule::unique('subscribers','email')],
        ]);

        Subscriber::create([
            'email' => request('email')
        ]);

        return back();
    }
}
