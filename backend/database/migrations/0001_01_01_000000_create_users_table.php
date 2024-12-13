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
        Schema::create('user_register', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('register_email')->unique();
            $table->string('register_password');
            $table->string('register_phone');
            $table->timestamps();
        });
        Schema::create('user_login', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_register')->onDelete('cascade');
            $table->string('login_email');
            $table->string('login_phone');
            $table->string('login_password');
            $table->timestamps();
        });

    }
};
