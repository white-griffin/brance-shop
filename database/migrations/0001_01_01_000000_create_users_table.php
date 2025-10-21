<?php

use App\Constants\Constant;
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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->unique();
            $table->string('avatar')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('national_code')->nullable();
            $table->text('address')->nullable();
            $table->string('otp_code')->nullable();
            $table->enum('status', [
                Constant::ACTIVE,
                Constant::IN_ACTIVE,
            ])->default(Constant::IN_ACTIVE);
            $table->enum('auth_status', [
                Constant::ACTIVE,
                Constant::IN_ACTIVE,
            ])->default(Constant::IN_ACTIVE);
            $table->enum('gender', [
                Constant::MALE,
                Constant::FEMALE,
                Constant::OTHER
            ])->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
