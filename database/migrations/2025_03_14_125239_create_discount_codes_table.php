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
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->enum('discount_type',[
                Constant::AMOUNT,
                Constant::PERCENT
            ])->default(Constant::AMOUNT);
            $table->string('discount_percent')->nullable();
            $table->double('discount_amount')->nullable();
            $table->date('expire_date');
            $table->integer('capacity')->default(100);
            $table->text('description')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status',[
                Constant::ACTIVE,
                Constant::IN_ACTIVE
            ])->default(Constant::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_codes');
    }
};
