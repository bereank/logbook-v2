<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatched_plates', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number');
            $table->string('chassis_number');
            $table->string('dispatched_to');
            $table->date('dispatch_date');
            $table->text('remarks')->nullable();
            $table->string('status')->default('dispatched');

            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('registration_number');
            $table->index('chassis_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatched_plates');
    }
};
