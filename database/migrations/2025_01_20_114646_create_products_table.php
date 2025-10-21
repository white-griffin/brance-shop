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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->double('price');
            $table->string('product_code')->nullable();
            $table->double('discount_percent')->default(0);
            $table->double('delivery_amount')->default(0);
            $table->string('slug')->unique()->nullable();
            $table->integer('quantity')->default(5);
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('canonical_url', 2048)->nullable();
            $table->enum('status' , [
                Constant::ACTIVE,
                Constant::IN_ACTIVE
            ])->default(Constant::ACTIVE);
            $table->enum('discount_status' , [
                Constant::ACTIVE,
                Constant::IN_ACTIVE
            ])->default(Constant::IN_ACTIVE);
            $table->enum('special_status' , [
                Constant::ACTIVE,
                Constant::IN_ACTIVE
            ])->default(Constant::IN_ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
