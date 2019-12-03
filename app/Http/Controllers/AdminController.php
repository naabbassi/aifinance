<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deposit;
use App\User;
use App\issue;
use App\faq;
use App\revenue;
use App\revenue_items;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;
class AdminController extends Controller
{
    //
    public function __construct(){
        // $this->middleware('admin');
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
                if($deposit->amount >= 1000){
                    self::submitReward($deposit);
                }
                return 'true';
            } else {
                return "there is not such deposit";
            }
        } else {
            return $request->deposit_id;
        }
        return 'false';
    }
    function submitReward($deposit){
        if($deposit){
            $rid= (String) Uuid::generate();
            $user = User::find($deposit->uid);
            $owner = User::where('email','=', $user->owner)->first();
            $revenue = new revenue;
            $revenue->id = $rid;
            $revenue->uid= $owner->id;
            $revenue->type = "r";
            $revenue->description = "Reward due network deposit";
            $revenue->status = true;
            $revenue->save();
            // save details
            $revenue_item = new revenue_items;
            $revenue_item->id = (String) Uuid::generate();
            $revenue_item->rid = $rid;
            $revenue_item->source = $deposit->id;
            $revenue_item->amount = $deposit->amount * 0.10;
            $revenue_item->status = true;
            $revenue_item->save();
        }
    }
    function checkDepositReward(){
        $rid= (String) Uuid::generate();
        $user = User::find($deposit->uid);
        $owner = User::where('email','=', $user->owner)->first();
    }
    function users(){
        $users = User::orderBy('isAdmin','desc')->get();
        return view('admin/users',compact('users'));
    }
    function tickets(){
        $tickets = issue::orderBy('created_at','desc')->get();
        return view('admin/tickets',compact('tickets'));
    }
    function faq(){
        $faq = faq::all();
        return view('admin/faq',compact('faq'));
    }
    lengh
}
