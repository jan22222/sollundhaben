<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabulas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->foreignId('enterprise_id')->constrained()->cascadeOnDelete();
            $table->json('soll')->nullable(); //json
            $table->json('haben')->nullable(); 
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
        Schema::dropIfExists('tabulas');
    }
}
