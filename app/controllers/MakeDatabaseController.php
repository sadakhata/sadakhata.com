<?php

/**
 * MakeDatabaseController class
 *
 * We use this class to make Database. A admin friendly way!
 */
class MakeDatabaseController extends BaseController {

	/**
	 * Shows HashTable maker and simultaniously add data into database.
	 * And if the user is not logged in, we call adminLogin implicitly
	 *
	 * ANY /make
	 *
	 * @return View
	 */
	public static function insertHashTable()
	{
		error_reporting(0);

		session_start();

		if(    isset($_POST['user']) 
			&& isset($_POST['password']) 
			&& ($_POST['user'] == $_ENV['SADAKHATA_ADMIN_USERNAME']) 
			&& ($_POST['password'] == $_ENV['SADAKHATA_ADMIN_PASSWORD']))
		{
			$_SESSION['logged'] = 'yes';
		}

		if( ! isset($_SESSION['logged']) || $_SESSION['logged'] != 'yes')
		{
			return self::adminLogin();
		}
		else
		{
			$data = array(
				'cntAddedData' => 0,
				'insertedData' => array(),
			);

			if(isset($_POST['banglaParagraph']))
			{
				$banglaparagraph = $_POST['banglaParagraph'];

				if(get_magic_quotes_gpc())
				{
					$banglaparagraph = stripslashes($banglaparagraph);
				}

				$hashtable = new HashTable();

				$data['cntAddedData'] = $hashtable->insertMultipleRows($banglaparagraph);

				$data['insertedData'] = $hashtable->getInsertedDataList();
			}

			return View::make('makedatabase.inserthashtable', $data);
		}
	}

	/**
	 * Show admin login page.
	 *
	 * @return View
	 */
	public static function adminLogin()
	{
		error_reporting(0);

		return View::make('makedatabase.adminlogin');
	}
}