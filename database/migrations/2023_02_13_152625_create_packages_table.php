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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('experience_id');
            $table->foreign('experience_id')->on('experiences')->references('id');

            $table->string('name');

            $table->integer('price');

            $table->text('description')->nullable();

            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();

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
        Schema::dropIfExists('packages');
    }
};
