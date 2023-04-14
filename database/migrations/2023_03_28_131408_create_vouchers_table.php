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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('code of voucher');
            $table->bigInteger('value')->default(0);
            $table->bigInteger('require_money')->nullable()->comment('Điều kiện áp dụng');
            $table->string('description')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('count_use')->default(0);
            $table->timestamp('date_expired')->nullable();
            $table->boolean('status')->default(true)->comment('true: opening, false: closed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
