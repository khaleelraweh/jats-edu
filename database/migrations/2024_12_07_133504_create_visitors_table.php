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
        Schema::create('visitors', function (Blueprint $table) {
            // $table->id();
            // $table->string('ip_address');
            // $table->string('last_page')->nullable();
            // $table->date('visited_at');
            // $table->timestamps();

            $table->id();
            $table->string('ip_address');
            $table->string('last_page')->collation('utf8mb4_unicode_ci')->nullable(); // Ensure Unicode support
            $table->date('visited_at');
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
        Schema::dropIfExists('visitors');
    }
};
