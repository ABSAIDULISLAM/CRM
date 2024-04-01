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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->text('image')->nullable();
            $table->enum('role_as',[Status::Admin->value,Status::OfficeStaff->value,Status::MarketingStaff->value,Status::User->value])->default(Status::User->value);
            $table->string('password');
            $table->enum('status',[Status::Active->value,Status::Deactive->value])->default(Status::Active->value);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('referrer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
