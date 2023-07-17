<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MyTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_team', function (Blueprint $table) {
            $table->bigIncrements('id'); // Sử dụng bigIncrements() thay cho id()
            $table->string('task_name');
            $table->integer('progress');
            $table->string('label');
            $table->date('deadline');
            $table->string('owner');
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
        Schema::dropIfExists('project_team');
    }
}
