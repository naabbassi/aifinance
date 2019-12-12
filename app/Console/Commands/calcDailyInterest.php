<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\deposit;
use App\revenue;
use App\revenue_items;
use Webpatser\Uuid\Uuid;
class calcDailyInterest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:calcDailyInterest';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::where('type',true)->get();
        $dailyDepositInterestRate = 0.0025;
        $dailyNetInterestRate =  0.05;
        foreach($users as $user){
            $deposits = $user->deposit()->where('status',true)->get();
            if($deposits->count() > 0){
                $rid= (String) Uuid::generate();
                $revenue = new revenue;
                $revenue->id = $rid;
                $revenue->uid= $user->id;
                $revenue->type = "d";
                $revenue->description = "Daily Deposit Interest and Network Interest";
                $revenue->status = true;
                $revenue->save();
                foreach($deposits as $deposit){
                    $revenue_item = new revenue_items;
                    $revenue_item->id = (String) Uuid::generate();
                    $revenue_item->rid = $rid;
                    $revenue_item->source = $deposit->id;
                    $revenue_item->amount = $deposit->amount * $dailyDepositInterestRate;
                    $revenue_item->status = true;
                    $revenue_item->save();
                }  
            }
            $net = self::getNetDeposit($user->id);
                $net = $net - $user->deposit()->where('status',true)->sum('amount');
                if($net > 0){
                    $revenue_item = new revenue_items;
                    $revenue_item->id = (String) Uuid::generate();
                    $revenue_item->rid = $rid;
                    $revenue_item->source = 'Network Deposits Interest';
                    $revenue_item->amount = $net * $dailyDepositInterestRate * $dailyNetInterestRate;
                    $revenue_item->status = true;
                    $revenue_item->save();
                } 
        }
    }
    
    private function getNetDeposit($id){
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
}
