<?php

/**
 * FacebookChatBotController class
 */
class FacebookChatBotController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Veryfication
	|--------------------------------------------------------------------------
	|
	| Facebook need to verify our webhook before Facebook integrate chatbot.
	| This method receives verify token set by us in facebook,
	| And respond with corresponding ACCESS TOKEN.
	|
	*/

	public function verify()
	{
		if(Input::has('hub_challenge') && Input::has('hub_verify_token'))
		{
			Log::info(Input::all());

			if($_ENV['FACEBOOK_BOT_VERIFY_TOKEN'] == Input::get('hub_verify_token'))
			{
				return Input::get('hub_challenge');
			}
		}
	}

	public function bot()
	{
		Log::info(Input::all());
	}

}
