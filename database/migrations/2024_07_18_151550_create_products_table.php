<?php

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
            $table->string('name');
            $table->string('hinh_anh')->nullable();
            $table->unsignedInteger('so_luong');
            $table->double('price', 20, 2);
            $table->date('ngay_nhap');
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            // tạo khóa ngoại
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
