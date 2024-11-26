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
        Schema::create('billed_products', function (Blueprint $table) {
            $table->id();
            $table->index('billing_id');
            $table->unsignedBigInteger('billing_id');
            $table->foreign('billing_id')->references('id')->on('billings')->onDelete('cascade');
            $table->string('product_id');
            $table->float('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billed_products');
    }
};
