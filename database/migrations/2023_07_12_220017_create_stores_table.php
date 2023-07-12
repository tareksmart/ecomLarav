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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();//حقل مميز يتبع نظام ceo بيظهر فى اللينك ويعمل ك id
            $table->text('description')->nullable();
            $table->string('logoImage')->nullable();
            $table->string('coverImage')->nullable();
            $table->enum('status',['active','inactive'])->default('active');//حالة المخزن نشط او غير نشط
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
