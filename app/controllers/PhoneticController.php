<?php

/**
 * PhoneticController class
 */
class PhoneticController extends BaseController {

	/**
	 * Shows Phonetic Converter
	 *
	 * ANY /{version}
	 *
	 * @param string $version
	 *
	 * @return View
	 */
	public static function rupantor($version)
	{
		error_reporting(0);

		//If the requested version can't found, We just throw a 404 error page.
		if( ! in_array($version, array('basic', 'dhusor', 'shobdopata', 'shuvro') ) )
		{
			App::abort(404);
		}

		$data['versionName'] = $version;

		$data['versionUrl'] = url($version);

		$data['versionTitle'] = Lang::get('names.' . $version);

		$input = isset($_POST['input']) ? $_POST['input'] : '';

		if(get_magic_quotes_gpc())
		{
			$input = stripslashes($input);
		}

		$user = CacheTable::init($version);

		if(empty($input))
		{
			$input = $user->getStatus();
		}
		else
		{
			$user->setStatus($input);
		}

		//  We load the converter class object dynamically.
		//  Note: Laravel Automatically includes all classes
		//  needed in the ecosystem.
		//  If this feature is not available, we need to manually load
		//  the required file using require_once.
		//  We Know that, $version string will be always lowercase. 
		//  If it's not true, then we need to make it lowercase first. 
		$converterName = ucfirst($version) . 'Converter';

		$converter = new $converterName();

		$output = $converter->entobn($input);

		if($version == 'shuvro')
		{
			$data['suggestion'] = $converter->getSuggestions();

			$data['suggestionJS'] = View::make('phonetic.suggestion', array('delimeter' => $converter->delimeter) )->render();
		}

		$data['input'] = $input;

		$data['output'] = $output;

		//Calculate How Many time has been elapsed. And forward it to view. 
		$data['elapsed_time'] = microtime(true) - $_SERVER['REQUEST_TIME'];

		$data['elapsed_time'] = substr($data['elapsed_time'], 0, 7);

		return View::make('phonetic.rupantor', $data);
	}
}

