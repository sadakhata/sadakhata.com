<?php

/**
 * JSadakhataController class
 */
class JSadakhataController extends BaseController {

	/**
	 * Show JSadakhata
	 *
	 * GET /pc
	 *
	 * @return View
	 */
	public function index()
	{
		return View::make('jsadakhata.index');
	}
}