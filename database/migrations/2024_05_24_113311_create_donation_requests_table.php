<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('phone');
			$table->string('hospital_name');
			$table->integer('age');
			$table->integer('bags');
			$table->text('address');
			$table->text('details');
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
			$table->integer('city_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->integer('blood_type_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
