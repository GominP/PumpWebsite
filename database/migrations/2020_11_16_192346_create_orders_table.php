<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
//            $table->foreignId('product_id')->nullable()->constrained('products');
//            $table->integer('order_number')->nullable();
            $table->integer('order_number')->nullable();
            $table->enum('status',['ตะกร้า','รอการยืนยัน','กำลังจัดส่ง','เรียบร้อย']);
            $table->date('order_start_date')->nullable();
            $table->date('order_end_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
