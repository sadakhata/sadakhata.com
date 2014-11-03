<?php

/**
 * StatusUpdateController class
 *
 * Used for updating facebook status.
 */
class StatusUpdateController extends BaseController {

	/**
	 * Shows 'Are you confirm to update status' page
	 *
	 * ANY /confirm
	 *
	 * @return View
	 */
	public static function confirm()
	{
		error_reporting(0);

		$data = array();

		$data['status'] = isset($_POST['status']) ? $_POST['status'] : '';

		if(get_magic_quotes_gpc())
		{
			$data['status'] = stripslashes($data['status']);
		}

		return View::make('statusupdate.confirm', $data);
	}

	/**
	 * Update Facebook Status
	 *
	 * ANY /update
	 *
	 * @return string|View
	 */
	public static function update()
	{
		error_reporting(0);
		
		$status = isset($_POST['status']) ? $_POST['status'] : '';

		if(get_magic_quotes_gpc())
		{
			$status = stripslashes($status);
		}

		// Get the current User Row
		// If the row Doesn't exist, It will create a new row as soon as setStatus() 
		// called. Otherwise, Nothing will be saved in database. and nothing will saved
		// in Cookies.
		$cachetable = CacheTable::init('status');

		if(empty($status))
		{
			$status = $cachetable->getStatus();
		}
		else
		{
			$cachetable->setStatus($status);
		}

		if(empty($status))
		{
			return 'Sorry! Empty status can\'t be updated.';
		}
		else
		{

			$appId  = $_ENV['FACEBOOK_APP_ID'];
			
			$appSecret  = $_ENV['FACEBOOK_APP_SECRET'];  
			
			//$canvasUrl  = "Your App Canvas Url"; 
			
			//$canvasPage  = "Your App canvas Page"; 
			 
			//include_once "facebook.php"; [[Loaded through helper]]
			 
			$facebook = new Facebook(array(
			  'appId'  => $appId,
			  'secret' => $appSecret,
			  'cookie' => true,
			));
			 
			$sent = false;
			
			$userData = null;
			
			$user = $facebook->getUser();
			
			if ($user)
			{
				try
				{
					$userData = $facebook->api('/me');
				} 
				catch (FacebookApiException $e)
				{
				
				}
				
				if($status != '')
				{
					try 
					{
						$facebook->api('/me/feed', 'POST', array(
							'message' => $status
						));
						
						$sent = true;

						// As soon as the status has been updated successfully,
						//  we delete the element of 'status' column.
						$cachetable->setStatus('');

						//  Return the success message.
						//  It will be handled by Laravel.
						return 'Status Updated Successfully!!!';
					} 
					catch (FacebookApiException $e)
					{

					}
				}
			} 
			else if(empty($_GET['code']) && empty($_GET['error']))
			{
				$loginUrl = $facebook->getLoginUrl(array(
					'canvas' => 1,
					'fbconnect' => 0,
					'scope' => 'publish_stream',
				));

				//  The user is not logged in. Send them to Login or verify our app.
				//  After successful login, user will came back here. And We will try
				//  to update the status again.
				return '<script type="text/javascript">window.location="' . $loginUrl . '";</script>';
			}
			else
			{
				return 'Something went Wrong, and The server can\'t handle this. Please inform us, if you notice something unusual.';
				
				error_log("error returning from " . __FILE__ . " at line " . __LINE__);
			}
		}
	}

}