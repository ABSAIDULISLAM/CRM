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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('name');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->enum('priority',[Status::High->value, Status::Medium->value,Status::Low->value])->nullable();
            $table->enum('status',[Status::Active->value, Status::Closed->value])->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('creator')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
