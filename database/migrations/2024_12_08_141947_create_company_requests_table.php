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
        Schema::create('company_requests', function (Blueprint $table) {
            $table->id();
            $table->string('cp_user_name');
            $table->string('cp_user_email');
            $table->string('cp_user_phone');
            $table->string('cp_company_name');
            $table->string('cp_job_title');
            $table->string('cp_company_size');
            // $table->string('cp_company_country');
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();

            $table->string('cp_company_city');

            // will be use always
            // $table->boolean('status')->nullable()->default(false);
            $table->unsignedTinyInteger('status')->default(0);

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
        Schema::dropIfExists('company_requests');
    }
};
