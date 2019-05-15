<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Question;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->string('answer');
            $table->integer('user_id');
            $table->timestamps();
        });

        Question::create([
            'question' => 'What is your mother\'s maiden name?',
            'answer' => '',
            'user_id' => 1
        ]);

        Question::create([
            'question' => 'What is the name of your favorite pet?',
            'answer' => '',
            'user_id' => 1
        ]);

        Question::create([
            'question' => 'What is your favorite movie?',
            'answer' => '',
            'user_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
