<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('notification_title');
			$table->text('notification_content');
			$table->integer('donation_request_id');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}
