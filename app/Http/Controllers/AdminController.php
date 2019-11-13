<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deposit;
use App\User;
use App\issue;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    //
    public function __construct(){
        $this->middleware('admin');
    }
    function home(){
        $tickets = issue::orderBy('created_at','desc')->get();
        $deposits = deposit::orderBy('created_at','desc')->orderBy('status','asc')->get();
        return view('admin/home');
    }
    function deposits(){
        $deposits = deposit::orderBy('created_at','desc')->orderBy('status','asc')->get();
        return view('admin/deposits',compact('deposits'));
    }
    function confirmDeposit(Request $request){
        if($request->deposit_id){
            $deposit = deposit::find($request->deposit_id);
            if($deposit){
                $deposit->status = true;
                $deposit->confirmedBy = Auth::user()->id;
                $deposit->save();
                return 'true';
            } else {
                return "there is not such deposit";
            }
        } else {
            return $request->deposit_id;
        }
        return 'false';
    }
    function users(){
        $users = User::orderBy('isAdmin','desc')->get();
        return view('admin/users',compact('users'));
    }
    function tickets(){
        $tickets = issue::orderBy('created_at','desc')->get();
        return view('admin/tickets',compact('tickets'));
    }
}
