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
        Schema::create('uploaded_data_logs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('chasisNumber')->nullable();
            $table->string('regNumber')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->dateTime('createdOn')->nullable();
            $table->string('createdBy')->nullable();
            $table->dateTime('updatedOn')->nullable();
            $table->string('updatedBy')->nullable();
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
        Schema::dropIfExists('uploaded_data_logs');
    }
};
