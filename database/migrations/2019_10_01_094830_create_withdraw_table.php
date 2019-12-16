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
            $table->decimal('amount',13,2);
            $table->string('type');
            $table->uuid('wallet_id');
            $table->uuid('deposit_id');
            $table->date('paid_at')->nullable();
            $table->uuid('approverdBy')->nullable();
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
