<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\deposit;
use App\wallet;
use App\revenue;
use App\revenue_items;
use App\User;
use App\country;
use App\withdraw;
use App\issue;
use App\issue_message;
use App\faq;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    static $userNetDeposit = array();
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('enabledUser');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function dashboard(){
        $myDeposits = Auth::user()->deposit()->where('status', true)->orderBy('created_at','asc')->get();
        $myRevenues = Auth::user()->revenue()->where('type','d')->where('status',true)->orderBy('created_at','asc')->get();
        $myRewards = Auth::user()->revenue()->orderBy('created_at','asc')->get();
        $rewardAmount = self::sumReward();
        $revenueAmount = self::sumRevenue();
        $depositAmount = $myDeposits->sum('amount');
        $depositDate="";
        $depositValue=""; 
        foreach ($myDeposits as $value) {
            $depositDate .= date_format($value->created_at,"d-m-Y").",";
            $depositValue .= $value->amount.',';
        }
        $revenueDate="";
        $revenueValue=""; 
        foreach ($myRevenues as  $revenue) {
            $revenueDate .= date_format($revenue->created_at,"d-m-Y").",";
            $revenueValue .= $revenue->items()->where('status',true)->sum('amount').',';
        }
        $rewardDate="";
        $rewardValue=""; 
        foreach ($myRewards as $value) {
            $rewardDate .= date_format($value->created_at,"d-m-Y").",";
            $rewardValue .= $value->items->sum('amount').',';
        }
        $networkDeposit = self::getUserNetDeposits(Auth::user()->id);
        sort($networkDeposit);
        $netDepositDate="";
        $netDepositValue=""; 
        foreach ($networkDeposit as $value) {
            $netDepositDate .= date_format($value->created_at,"d.M.y").",";
            $netDepositValue .= $value->amount.',';
        }
      
        return view('dashboard',compact('depositDate','depositValue','revenueValue','revenueDate','depositAmount','revenueAmount','rewardDate','rewardValue','rewardAmount','netDepositDate','netDepositValue'));
    }
    function getUserNetDeposits($id){
        $user = User::find($id);
        $net = $user->network;
        $deposits = $user->deposit()->where('status',true)->get();
        foreach($deposits as $deposit){
           self::$userNetDeposit[$deposit->id] = $deposit;
        }
        if($net->count() != 0){
            foreach ($net as  $value) {
                self::getUserNetDeposits($value->id);
            }
        }
        return self::$userNetDeposit;
    }
    function deposit(){
        $deposit = Auth::user()->deposit();
        $deposits = $deposit->orderBy('created_at','desc')->paginate(10);
        $sum = $deposit->where('status', true)->sum('amount');
        return view('deposit',compact('deposits','sum'));
    }
    function submitDeposit(Request $request){
        if((!$request->btc > 0)){
            \Session::flash('alert-warning','it seems you have trouble either with internet connection or you submitted 0$ amount. Connection Error 204 ');
            return redirect('deposit');
        }
        $request->validate([
            'usd' => 'required',
            'wallet_address' => 'required|min:32',
            'usd' => 'required',
            'btc' => 'required'
        ]);
        if ($request->usd  >= 250) {
            $deposit = new deposit;
            $deposit->id = (String) Uuid::generate();
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
    function reports(){
        return view('reports');
    }
    function revenue(){
        $list = Auth::user()->revenue()->orderBy('created_at','desc')->paginate(10);
        $sum = self::sumRevenue() + self::sumReward();
        return view('revenue',compact('list','sum'));
    }
    function revenue_details(Request $request){
        if ($request->id ) {
            $revenue = Auth::user()->revenue()->find($request->id);
            $details = $revenue->items()->get();   
            return view('revenue_details',compact('revenue','details'));
        } else {
        return view('error/404');
    }
    }
    function withdraw(){
        $revenue = self::sumRevenue() + self::sumReward();
        $withdraw = Auth::user()->withdraw();
        $sum = $withdraw->sum('amount');
        $withdraws = $withdraw->paginate(5);
        $wallets = Auth::user()->wallet;
        $available = $revenue - $sum;
        return view('withdraw',compact('available','wallets','withdraws','sum'));
    }
    function sumRevenue(){
        $revenues = Auth::user()->revenue()->where('status',true)->where('type','d')->get();
        $sum = 0;
        foreach ($revenues as $item) {
            $sum =$sum + $item->items()->where('status',true)->sum('amount');
        }
        return $sum;
    }
    function sumReward(){
        $revenues = Auth::user()->revenue()->where('status',true)->where('type','!=','d')->get();
        $sum = 0;
        foreach ($revenues as $item) {
            $sum =$sum + $item->items()->where('status',true)->sum('amount');
        }
        return $sum;
    }
    function withdraw_deposit(Request $request){
        $request->validate([
            'amount' => 'required'
        ]);
        $revenueSum = self::sumRevenue() + self::sumReward();
        $withdrawSum = Auth::user()->withdraw()->sum('amount');
        $available = $revenueSum - $withdrawSum;
        if ($request->amount <= $available && $available >= 250) {
            $deposit = new deposit;
            $deposit_id = (String) Uuid::generate();
            $deposit->id = $deposit_id;
            $deposit->uid =  Auth::user()->id;
            $deposit->amount =  $request->amount;
            $deposit->btc =  '0';
            $deposit->type = 'w';
            $deposit->wallet = 0;
            $deposit->status = 0;
            $deposit->description =  "Desposit from revenue";
            $deposit->save();
            // save withdraw
            $withdraw = new withdraw;
            $withdraw->id = (String) Uuid::generate();
            $withdraw->uid = Auth::user()->id;
            $withdraw->amount = $request->amount;
            $withdraw->type = 'd';
            $withdraw->paid_at = date('Y-m-d H:i:s');
            $withdraw->wallet_id = 0;
            $withdraw->deposit_id = $deposit_id;
            $withdraw->description = $request->description . " ";
            $withdraw->status = 0;
            $withdraw->save();
            $request->session()->flash('alert-success', 'User was successful added!');
            \Session::flash('alert-success','successfully saved. It takes a while to be proccessed.');
            return redirect('finance/withdraw');
        }
        return redirect('finance/withdraw')->with('alert-warning','To deposit the minimum acceptable amount is 250$ - your available amount is: '.$available.'$');
    }
    function withdraw_wallet(Request $request){
        $request->validate([
            'amount' => 'required',
            'wallet' => 'required'
        ]);
        $revenueSum = self::sumRevenue() + self::sumReward();
        $withdrawSum = Auth::user()->withdraw()->sum('amount');
        $available = $revenueSum - $withdrawSum;
        if ($request->amount <= $available && $available > 50) {
            // save withdraw
            $withdraw = new withdraw;
            $withdraw->id = (String) Uuid::generate();
            $withdraw->uid = Auth::user()->id;
            $withdraw->amount = $request->amount;
            $withdraw->type = 'w';
            $withdraw->paid_at = date('Y-m-d H:i:s');
            $withdraw->wallet_id = $request->wallet;
            $withdraw->deposit_id = 0;
            $withdraw->status = 0;
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
        $wallet->id = (String) Uuid::generate();
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
        $sum = Auth::user()->deposit()->where('status',true)->sum('amount');
        $netDeposit = self::getNetDeposit(Auth::user()->id) - $sum;
        $netCount = self::getNetCount(Auth::user()->id);
        return view('network',compact('sum','netDeposit','netCount'));
    }
    public function getnet(Request $request){
        $user = User::find($request->id)->network;
        $result = "";
        $level = $request->level +1;
        foreach ($user as $value) {
            $deposit = User::find($value->id)->deposit()->where('status',true)->sum('amount');
            $netDeposit = self::getNetDeposit($value->id);
            $netPersons = self::getNetCount($value->id);
            $netDeposit = $netDeposit - $deposit;
            $result .='<div class="col-12 col-md-4 col-lg-4">
                            <div class="card card-primary" id="item" data-id="'.$value->id.'" data-level="'.$level.'">
                            <div class="card-header">
                                <h4>'.$value->name.'</h4>
                            </div>
                            <div class="card-body" >
                                <h6>Deposit : '.$deposit.'$</h6>
                                <h6>Network Deposit : '.$netDeposit.'$</h6>
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
        $sum = $user->deposit()->where('status',true)->sum('amount');
        if($net->count() != 0){
            foreach ($net as $value) {
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
            foreach ($net as $value) {
                $sum += self::getNetCount($value->id);
            }
        }
        return $sum;
    }
   
    //issues
    function issueSubmit(Request $request){
        $request->validate([
            'id' => 'required',
            'type' => 'required',
            'message' => 'required',
        ]);
        if($request->id != '0'){
            if(Auth::user()->issues()->where('item_id',$request->id)->where('status', true)->count() > 0){
                return "There is already registered an issue for this item, you can find more information in tickets page";
            }
        }
        $issue = new issue;
        $issue_id = (String)Uuid::generate();
        $issue->id = $issue_id;
        $issue->uid = Auth::user()->id;
        $issue->item_id = $request->id;
        $issue->type = $request->type;
        $issue->status = true;
        $issue->save();
        $issue_msg = new  issue_message;
        $issue_msg->id = (String)Uuid::generate();
        $issue_msg->issue_id = $issue_id;
        $issue_msg->type = 'u';
        $issue_msg->message = $request->message;
        $issue_msg->save();
        return 'true';
    }
    function tickets(){
        $issues = Auth::user()->issues()->select('id','status','type','created_at')->orderBy('status','desc')->orderBy('created_at','desc')->paginate(10);
        return view('tickets',compact('issues'));
    }
    function ticketDetail(Request $request){
        $ticket = Auth::user()->issues()->find($request->id);
        $messages = $ticket->messages()->orderBy('created_at','asc')->get();
        return view('ticketDetails',compact('ticket','messages'));
    }
    function newTicket(){
        return view('newTicket');
    }
    function closeIssue(Request $request){
        $issue = Auth::user()->issues()->find($request->id);
        $issue->status = false;
        $issue->save();
    }
    function submitDetail(Request $request,$id){
        if(Auth::user()->issues()->find($id)->status == true){
            $issue_msg = new  issue_message;
            $issue_msg->id = (String)Uuid::generate();
            $issue_msg->issue_id = $id;
            $issue_msg->type = 'u';
            $issue_msg->message = $request->message;
            $issue_msg->save();
            $ticket = Auth::user()->issues()->find($request->id);
            return redirect('/tickets/issue/open/'.$id);
        }
        return 'false';
    }
    function getProfile(){
        $user = Auth::user();
        $countries = country::all();
        return view('profile',compact('user','countries'));
    }
    function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:20',
            'family' => 'required|min:3|max:20',
            'birthday' => 'required',
            'sex' => 'required',
            'country' => 'required',
            'phone' => 'required'
        ]);

        $user = Auth::User();
        $user->name = $request->name;
        $user->family = $request->family;
        $user->birthday = $request->birthday;
        $user->sex = $request->sex;
        $user->country = $request->country;
        $user->phone = $request->phone;
        $user->save();
        \Session::flash('alert-success','Your personal information updated successfuly');
        return redirect('/user/profile');
    }
    function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed'
        ]);
        if(Auth::user()->password == Hash::check($request->current_password,Auth::user()->password)){
            $user = Auth::User();
            $user->password = Hash::make($request->password);
            $user->save();
            \Session::flash('alert-success','Your password updated successfuly');
            return redirect('/user/profile');
        } else {
            \Session::flash('alert-warning','Your entered current password is incorrect');
            return redirect('/user/profile');
        }
    }
    //Loan
    function loan(){
        if(Auth::user()->deposit()->where('status',true)->count() > 0){
            $datetime1 = Auth::user()->deposit()->where('status', true)->orderBy('created_at','asc')->first()->created_at;
            $datetime2 = date_create("now");
            $interval = $datetime1->diff($datetime2);
            $remained =  $interval->format('%R%a');
        } else {
            $remained = 0;
        }
        return view('loan',compact('remained'));
    }
    function faq(){
        $result = faq::get();
        return view('faq',compact('result'));
    }
    function downloads(){
        return view('downloads');
    }
}
