<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('sub_category_answer_id');
            $table->string('element_assessment');
            $table->text('deskripsi')->nullable();
            $table->boolean('is_absolute');
            $table->integer('bobot');
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
        Schema::dropIfExists('instrument_answers');
    }
}
