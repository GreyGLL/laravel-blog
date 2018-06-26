<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletePostsFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('url');
            $table->dropColumn('subtitle');
            $table->dropColumn('extract');
            $table->dropColumn('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('subtitle')->nullable();
            $table->mediumText('extract')->nullable();
            $table->text('content')->nullable();
        });
    }
}
