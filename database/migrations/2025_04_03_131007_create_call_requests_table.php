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
        Schema::create('call_requests', function (Blueprint $table) {
            $table->id();
            $table->string('client_first_name')->nullable();
            $table->string('client_last_name')->nullable();
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('title');
            $table->text('description');
            $table->enum('status',[
                Constant::PENDING,
                Constant::REJECTED,
                Constant::CONFIRMED
            ])->default(Constant::PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_requests');
    }
};
