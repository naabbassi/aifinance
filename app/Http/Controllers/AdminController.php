<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\deposit;
use App\User;
use App\issue;
use App\issue_message;
use App\faq;
use App\revenue;
use App\revenue_items;
use App\withdraw;
use App\country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;
class AdminController extends Controller
{
    private $netDepositReward = false;
    public function __construct(){
        $this->middleware('admin');
        setlocale(LC_MONETARY, 'en_US');
    }
    function home(){
        $tickets = issue::orderBy('created_at','desc')->get();
        $depositsAmount = deposit::where('status',true)->sum('amount');
        $interests = revenue::where('type','d')->where('status',true)->get();
        $interestsAmount = 0;
        foreach ($interests as $item) {
            $interestsAmount += $item->items()->sum('amount');
        }
        $rewards = revenue::where('type','r')->where('status',true)->get();
        $rewardsAmount = 0;
        foreach ($rewards as $item) {
            $rewardsAmount += $item->items()->sum('amount');
        }
        $netRewards = revenue::where('type','nr')->where('status',true)->get();
        $netRewardsAmount = 0;
        foreach ($netRewards as $item) {
            $netRewardsAmount += $item->items()->sum('amount');
        }
        $deposits = deposit::where('status',false)->orderBy('created_at','desc')->get();
        $tickets = issue::where('status',true)->orderBy('created_at','desc')->get();
        return view('admin/home',compact('depositsAmount','interestsAmount','rewardsAmount','netRewardsAmount','deposits','tickets'));
    }
    function deposits(){
        $deposits = deposit::orderBy('created_at','desc')->orderBy('status','asc')->get();
        $depositsSum = $deposits->sum('amount');
        return view('admin/deposits',compact('deposits','depositsSum'));
    }
    function confirmDeposit(Request $request){
        if($request->deposit_id){
            $deposit = deposit::find($request->deposit_id);
            if($deposit){
                $deposit->status = true;
                $deposit->confirmedBy = Auth::user()->id;
                $deposit->save();
                self::checkNetReward();
                if($deposit->amount >= 1000 && self::$netDepositReward == true){
                    self::submitNetDepositReward($deposit);
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
    function submitNetDepositReward($deposit){
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

    function withdraw(){
        $withdraw = withdraw::orderBy('created_at','desc')->orderBy('status','asc')->paginate(15);
        return view('admin/withdraw',compact('withdraw'));
    }
    function withdrawDetails(Request $request){
        $withdraw = withdraw::find($request->id);
        return $withdraw->toJson();
    }
    function withdrawConfirm(Request $request){
        $withdraw = withdraw::find($request->id);
        // $withdraw->approvedBy = Auth::user()->id;
        $withdraw->status = 1;
        $withdraw->paid_at = date('Y-m-d');
        $withdraw->save();
        return 'true';
    }
    function users(){
        $users = User::orderBy('isAdmin','desc')->get();
        return view('admin/users',compact('users'));
    }
    function userDetails(Request $request){
        $user = User::find($request->id);
        $countries = country::all();
        return view('admin/user_details',compact('user','countries'));
    }
    function disableUser($userId){
        $user = User::find($userId);
        $user->enabled = !$user->enabled;
        $user->save();
    }
    function updateProfile(Request $request, $userId){
        $request->validate([
            'name' => 'required|min:3|max:20',
            'family' => 'required|min:3|max:20',
            'birthday' => 'required',
            'sex' => 'required',
            'country' => 'required',
            'phone' => 'required'
        ]);

        $user = User::find($userId);
        $user->name = $request->name;
        $user->family = $request->family;
        $user->birthday = $request->birthday;
        $user->sex = $request->sex;
        $user->country = $request->country;
        $user->phone = $request->phone;
        $user->isAdmin = $request->is_admin == 'on' ? 1 : 0;
        $user->save();
        \Session::flash('alert-success',"User's personal information successfuly updated");
        return redirect('/admin/users');
    }
    function tickets(){
        $tickets = issue::orderBy('created_at','desc')->get();
        return view('admin/tickets',compact('tickets'));
    }
    function showTicket(Request $request){
        $ticket = issue::find($request->ticketId);
        $messages = $ticket->messages()->orderBy('created_at','asc')->get();
        return view('admin/ticketDetails',compact('ticket','messages'));
    }
    function submitTicketDetail(Request $request, $ticketId){
            $issue_msg = new  issue_message;
            $issue_msg->id = (String)Uuid::generate();
            $issue_msg->issue_id = $ticketId;
            $issue_msg->type = 's';
            $issue_msg->message = $request->message;
            $issue_msg->save();
            return redirect('/admin/tickets/'.$ticketId);
    }
    function faq(){
        $faq = faq::all();
        return view('admin/faq',compact('faq'));
    }
    function faqNew(Request $request){
        if($request->id == 0 ){
            $faq = new faq;
        } else {
            $faq = faq::find($request->id);
        }
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return 'true';
    }
    function getFaqById($id){
        return faq::find($id)->toJson();
    }
    // Network Reward
    function checkNetReward(){ 
        $users = User::all();
        foreach ($users as $user) {
            if($user->network()->count() == 3){
                $nrCount = revenue::where('uid',$user->id)->where('status',true)->where('type','nr')->count();
                $net = $user->network;
                $u1 = self::getNetDeposit($net[0]->id);
                $u2 = self::getNetDeposit($net[1]->id);
                $u3 = self::getNetDeposit($net[2]->id);
                $goal = ($nrCount +1) * 5000;
                if($u1 >= $goal && $u2 >= $goal && $u3 >= $goal){
                    self::submitNetReward($user);
                }
            }
        }
    }

    function submitNetReward($user){
        $rid= (String) Uuid::generate();
        $revenue = new revenue;
        $revenue->id = $rid;
        $revenue->uid= $user->id;
        $revenue->type = "nr";
        $revenue->description = "Network Range Reward";
        $revenue->status = true;
        $revenue->save();
        $revenue_item = new revenue_items;
        $revenue_item->id = (String) Uuid::generate();
        $revenue_item->rid = $rid;
        $revenue_item->source = $rid;
        $revenue_item->amount = 1000;
        $revenue_item->status = true;
        $revenue_item->save();
         dd($revenue_item);
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
    function changeUserPassword(Request $request,$userId){
        $request->validate([
            'password' => 'required|min:8|confirmed'
        ]);
            $user = User::find($userId);
            $user->password = Hash::make($request->password);
            $user->save();
            \Session::flash('alert-success','Your password updated successfuly');
            return redirect('/admin/users/');
    }
    
}
