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
        Schema::create('main_mf', function (Blueprint $table) {
            $table->id();
            $table->string('chassis_number')->unique();
            $table->date('posting_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('bp_reference_no')->nullable();
            $table->string('status')->nullable();
            $table->enum('type', ['branch', 'dealer'])->nullable();
            $table->string('registration_number')->nullable();
            $table->boolean('logbook_available')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->index('chassis_number');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_mf');
    }
};
