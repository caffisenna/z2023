<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('created_at');
            $table->string('email')->nullable();
            $table->string('name');
            $table->string('furigana')->nullable();
            $table->string('phone')->nullable();
            $table->string('ceremony')->nullable();             // 表彰式
            $table->string('ceremony_with')->nullable();        // 表彰式同伴者
            $table->string('member');                           // 加盟員 or not
            $table->string('pref')->nullable();                 // 県連
            $table->string('dan')->nullable();                  // 団
            $table->string('role_dan')->nullable();             // 役務
            $table->string('role_district')->nullable();        // 地区役務
            $table->string('role_council')->nullable();         // 県連役務
            $table->string('role_saj')->nullable();             // 日連役務
            $table->string('reception')->nullable();            // 交歓会参加
            $table->string('congress')->nullable();             // 参加会議種別
            $table->string('organization')->nullable();         // 所属団体
            $table->string('living_area')->nullable();          // 居住エリア
            $table->string('reason')->nullable();               // 参加理由
            $table->string('theme_division')->nullable();       // テーマ集会
            $table->string('memo')->nullable();                 // 連絡事項
            $table->text('staff_memo')->nullable();             // スタッフメモ
            $table->string('uuid')->nullable();                 // uuid
            $table->boolean('absent_ceremony')->nullable();     // 全体会欠席
            $table->boolean('absent_reception')->nullable();    // 交歓会欠席
            $table->string('reception_table', 20)->nullable();      // 交歓会テーブル指定
            $table->string('checkin_type_ceremony')->nullable();    // チェックイン方式
            $table->string('checkin_type_reception')->nullable();   // チェックイン方式
            $table->dateTime('updated_at');
            $table->dateTime('checkedin_at')->nullable();       // チェックイン
            $table->dateTime('reception_checkedin_at')->nullable(); // 交歓会チェックイン
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
        Schema::drop('participants');
    }
}
