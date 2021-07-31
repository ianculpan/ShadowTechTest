<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_metas', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->index('idx_isbn')->unique();
            $table->string('original_publication_year');
            $table->string('language_code');
            $table->string('average_rating');
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
        Schema::dropIfExists('books_metas');
    }
}
