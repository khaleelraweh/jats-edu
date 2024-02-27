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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('product_name');
            $table->json('slug');
            $table->json('description');
            $table->integer('quantity')->nullable()->default(-1); // سالب واحد تعني ان الكمية غير محدودة
            $table->double('price')->default(0.0);
            $table->double('offer_price')->nullable()->default(0.0); // سعر العرض
            $table->date('offer_ends')->nullable(); // تاريخ انتهاء العرض 
            $table->string('sku')->nullable();
            $table->integer('max_order')->nullable()->default(-1); // اعلي كمية يمكن حجزها 
            $table->boolean('featured')->default(false);
            $table->foreignId('product_category_id')->constrained()->cascadeOnDelete();
            $table->integer('views')->default(0);

            // will be use always
            $table->boolean('status')->default(true);
            $table->dateTime('published_on')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            // end of will be use always
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
