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
        $table->id();
        $table->string('id')->index();
        $table->string('appointment_service');
        $table->date('appointment_date');
        $table->time('appointment_time');
        $table->timestamps();
    });
}


    public function down()
    {
        
    }
};
