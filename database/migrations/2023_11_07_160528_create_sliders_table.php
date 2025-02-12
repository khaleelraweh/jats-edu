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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();

            $table->json('title');
            $table->json('slug');
            $table->json('description');
            $table->string('icon')->nullable();

            $table->json('btn_one_name')->nullable();
            $table->string('btn_one_url')->nullable();
            $table->string('btn_one_target')->default('_self');
            $table->boolean('btn_one_show')->default(true);

            $table->json('btn_two_name')->nullable();
            $table->string('btn_two_url')->nullable();
            $table->string('btn_two_target')->default('_self');
            $table->boolean('btn_two_show')->default(true);





            $table->unsignedBigInteger('section')->default(1);

            $table->boolean('showInfo')->default(true); // عرض العنوان والتصفاصيل 

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
        Schema::dropIfExists('sliders');
    }
};
