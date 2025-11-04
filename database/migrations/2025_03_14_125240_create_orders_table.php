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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('discount_code_id')->nullable()->constrained('discount_codes')->cascadeOnDelete();
            $table->enum('status',[
                Constant::PENDING,
                Constant::PURCHASED,
                Constant::SHIPPING,
                Constant::DELIVERED,
                Constant::REJECTED
            ])->default(Constant::PENDING);
            $table->enum('delivery_status',[
                Constant::PENDING,
                Constant::SHIPPING,
                Constant::DELIVERED,
                Constant::REJECTED
            ])->default(Constant::PENDING);
            $table->double('order_amount')->default(0);
            $table->double('delivery_amount')->default(0);
            $table->double('discount_amount')->default(0);
            $table->double('total_amount')->default(0);
			$table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
