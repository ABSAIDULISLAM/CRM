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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_summary_id');
            $table->unsignedBigInteger('product_id');
            $table->string('description', 256)->nullable();
            $table->decimal('price', 10,2)->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('total')->nullable();
            $table->timestamps();
            // $table->foreign('invoice_summary_id')->references('id')->on('invoice_summaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
