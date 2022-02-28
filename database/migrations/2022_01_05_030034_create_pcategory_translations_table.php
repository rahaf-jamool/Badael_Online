<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcategory_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pcategory_id')->constrained()->onDelete('cascade');
            $table->string ('locale')->index ();
            $table->string('name');
            $table->timestamps();
            $table->unique(['pcategory_id' , 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pcategory_translations');
    }
}
