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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            
            $table->string('name_ar');
            $table->text('description_ar')->nullable();
            $table->string('keywords_ar')->nullable();
            
            $table->string('name_en');
            $table->string('slug')->unique();
            $table->string('description_en')->nullable();
            $table->string('keywords_en')->nullable();

            $table->boolean('is_active')->default('1');

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
        Schema::dropIfExists('categories');
    }
};
