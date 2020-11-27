<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(){
        $profile = Auth()->user()->profile;
        // dd($profile);
        return view('profile.edit', compact('profile'));
    }

    public function update(\App\Profile $profile){
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'min:6'],
            'address' => ['required', 'string', 'min:10'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'string', Rule::in(['Male', 'Female']),],
        ]);
        $profile->name = $data['name'];
        $profile->address = $data['address'];
        $profile->date_of_birth = $data['date_of_birth'];
        $profile->gender = $data['gender'];
        $profile->save();

        return redirect('/');

    }
}
