<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    /*public function students(){
    	if(Auth::check()){
    		return view('/students');
    	} else {
    		return redirect('/login');
    	}
    }*/

    public function home(){
    	return view('home', [
            'parentRoute' => 'home',
        ]);
    }

    public function about(){
        return view('about');
    }

    public function test(){
        return view('test', [
            'students' => Student::paginate(13),
        ]);
    }
}
