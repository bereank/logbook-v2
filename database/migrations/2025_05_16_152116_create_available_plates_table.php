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
        Schema::create('available_plates', function (Blueprint $table) {
            $table->id();
            $table->string('chassis_number')->nullable();
            $table->string('series')->nullable();
            $table->string('watu-remarks')->nullable();
            $table->string('watu-registration')->nullable();
            $table->string('customer_name')->nullable();
            $table->text('remarks')->nullable();
            $table->string('registration_number')->unique();
            $table->enum('status', ['available', 'retrieved', 'allocated'])->default('available');
            $table->date('date_received')->nullable();
            $table->date('posting_date')->nullable();
            $table->string('bp_reference_no')->nullable();
            $table->string('type')->nullable()->default('branch');
            $table->boolean('logbook_available')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index('registration_number');
            $table->index('chassis_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('available_plates');
    }
};
