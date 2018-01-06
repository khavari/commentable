<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;


class AlterSettingsTableChangeValue extends Migration
{
    public function up()
    {
        Schema::table("settings", function (Blueprint $table) {
            $table->dropColumn("value");
        });

        Schema::table("settings", function (Blueprint $table) {
            $table->text("value")->nullable();
        });
    }

    public function down()
    {
        Schema::table("settings", function (Blueprint $table) {
            $table->dropColumn("value");
        });
        Schema::table("settings", function (Blueprint $table) {
            $table->string('value');
        });
    }
}
