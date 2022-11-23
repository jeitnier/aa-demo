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
        Schema::create('crawled_urls', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('url');
            $table->integer('unique_images')->nullable();
            $table->integer('unique_internal_links')->nullable();
            $table->integer('unique_external_links')->nullable();
            $table->float('page_load')->nullable();
            $table->integer('word_count')->nullable();
            $table->integer('title_length')->nullable();
            $table->mediumInteger('status_code')->nullable();
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
        Schema::dropIfExists('crawled_urls');
    }
};
