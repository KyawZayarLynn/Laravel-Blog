<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(){
        $cleanData = request()->validate([
            'name' => ['required','max:20'],
            'email' => ['required','email','max:40'],
            'username' => ['required','max:20'],
            'password' => ['required','min:8','max:20'],
            'confirmPassword' => ['required']
        ]);
        if($cleanData['password'] == $cleanData['confirmPassword']){
            $user = new User();
            $user->name = $cleanData['name'];
            $user->email = $cleanData['email'];
            $user->username = $cleanData['username'];
            $user->password = $cleanData['password'];
            $user->save();

            auth()->login($user);

            return redirect('/')->with('message','Welcome ' . $user->name);
        }
        return redirect()->back()->withErrors(['confirmPassword' => 'The passwords do not match.'])->withInput();
    }
}
