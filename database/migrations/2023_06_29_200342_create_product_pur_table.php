<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_pur', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->decimal('pro_purch_price');
            $table->date('arrive_date');
            $table->timestamps();
            $table->unsignedBigInteger('usId');

            $table->foreign('usId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_pur');
    }
};
