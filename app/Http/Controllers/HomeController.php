<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deposit;
use App\wallet;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function dashboard(){
        return view('dashboard');
    }
    function deposit(){
        $deposits = deposit::where('uid', 1)->get();
        return view('deposit',compact('deposits'));
    }
    function history(){
        return view('history');
    }
    function wallet(){
        $id = Auth::id();
        $wallets = wallet::where('uid',$id)->get();
        return view('wallet',compact('wallets'));
    }
    function newWallet(Request $request){
        $request->validate([
            'title' => 'required|max:20',
            'address' => 'required|unique:wallets|max:50',
            'description' => 'nullable',
        ]);
        $wallet = new wallet;
        $wallet->uid = Auth::user()->id;
        $wallet->title = $request->title;
        $wallet->address = $request->address;
        $wallet->description = " ";
        $wallet->save();
        return redirect('finance/wallet');
    }
    function updateWallet(Request $request,$id){
        $request->validate([
            'title' => 'required|max:20',
            'address' => 'required|max:50',
            'description' => 'nullable',
        ]);
        $wallet = wallet::find($id);
        $wallet->title = $request->title;
        $wallet->address = $request->address;
        $wallet->save();
        return redirect('finance/wallet');
    }
    function editWallet($id){
        $wallet = wallet::where('uid',Auth::user()->id)->where('id',$id)->first();
        return view('walletEdit',compact('wallet'));
    }
    function network(){
        return view('network');
    }
}
