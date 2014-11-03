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

		$data[$version]['versionName'] = $version;

		$data[$version]['versionUrl'] = url($version);

		$data['basic']['versionTitle'] = 'সাদাখাতা বেসিক';

		$data['dhusor']['versionTitle'] = 'ধূসর সাদাখাতা';

		$data['shobdopata']['versionTitle'] = 'শব্দপাতা';

		$data['shuvro']['versionTitle'] = 'শুভ্র সাদাখাতা';
		
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
			$data[$version]['suggestion'] = $converter->getSuggestions();
			
			$data[$version]['suggestionJS'] = View::make('phonetic.suggestion', array('delimeter' => $converter->delimeter) )->render();
		}

		$data[$version]['input'] = $input;
		
		$data[$version]['output'] = $output;

		//Calculate How Many time has been elapsed. And forward it to view. 
		$data[$version]['elapsed_time'] = microtime(true) - $_SERVER['REQUEST_TIME'];
		
		$data[$version]['elapsed_time'] = substr($data[$version]['elapsed_time'], 0, 7);

		return View::make('phonetic.rupantor', $data[$version]);
	}
}

