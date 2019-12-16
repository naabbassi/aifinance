<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Deposit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('uid');
            $table->decimal('btc');
            $table->decimal('amount',13,2);
            $table->string('type');
            $table->string('wallet');
            $table->longText('description')->nullanle();
            $table->boolean('status')->default(0);
            $table->uuid('confirmedBy')->default(0);
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
        Schema::dropIfExists('deposit');
    }
}
