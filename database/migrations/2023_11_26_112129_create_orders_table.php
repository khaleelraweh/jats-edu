<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('ref_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('payment_method_id')->nullable()->constrained()->nullOnDelete();

            $table->double('subtotal')->default(0.00);
            $table->double('offer_discount')->default(0.00);
            $table->string('discount_code')->nullable();
            $table->double('discount')->default(0.00);
            $table->double('shipping')->default(0.00);
            $table->double('tax')->default(0.00);
            $table->double('total')->default(0.00);
            $table->string('currency')->default('USD');

            $table->string('bankAccNumber')->nullable();
            $table->string('bankReceipt')->nullable();

            $table->unsignedTinyInteger('order_status')->default(0);
            $table->dateTime('deleted_at')->nullable();
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
};
