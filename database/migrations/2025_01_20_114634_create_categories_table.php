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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->text('description')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('canonical_url', 2048)->nullable();
            $table->enum('status' , [
                Constant::ACTIVE,
                Constant::IN_ACTIVE
            ])->default(Constant::ACTIVE);
            $table->enum('type',[
                Constant::PRODUCT,
                Constant::BLOG
            ])->default(Constant::PRODUCT);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
