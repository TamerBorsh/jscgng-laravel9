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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            $table->string('name_en');
            $table->string('slug')->unique();
            $table->longText('content_en')->nullable();
            $table->string('description_en')->nullable();
            $table->string('keywords_en')->nullable();

            $table->string('name_ar');
            $table->longText('content_ar')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('keywords_ar')->nullable();

            $table->string('photo')->nullable();
            $table->integer('view_count')->default('199');
            $table->boolean('is_active')->default('0');

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
        Schema::dropIfExists('posts');
    }
};
