<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('payment_method');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total', 20, 2); // 15 là tổng số chữ số, 2 là số chữ số sau dấu thập phân
            $table->string('status')->default('pending');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
