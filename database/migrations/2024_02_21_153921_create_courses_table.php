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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->json('course_name');
            $table->json('slug');
            $table->json('description');

            $table->tinyInteger('course_level')->nullable()->default(1); // واحد مبتدي اثنين متوسط ثلاثة متقدم
            $table->tinyInteger('course_lang')->nullable()->default(1); // واحد عربي اثنين إنجليزي ثلاثة اسباني
            $table->tinyInteger('course_evaluation')->nullable()->default(1); // 1 : is normal , 2 : is featured  , 3 : is best seller
            $table->tinyInteger('course_lessons_number')->nullable();
            $table->string('course_lessons_time')->nullable();

            $table->integer('quantity')->nullable()->default(-1); // سالب واحد تعني ان الكمية غير محدودة
            $table->double('price')->default(0.0);
            $table->double('offer_price')->nullable()->default(0.0); // سعر العرض
            $table->date('offer_ends')->nullable(); // تاريخ انتهاء العرض 
            $table->string('sku')->nullable();
            $table->integer('max_order')->nullable()->default(-1); // اعلي كمية يمكن حجزها 
            $table->boolean('featured')->default(false);
            $table->foreignId('course_category_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('courses');
    }
};
