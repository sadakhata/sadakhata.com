<?php

/**
 * HelpController class
 */
class HelpController extends BaseController {

	/**
	 * Show help.
	 *
	 * GET /help/{about}
	 *
	 * @param string $about
	 *
	 * @return View
	 */
	public static function help($about)
	{
		error_reporting(0);

		return View::make('help.' . $about);
	}

}