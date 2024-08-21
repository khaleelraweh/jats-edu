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
            $table->json('full_name');
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->dateTime('date_of_birth')->nullable();
            $table->dateTime('place_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsup_phone')->nullable();
            $table->string('identity_type')->nullable();
            $table->string('identity_attachment')->nullable();
            $table->tinyInteger('certificate_status')->nullable()->default(0);
            $table->string('verification_code')->nullable();
            $table->dateTime('certificate_release_date')->nullable();
            $table->tinyInteger('certificate_type')->nullable()->default(0); // 0 : from the site , 1 : Ministry of Technical Education
            $table->tinyInteger('certificate_cost')->nullable()->default(0); // 0 : from the site , 1 : Ministry of Technical Education

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
