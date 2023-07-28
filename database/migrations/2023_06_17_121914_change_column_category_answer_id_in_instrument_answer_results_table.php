<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnCategoryAnswerIdInInstrumentAnswerResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instrument_answer_results', function (Blueprint $table) {
            $table->renameColumn('category_answer_id', 'sub_category_answer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instrument_answer_results', function (Blueprint $table) {
            $table->renameColumn('sub_category_answer_id', 'category_answer_id');
        });
    }
}
