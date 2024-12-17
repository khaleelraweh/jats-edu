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
        Schema::create('certificate_requests', function (Blueprint $table) {
            $table->id();
            $table->json('full_name');
            $table->dateTime('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            $table->string('phone')->nullable();
            $table->string('whatsup_phone')->nullable();

            $table->tinyInteger('identity_type')->nullable()->default(0); // 0 personal card , 1 passport 
            $table->string('identity_number')->nullable();
            $table->dateTime('identity_expiration_date')->nullable();
            $table->string('identity_attachment')->nullable();

            $table->json('certificate_name');
            $table->string('certificate_code')->nullable();
            $table->dateTime('certificate_release_date')->nullable();
            $table->string('certificate_file')->nullable();
            $table->tinyInteger('certificate_status')->nullable()->default(0); //قيد المراجعة 0 تحت المعالجة 1 تم الاصدار 2

            $table->foreignId('sponser_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained()->cascadeOnDelete();


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
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_requests');
    }
};
