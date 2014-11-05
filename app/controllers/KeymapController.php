<?php

/**
 * KeymapController class
 */
class KeymapController extends BaseController {

	/**
	 * Shows keymap
	 *
	 * GET /keymap/{version}
	 *
	 * @param string $version
	 *
	 * @return View
	 */
	public static function view($version)
	{
		error_reporting(0);

		return View::make('keymap.' . $version);
	}
}