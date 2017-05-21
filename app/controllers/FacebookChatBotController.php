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
			if($_ENV['FACEBOOK_CHATBOT_VERIFY_TOKEN'] == Input::get('hub_verify_token'))
			{
				return Input::get('hub_challenge');
			}
		}
	}

	public function bot()
	{

		$jsonPayloadString = json_encode(Input::all());

		$expectedSha1Signature = hash_hmac('sha1', $jsonPayloadString, $_ENV['FACEBOOK_CHATBOT_APP_SECRET']);

		$expectedSha1Signature = 'sha1=' . $expectedSha1Signature;

		$sha1SignatureHeader = Request::header('X-Hub-Signature');

		if(!empty($sha1SignatureHeader) && $expectedSha1Signature === $sha1SignatureHeader)
		{
			if(Input::has('entry'))
			{
				$entry = Input::get('entry');
			}
			else
			{
				return;
			}

			$senderIndexes = array(0, 'messaging', 0, 'sender', 'id');
			$messageIndexes = array(0, 'messaging', 0, 'message', 'text');

			$sender = $entry;
			$message = $entry;

			foreach ($senderIndexes as $value)
			{
				if(array_key_exists($value, $sender))
				{
					$sender = $sender[$value];
				}
				else
				{
					return;
				}
			}

			foreach($messageIndexes as $value)
			{
				if(array_key_exists($value, $message))
				{
					$message = $message[$value];
				}
				else
				{
					return;
				}
			}

			$shuvroConverter = new ShuvroConverter();
			$text = $shuvroConverter->entobn($message);

			$this->sendText($sender, $text);

		}
	}

	private function sendText($recipient, $text)
	{
		$payload = array(
			'recipient' => array(
				'id' => $recipient,
			),
			'message' => array(
				'text' => $text,
			),
		);

		$jsonPayloadString = json_encode($payload);

		$access_token = $_ENV['FACEBOOK_CHATBOT_ACCESS_TOKEN'];
		$url = 'https://graph.facebook.com/v2.9/me/messages?access_token=' . $access_token;

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonPayloadString);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

		$result = curl_exec($curl);
	}

}
