<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacebookChatBotMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facebook_chat_bot_messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id');
			$table->longText('message');
			$table->longText('payload');
			$table->string('received_at');
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
		Schema::drop('facebook_chat_bot_messages');
	}

}
