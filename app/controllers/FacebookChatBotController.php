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
			$versionIndexes = array(0, 'messaging', 0, 'message', 'quick_reply', 'payload');
			$timestampIndexes = array(0, 'messaging', 0, 'timestamp');

			$sender = $entry;
			$message = $entry;
			$versionName = $entry;
			$timestamp = $entry;

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

			foreach ($versionIndexes as $value)
			{
				if(array_key_exists($value, $versionName))
				{
					$versionName = $versionName[$value];
				}
				else
				{
					$versionName = NULL;
					break;
				}
			}

			foreach($timestampIndexes as $value)
			{
				if(array_key_exists($value, $timestamp))
				{
					$timestamp = $timestamp[$value];
				}
				else
				{
					$timestamp = '0';
					break;
				}
			}

			$validVersions = array('basic', 'dhusor', 'shobdopata', 'shuvro');

			if($versionName == NULL)
			{
				$versionName = 'shuvro';
				$setting = FacebookChatBotSetting::where('user_id', '=', $sender);

				if($setting->count() > 0)
				{
					$setting = $setting->first();
					$versionName = $setting->version;
				}

				if(in_array($versionName, $validVersions ))
				{
					$converterName = ucfirst($versionName) . 'Converter';
					$converter = new $converterName();
					$text = $converter->entobn($message);
					$this->sendText($sender, $text);
				}
			}
			else
			{
				$text = 'Ok. Sure!';
				$this->sendText($sender, $text);

				if(in_array($versionName, $validVersions ))
				{
					$oldMessage = FacebookChatBotMessage::where('user_id', '=', $sender);

					if($oldMessage->count() > 0)
					{
						$oldMessage = $oldMessage->orderBy('received_at', 'desc')->first();
						$message = $oldMessage->message;

						$text = 'Here you go!';
						$this->sendText($sender, $text);

						$converterName = ucfirst($versionName) . 'Converter';
						$converter = new $converterName();

						$text = $converter->entobn($message);
						$this->sendText($sender, $text);
					}

					$setting = FacebookChatBotSetting::firstOrNew(array('user_id' => $sender));
					$setting->version = $versionName;
					$setting->save();
				}
			}

			FacebookChatBotMessage::create(array(
				'user_id' => $sender,
				'message' => $message,
				'payload' => $jsonPayloadString,
				'received_at' => $timestamp,
			));
		}
	}

	private function sendText($recipient, $text)
	{
		$text = htmlspecialchars_decode($text);

		$payload = array(
			'recipient' => array(
				'id' => $recipient,
			),
			'message' => array(
				'text' => $text,
				'quick_replies' => array(
					array(
						'content_type' => 'text',
						'title' => 'Use Shuvro',
						'payload' => 'shuvro',
					),
					array(
						'content_type' => 'text',
						'title' => 'Use Basic',
						'payload' => 'basic',
					),
					array(
						'content_type' => 'text',
						'title' => 'Use Dhusor',
						'payload' => 'dhusor',
					),
					array(
						'content_type' => 'text',
						'title' => 'Use Shobdopata',
						'payload' => 'shobdopata',
					),
				),
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
		curl_close($curl);
	}

}
