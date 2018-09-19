<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAddEmailVerified extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //->after('column')	将此字段放置在其它字段「之后」（仅限 MySQL）
            //default 默认值
            //$table->boolean('confirmed');	相当于 BOOLEAN
            $table->boolean('email_verified')->default(false)->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //表示给定的列应该被删除
            $table->dropColumn('email_verified');
        });
    }
}
