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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->float('cash');
            $table->integer('five_hundred')->nullable();
            $table->integer('fifty')->nullable();
            $table->integer('twenty')->nullable();
            $table->integer('ten')->nullable();
            $table->integer('five')->nullable();
            $table->integer('two')->nullable();
            $table->integer('one')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
