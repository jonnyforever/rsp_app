<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){

        $user = User::find(Auth::user()->id);

        return view('profile.index', compact('user'));
    }

    public function update(Request $request, $id){

        $user = User::findOrFail($id);

        if(Auth::user()->id != $id){ 
            return redirect('/profile?e=1');
        }

        $user->update($request->all());

        return redirect('/profile?c=1');
    }

}
