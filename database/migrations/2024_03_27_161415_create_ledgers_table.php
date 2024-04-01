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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('created_by');
            $table->integer('inv_id')->nullable();
            $table->date('date')->nullable();
            $table->tinyInteger('payment_method')->default(0);//0==cashon, 1 == bkash, 2== card
            $table->text('description')->nullable();
            $table->string('income_source')->nullable();
            $table->float('income')->default(0);
            $table->float('expense')->default(0);
            $table->enum('type',[Status::Income->value, Status::Expense->value])->nullable(); //1 == income, 2==expense
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
