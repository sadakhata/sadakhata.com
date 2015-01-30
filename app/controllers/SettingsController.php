<?php

/**
 * SettingsController class
 */
class SettingsController extends BaseController {

	/**
	 * set Default Language.
	 *
	 * GET /setLang/{lang?}
	 *
	 * @param string $lang
	 *
	 * @return Redirect
	 */
	public function setLang($lang = 'en')
	{
		return Redirect::to(URL::previous())->withCookie(Cookie::forever('lang', $lang));
	}
}
