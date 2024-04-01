<?php

use App\Enums\Status;
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
        Schema::create('invoice_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->integer('inv_id');
            $table->date('estimate_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('client_address')->nullable();
            $table->string('billing_address')->nullable();
            $table->decimal('subTotal')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('grand_total')->nullable();
            $table->decimal('service_fee')->nullable();
            $table->enum('renewType',[Status::Monthly->value, Status::Yearly->value])->nullable();
            $table->enum('status',[Status::Estimate->value, Status::Invoice->value])->nullable();
            $table->text('other_info')->nullable();
            $table->integer('creator')->nullable();
            $table->enum('payment_status',[Status::Paid->value, Status::Unpaid->value, Status::Partial->value])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_summaries');
    }
};
