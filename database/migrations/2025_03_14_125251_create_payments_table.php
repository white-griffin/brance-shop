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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->double('amount')->default(0);
            $table->string('transaction_id')->nullable();
            $table->string('payment_token')->nullable();
            $table->text('description')->nullable();
            $table->enum('gateway_name' , [
                Constant::ZARINPAL,
            ])->default(Constant::ZARINPAL);
            $table->enum('status', [
                Constant::CONFIRMED,
                Constant::REJECTED,
                Constant::PENDING,
            ])->default(Constant::PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
