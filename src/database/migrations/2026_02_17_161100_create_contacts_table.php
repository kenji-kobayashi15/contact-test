<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');       // 姓
            $table->string('last_name');        // 名
            $table->string('gender');           // 性別（男性/女性/その他）
            $table->string('email');            // メールアドレス
            $table->string('tel1', 5);
            $table->string('tel2', 5);
            $table->string('tel3', 5);
            $table->string('address1');         // 住所
            $table->string('address2')->nullable(); // 建物名（空でもOK）
            $table->string('select_content');   // お問い合わせの種類
            $table->text('content');            // お問い合わせ内容
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
        Schema::dropIfExists('contacts');
    }
}
