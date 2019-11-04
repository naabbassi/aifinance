<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deposit;
use App\User;
use App\issue;

class AdminController extends Controller
{
    //
    public function __construct(){

    }
    function home(){
        return view('admin/home');
    }
    function deposits(){
        $deposits = deposit::orderBy('created_at','desc')->orderBy('status','asc')->get();
        return view('admin/deposits',compact('deposits'));
    }
    function users(){
        $users = User::get();
        return view('admin/users',compact('users'));
    }
    function tickets(){
        $tickets = issue::orderBy('created_at','desc')->get();
        return view('admin/tickets',compact('tickets'));
    }
}
