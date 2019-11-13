<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('uid');
            $table->double('amount');
            $table->string('type');
            $table->date('paid_at')->nullable();
            $table->uuid('wallet_id');
            $table->uuid('deposit_id');
            $table->string('description');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw');
    }
}
