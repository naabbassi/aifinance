<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deposit;
use App\wallet;
use App\revenue;
use App\User;
use App\country;
use App\withdraw;
use App\issue;
use App\issue_message;
use App\Mail\email_confirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
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
        $myDeposits = Auth::user()->deposit()->where('status', true)->orderBy('created_at','asc')->get();
        $myRevenues = Auth::user()->revenue()->where('type','d')->orderBy('created_at','asc')->get();
        $myRewards = Auth::user()->revenue()->where('type','r')->orderBy('created_at','asc')->get();
        $rewardAmount = $myRewards->sum('amount');
        $revenueAmount = $myRevenues->sum('amount');
        $depositAmount = $myDeposits->sum('amount');
        $depositDate="";
        $depositValue=""; 
        foreach ($myDeposits as $key => $value) {
            $depositDate .= date_format($value->created_at,"d-m-Y").",";
            $depositValue .= $value->amount.',';
        }
        $revenueDate="";
        $revenueValue=""; 
        foreach ($myRevenues as $key => $value) {
            $revenueDate .= date_format($value->created_at,"d-m-Y").",";
            $revenueValue .= $value->amount.',';
        }
        $rewardDate="";
        $rewardValue=""; 
        foreach ($myRewards as $key => $value) {
            $rewardDate .= date_format($value->created_at,"d-m-Y").",";
            $rewardValue .= $value->amount.',';
        }
        return view('dashboard',compact('depositDate','depositValue','revenueValue','revenueDate','depositAmount','revenueAmount','rewardDate','rewardValue','rewardAmount'));
    }
    function deposit(){
        $deposit = Auth::user()->deposit();
        $deposits = $deposit->orderBy('created_at','desc')->paginate(10);
        $sum = $deposit->where('status', true)->sum('amount');
        return view('deposit',compact('deposits','sum'));
    }
    function submitDeposit(Request $request){
        $request->validate([
            'usd' => 'required',
            'wallet_address' => 'required|min:32'
        ]);
        if ($request->usd  >= 250) {
            $deposit = new deposit;
            $deposit->uid =  Auth::user()->id;
            $deposit->amount =  $request->usd;
            $deposit->wallet =  $request->wallet_address;
            $deposit->btc =  $request->btc;
            $deposit->type = 'd';
            $deposit->description =  "requested - online claimed";
            $deposit->save();
            \Session::flash('alert-success','Your request is registered successfully, it takes some minutes to be activated.');
            return redirect('deposit');
        }
        return redirect('deposit')->with('alert-warning','To deposit the minimum acceptable amount is 250$ ');

    }
    function history(){
        return view('history');
    }
    function revenue(){
        $revenue = Auth::user()->revenue();
        $sum = $revenue->sum('amount');
        $list = $revenue->orderBy('created_at','desc')->paginate(10);
        return view('revenue', compact('list','sum'));
    }
    function withdraw(){
        $revenue = Auth::user()->revenue()->sum('amount');
        $withdraw = Auth::user()->withdraw();
        $sum = $withdraw->sum('amount');
        $withdraws = $withdraw->paginate(5);
        $wallets = Auth::user()->wallet;
        $available = $revenue - $sum;
        return view('withdraw',compact('available','wallets','withdraws','sum'));
    }
    function withdraw_deposit(Request $request){
        $request->validate([
            'amount' => 'required'
        ]);
        $revenueSum = Auth::user()->revenue()->sum('amount');
        $withdrawSum = Auth::user()->withdraw()->sum('amount');
        $available = $revenueSum - $withdrawSum;
        if ($request->amount <= $available && $available >= 250) {
            $deposit = new deposit;
            $deposit->uid =  Auth::user()->id;
            $deposit->amount =  $request->amount;
            $deposit->btc =  '0';
            $deposit->type = 'w';
            $deposit->wallet = 0;
            $deposit->status = 1;
            $deposit->description =  "Desposit from revenue";
            $deposit->save();
            $deposit_Id = $deposit->id;
            // save withdraw
            $wallet = new withdraw;
            $wallet->uid = Auth::user()->id;
            $wallet->amount = $request->amount;
            $wallet->type = 'd';
            $wallet->paid_at = date('Y-m-d H:i:s');
            $wallet->wallet_id = 0;
            $wallet->status = '1';
            $wallet->deposit_id = $deposit_Id;
            $wallet->description = $request->description . " ";
            $wallet->save();
            $request->session()->flash('alert-success', 'User was successful added!');
            \Session::flash('alert-success','successfully saved.');
            return redirect('finance/withdraw');
        }
        return redirect('finance/withdraw')->with('alert-warning','To deposit the minimum acceptable amount is 250$ - your available amount is: '.$available.'$');
    }
    function withdraw_wallet(Request $request){
        $request->validate([
            'amount' => 'required',
            'wallet' => 'required'
        ]);
        $revenueSum = Auth::user()->revenue()->sum('amount');
        $withdrawSum = Auth::user()->withdraw()->sum('amount');
        $available = $revenueSum - $withdrawSum;
        if ($request->amount <= $available && $available > 50) {
            // save withdraw
            $withdraw = new withdraw;
            $withdraw->uid = Auth::user()->id;
            $withdraw->amount = $request->amount;
            $withdraw->type = 'w';
            $withdraw->paid_at = date('Y-m-d H:i:s');
            $withdraw->wallet_id = $request->wallet;
            $withdraw->status = 0;
            $withdraw->deposit_id = 0;
            $withdraw->description = $request->description . " ";
            $withdraw->save();
            $request->session()->flash('alert-success', 'User was successful added!');
            \Session::flash('alert-success','Congrs! Your request has been registered, we will process it sonn as possible');
            return redirect('finance/withdraw');
        }
        return redirect('finance/withdraw')->with('alert-warning','To withdraw on your wallet the minimum acceptable amount is 50$ - your available amount is: '.$available.'$');
    }
    function wallet(){
        $wallets = Auth::user()->wallet;
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
        \Session::flash('alert-success','New wallet has been added to your wallets');
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
        \Session::flash('alert-success','The wallet has been updated');
        return redirect('finance/wallet');
    }
    function editWallet($id){
        $wallet = Auth::user()->wallet()->find($id);
        return view('walletEdit',compact('wallet'));
    }
    function deleteWallet(Request $request){
        $wallet = Auth::user()->wallet()->find($request->id);
        if ($wallet) {
            $wallet->delete();
        }
    }
    function network(){
        $sum = Auth::user()->deposit()->sum('amount');
        $netDeposit = self::getNetDeposit(Auth::user()->id) - $sum;
        $netCount = self::getNetCount(Auth::user()->id);
        return view('network',compact('sum','netDeposit','netCount'));
    }
    public function getnet(Request $request){
        if($request->id > 10){
            return;
        }
        $user = User::find($request->id)->network;
        $result = "";
        $level = $request->level +1;
        foreach ($user as $key => $value) {
            $deposit = User::find($value->id)->deposit()->sum('amount');
            $netDeposit = self::getNetDeposit($value->id);
            $netPersons = self::getNetCount($value->id);
            $netDeposit = $netDeposit - $deposit;
            $result .='<div class="col-12 col-md-4 col-lg-4">
                            <div class="card card-primary" id="item" data-id="'.$value->id.'" data-level="'.$level.'">
                            <div class="card-header">
                                <h4>'.$value->name.'</h4>
                            </div>
                            <div class="card-body" >
                                <h6>Deposit : '.$deposit.'</h6>
                                <h6>Network Deposit : '.$netDeposit.'</h6>
                                <h6>Network Scale : '.$netPersons.'</h6>
                            </div>
                            </div>
                        </div>';
        }
        return $result;
    }
    function getNetDeposit($id){
        $user = User::find($id);
        $net = $user->network;
        $sum = $user->deposit()->sum('amount');
        if($net->count() != 0){
            foreach ($net as $key => $value) {
                $sum += self::getNetDeposit($value->id);
            }
        }
        return $sum;
    }
    function getNetCount($id){
        $user = User::find($id);
        $net = $user->network;
        $sum = $net->count();
        if($net->count() != 0){
            foreach ($net as $key => $value) {
                $sum += self::getNetCount($value->id);
            }
        }
        return $sum;
    }
    function register($email){
        if (User::where('email',decrypt($email))->count()) {
            if (User::where('owner',decrypt($email))->count() < 3) {
                $countries = country::all();
                return view('register',compact('email','countries'));
            } else {
                $title = 'Reistration failed';
                \Session::flash('alert-warning','Unfortunatley your inviter has reached maximal sub member');
                return view('alert',compact('title'));
            }
        }
        else {
            $title = 'Reistration failed';
            \Session::flash('alert-warning',"The invitation link isn't valid. to get a valid invitation link, please contact our support team.");
            return view('alert',compact('title'));
        }
    }
    function newMember(Request $request){
        if (User::where('email',decrypt($request->owner))->count()) {
            if (User::where('owner',decrypt($request->owner))->count() < 3) {
                $request->validate([
                    'name' => 'required|min:3|max:20',
                    'family' => 'required|min:3|max:20',
                    'birthday' => 'required',
                    'sex' => 'required',
                    'email' => 'required|unique:users|email',
                    'password' => 'required|min:8|confirmed',
                    'country' => 'required',
                    'phone' => 'required'
                ]);
                $user = new User;
                $user->name = $request->name;
                $user->family = $request->family;
                $user->birthday = $request->birthday;
                $user->sex = $request->sex;
                $user->owner = decrypt($request->owner);
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->country = $request->country;
                $user->phone = $request->phone;
                $user->type = true;
                $user->save();
                $title = ' Registeration  Completed';
                return view('alert',compact('title'))->with('alert-success','Congrs! Your registration was successfull');
            } else {
                $title = 'Reistration failed';
                \Session::flash('alert-warning','Unfortunatley your inviter has reached maximal sub member');
                return view('alert',compact('title'));
            }
        }
        else {
            $title = 'Reistration failed';
            \Session::flash('alert-warning',"The invitation link isn't valid. to get a valid invitation link, please contact our support team.");
            return view('alert',compact('title'));
        }
    }
    //issues
    function issueSubmit(Request $request){
        $request->validate([
            'id' => 'required',
            'type' => 'required',
            'message' => 'required',
        ]);
        $issue = new issue;
        if(Auth::user()->issues()->where('type',$request->type)->where('item_id',$request->id)->count() > 0){
            return "There is already registered an issue for this item, you can find more information in tickets page";
        }
        $issue->item_id = $request->id;
        $issue->uid = Auth::user()->id;
        $issue->type = $request->type;
        $issue->save();
        $issue_msg = new  issue_message;
        $issue_msg->issue_id = $issue->id;
        $issue_msg->type = $request->type;
        $issue_msg->message = $request->message;
        $issue_msg->save();
        return 'true';
    }
    function tickets(){
        $issues = Auth::user()->issues()->select('id','type','created_at')->orderBy('created_at','desc')->paginate(10);
        return view('tickets',compact('issues'));
    }
}
