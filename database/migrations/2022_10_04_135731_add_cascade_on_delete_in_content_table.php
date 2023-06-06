<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('contents', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('contents')
                ->cascadeOnDelete();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }

};
