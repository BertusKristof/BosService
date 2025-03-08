<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * A migráció futtatásához végzett műveletek.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id(); // alapértelmezett auto-increment id
            $table->string('contact_name');
            $table->string('appointment_service')->nullable();
            $table->time('appointment_time')->nullable();
            $table->date('appointment_date')->nullable();
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
