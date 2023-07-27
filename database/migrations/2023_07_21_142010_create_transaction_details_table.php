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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('transactions_id')->unsigned();
            $table->foreign('transactions_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('products_id');
            $table->integer('price');
            // $table->integer('quantity');
            $table->string('code'); 

            // fitur belakangan
            // $table->string('shipping_status'); // PENDING/SHIPPING/SUCCESS
            // $table->string('resi'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
