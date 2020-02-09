<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\email_confirmation;
use App\User;
use App\country;
use Webpatser\Uuid\Uuid;
use Twilio\Rest\Client;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function home(){   
        return view('web/home');
    }

    public function subscribe(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);
        \Session::flash('alert-success','Congrs! Your registration was successfull');
        return view('web/home');
    }
    public function about(){
        return view('web/about');
    }

    public function lend(){
        return view('web/lend');
    }
    public function trade(){
        return view('web/trade');
    }
    public function investment(){
        return view('web/investment');
    }
    
    function register($email){
        try {
             decrypt($email);
        } catch (DecryptException $e) {
            return ("content isn't valid");
        }
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
        try {
            decrypt($request->owner);
       } catch (DecryptException $e) {
           return ("content isn't valid ".$e);
       }
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
                $user->id = (String) Uuid::generate();
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
                $user->enabled = true;
                $user->save();
                $title = ' Registeration  Completed';
                \Session::flash('alert-success','Congrs! Your registration was successfull');
                return view('alert',compact('title'));
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

    
    function sendSMS(Request $request){
        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'ACa83c7503f9d5ca2a144ecd34f2cc42e3';
        $auth_token = '541b46416a371e6db82c2c07d592a402';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+18305496299";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            // Where to send a text message (your cell phone?)
            $request->number,
            array(
                'from' => $twilio_number,
                'body' => 'You recieve this message from Nasser!'
            )
        );
    }
}
