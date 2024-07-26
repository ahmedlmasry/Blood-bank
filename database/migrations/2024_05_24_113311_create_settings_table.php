<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('notifications_settings_text');
			$table->text('about_app');
			$table->string('email');
			$table->string('phone');
			$table->text('fb_link');
			$table->text('tw_link');
			$table->text('insta_link');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
