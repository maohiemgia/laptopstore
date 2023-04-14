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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_address');
            $table->string('customer_phone_number');
            $table->integer('tax_fee')->default(0);
            $table->integer('shipping_fee')->default(0);
            $table->boolean('payment_type')->default(false)->comment('false: COD, true: online');
            $table->bigInteger('total_cost');
            $table->bigInteger('discount_value')->default(0)->nullable();
            $table->text('note')->nullable();
            $table->string('date_receive')->nullable()->comment('ngày nhận hàng');
            $table->integer('status')->default(1)->comment('0: canceled, 1: shipping, 2: completed');
            $table->timestamps();
            $table->softDeletes();
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
