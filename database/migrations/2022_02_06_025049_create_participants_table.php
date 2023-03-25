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
            $table->string('name');
            $table->string('furigana')->nullable();
            $table->string('pref');
            $table->string('district')->nullable();
            $table->string('dan')->nullable();
            $table->string('role')->nullable();
            $table->string('category')->nullable();             // 招待カテゴリ
            $table->string('is_proxy')->nullable();             // 代理 役職が入れば代理判定
            $table->boolean('wheel_chair')->default(false);     // 車椅子 0 1
            $table->string('with_helper')->nullable();          // 介助者同行 ID
            $table->string('go_with_leader')->nullable();       // 同行親リーダー メアド or uuid
            $table->string('go_with_scouts')->nullable();       // 引率されるスカウト uuid
            $table->string('self_absent')->nullable();          // 欠席理由 自己入力, 指導者入力, 発熱NG
            $table->string('reception_self_absent')->nullable();// レセプション欠席入力
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('seat_number')->nullable();          // 式典座席
            $table->string('reception_seat_number')->nullable();          // レセプション座席
            $table->string('zip')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('email_sent_at')->nullable();      // デジパス送信日時
            $table->string('fee_checked_at')->nullable();       // 入金チェック
            $table->string('no_fee')->nullable();               // 参加費不要フラグ
            $table->string('saj_booth')->nullable();            // 日連受付ブースフラグ
            $table->string('uuid')->unique();
            $table->dateTime('checkedin_at')->nullable();           // 式典チェックイン
            $table->dateTime('reception_checkedin_at')->nullable(); // レセプションチェックイン
            $table->dateTime('gift_receipt')->nullable();           // 記念品受領
            $table->dateTime('cloak_receipt')->nullable();          // クローク受領
            $table->timestamps();
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
