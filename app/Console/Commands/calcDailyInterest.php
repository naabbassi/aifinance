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
        foreach($users as $user){
            $deposits = $user->deposit()->where('status',true)->get();
            if($deposits->count() > 0){
                $rid= (String) Uuid::generate();
                $revenue = new revenue;
                $revenue->id = $rid;
                $revenue->uid= $user->id;
                $revenue->type = "d";
                $revenue->status = true;
                $revenue->save();
                foreach($deposits as $deposit){
                    $revenue_item = new revenue_items;
                    $revenue_item->id = (String) Uuid::generate();
                    $revenue_item->rid = $rid;
                    $revenue_item->source = $deposit->id;
                    $revenue_item->amount = $deposit->amount * 0.02;
                    $revenue_item->status = true;
                    $revenue_item->save();
                }
            }
        }
        
    }
}
