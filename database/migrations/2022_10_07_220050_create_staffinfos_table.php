<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffinfosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('furigana');
            $table->date('birth_day')->nullable();
            $table->string('gender');
            $table->string('bs_id');
            $table->string('prefecture');
            $table->string('district');
            $table->string('dan');
            $table->string('role');
            $table->string('cell_phone');
            $table->string('zip')->nullable();
            $table->string('address')->nullable();
            $table->string('team')->nullable();
            $table->text('memo')->nullable();
            $table->string('uuid')->unique();
            $table->timestamps();
            $table->dateTime('checkedin_at')->nullable();  // 到着日時
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('staffinfos');
    }
}
