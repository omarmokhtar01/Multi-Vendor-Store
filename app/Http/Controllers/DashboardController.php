<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    // here i implemented the middleware  to check if the user is authenticated
    // instead of  using the middleware in the route
    // public function __construct()
    // {
    //     $this->middleware(['auth'])
        // make the middleware for all  the methods in this controller except index
        // ->except('index')
    //     ->only('index');
    // }


    public function index(){
        // $user = 'omar';
        // $title = 'mokhtar';


        // return view("dashboard",compact('user','title'));

        // return view("dashboard")->with(
        //     [
        //         'user'=>'omar',
        //         'title'=>'mokhtar'
        //     ]
        // );


        $user = Auth::user();

        // debug
        // dd($user);
        return view("dashboard/index",[
            'user'=>'omar',
            'title'=>'mokhtar'
        ]);

    }


}
