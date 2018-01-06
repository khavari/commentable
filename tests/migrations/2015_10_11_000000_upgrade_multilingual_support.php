<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpgradeMultilingualSupport extends Migration
{

    public function up()
    {
        \DB::table("settings")->truncate();


        Schema::create("setting_translations", function (Blueprint $table) {
            $table->increments('id');
            $table->integer("setting_id")->unsigned();
            $table->text("value")->nullable();
            $table->string("locale")->index();
        });

        Schema::table("setting_translations", function (Blueprint $table) {
            $table->unique(['setting_id', 'locale']);
            $table->foreign(['setting_id'])->references("id")->on("settings")->onDelete("cascade");
        });


    }

    public function down()
    {
        Schema::drop("setting_translations");
    }
}
