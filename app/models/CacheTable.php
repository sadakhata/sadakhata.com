<?php

/**
 * CacheTable class
 *
 * Used for saving what an user has written.
 */
class CacheTable extends Eloquent {

	/**
	 * Table Name
	 *
	 * @var string
	 */
	protected $table = 'cache_table';

	/**
	 * We don't have created_at and updated_at columns in our table
	 *
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * Column name.
	 *
	 * @var string
	 */
	public static $version;

	/**
	 * Sadakhata Cookie Name
	 * This is the userid saved on user's device.
	 * 
	 * @var string
	 */
	public static $cookieName = 'sadakhata_cookie';

	/**
	 * Get a row from CacheTable.
	 * If a user exist, then we return that correspond row. If user is not
	 * found in the database, we return a new row.
	 *
	 * @param string $version
	 *
	 * @return CacheTable 
	 */
	public static function init($version)
	{
		self::$version = $version;

		if( ! empty($_COOKIE[self::$cookieName]) ) 
		{
			$userid = $_COOKIE[self::$cookieName];

			if(get_magic_quotes_gpc()) 
			{
				$userid = stripslashes($userid);
			}

			$var = CacheTable::where('userid', '=', $userid)->first();

			// If there is not any user with given 'userid'
			// We will make a new Object. So, save() function
			// will save the row in the database
			if( ! isset($var) )
			{
				return new CacheTable();
			}
			else
			{
				return $var;
			}
		}
		else
		{
			return new CacheTable();
		}
	}

	/**
	 * Constructor. Set the user id of new object.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->userid = uniqid(microtime(true) . rand(100000, 999999), true);
	}

	/**
	 * Get what a user previously written.
	 *
	 * @return string
	 */
	public function getStatus()
	{
		return $this->{self::$version};
	}

	/**
	 * Save status in database.
	 *
	 * @param string
	 *
	 * @return void
	 */
	public function setStatus($status)
	{
		$this->setCookie();

		$this->{self::$version} = $status;

		$this->save();
	}

	/**
	 * set Sadakhata Cookie on user's device.
	 *
	 * @return void
	 */
	private function setCookie() 
	{
		setcookie(self::$cookieName, $this->userid, time() + 60*60*24*365, '/');
	}

}