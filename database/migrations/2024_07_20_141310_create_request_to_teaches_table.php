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
        Schema::create('request_to_teaches', function (Blueprint $table) {
            $table->id();
            $table->json('full_name');
            $table->json('slug');
            $table->dateTime('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('residence_address')->nullable();
            $table->string('phone')->nullable();
            $table->string('educational_qualification')->nullable(); // المؤهل الدراسي
            $table->string('specialization')->nullable();  //  التخصص
            $table->unsignedTinyInteger('years_of_training_experience')->default(0);
            $table->string('identity')->nullable(); // الهوية
            $table->string('biography')->nullable(); // السيرة الذاتية
            $table->string('Certificates')->nullable(); //  الشهائد
            $table->string('motivation')->nullable(); // الحافز للتدريب في خطوة شباب 
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();


            // start will be use always
            $table->unsignedTinyInteger('request_status')->default(0);
            $table->dateTime('published_on')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            // end will be use always
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_to_teaches');
    }
};
