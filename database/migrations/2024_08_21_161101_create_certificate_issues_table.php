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
        Schema::create('certificate_issues', function (Blueprint $table) {
            $table->id();
            $table->json('stud_certificate_name');
            $table->json('stud_full_name');
            $table->dateTime('stud_date_of_birth')->nullable();
            $table->dateTime('stud_place_of_birth')->nullable();
            $table->string('stud_nationality')->nullable();
            $table->string('stud_country')->nullable();
            $table->string('stud_city')->nullable();
            $table->string('stud_phone')->nullable();
            $table->string('stud_whatsup_phone')->nullable();
            $table->string('stud_identity_type')->nullable();
            $table->string('stud_identity_attachment')->nullable();
            $table->tinyInteger('stud_certificate_status')->nullable()->default(0); //قيد المراجعة 0 تحت المعالجة 1 تم الاصدار 2
            $table->string('stud_verification_code')->nullable();
            $table->dateTime('stud_certificate_release_date')->nullable();
            $table->tinyInteger('stud_certificate_type')->nullable()->default(0); // 0 : from the site , 1 : Ministry of Technical Education
            $table->tinyInteger('stud_certificate_cost')->nullable()->default(0); // 0 : from the site , 1 : Ministry of Technical Education
            $table->string('stud_certificate_file')->nullable();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();


            // will be use always
            $table->boolean('status')->nullable()->default(false);
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
        Schema::dropIfExists('certificate_issues');
    }
};
