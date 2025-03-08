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
        // if(!Schema::hasTable('appointments')){
        //     Schema::create('appointments', function (Blueprint $table) {
        //         $table->id('appointment_id'); 
        //         $table->string('contact_name'); 
        //         $table->date('appointment_date'); 
        //         $table->time('appointment_time'); 
        //         $table->string('contact_name');
        //         $table->timestamps();
        //     });
        // }

        if(!Schema::hasTable('user_register')){
        Schema::create('user_register', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('register_email')->unique();
            $table->timestamp('register_phone')->nullable();
            $table->string('register_password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
        
    if(!Schema::hasTable('user_login')){
        Schema::create('user_login', function (Blueprint $table) {
            $table->string('login_email')->unique();
            $table->string('login_phone')->nullable();
            $table->string('login_password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_register');
        Schema::dropIfExists('user_login');
        // Schema::dropIfExists('sessions');
    }
};
