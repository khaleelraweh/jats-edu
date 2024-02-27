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
        Schema::create('card_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code_name')->nullable();
            $table->string('code')->require();
            $table->tinyInteger('code_type')->default(0); // نوع الكود مباشر والصفر يعني مباشر  , غير مباشر والواحد يعني غير مباشر 
            $table->tinyInteger('encoding_type')->default(0);
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('order_id')->default(0);

            // will be use always
            $table->boolean('status')->default(true);
            $table->dateTime('published_on')->nullable();
            $table->string('created_by')->nullable()->default('admin');
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
        Schema::dropIfExists('card_codes');
    }
};
