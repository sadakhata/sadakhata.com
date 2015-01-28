<?php

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

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
	 * @return View
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
			$data  = array(
				'title' => 'Empty Status Can\'t be updated!',
				'reasons' => array(
					Lang::get('facebook.weGotEmptyStatus'),
					Lang::get('facebook.cookieDisabled'),
					Lang::get('facebook.statusAlreadyUpdated'),
					Lang::get('facebook.databaseError')
				)
			);

			return View::make('statusupdate.update', $data);
		}
		else
		{
			session_start();

			FacebookSession::setDefaultApplication( $_ENV['FACEBOOK_APP_ID'], $_ENV['FACEBOOK_APP_SECRET'] );

			$helper = new FacebookRedirectLoginHelper(url('update'));

			try
			{
				$session = $helper->getSessionFromRedirect();
			}
			catch( Exception $ex )
			{
				// When validation fails or other local issues

				$data = array(
					'title'     => 'Something Went Wrong!',
					'reasons'    => array(
						Lang::get('facebook.permission'),
						Lang::get('facebook.skOrFbError')
					)
				);
				return View::make('statusupdate.update', $data);
			}

			if(isset($session))
			{
				// User is logged in. Update The status now!
				try
				{
					$response = (new FacebookRequest(
						$session, 'POST', '/me/feed', array(
							'message' => $status
						)
					))->execute()->getGraphObject();

					$cachetable->setStatus('');

					$data = array(
						'title' => 'Status Updated Successfully!!!'
					);

					return View::make('statusupdate.update', $data);
				}
				catch(Exception $ex)
				{
					// something went wrong while updating the status
					$data = array(
						'title' => 'Something Went Wrong',
						'reasons' => array(
							Lang::get('facebook.permission'),
							Lang::get('facebook.statusAlreadyUpdated'),
						)
					);
					return View::make('statusupdate.update', $data);
				}
			}
			else
			{
				//user is not logged in.
				$data = array(
					'title' => 'You are not Logged in!',
					'loginUrl' => $helper->getLoginUrl(array('scope' => 'publish_actions'))
				);
				return View::make('statusupdate.update', $data);
			}

		}
	}

}