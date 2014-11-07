<?php

/**
 * Hash Maker Class.
 *
 * Usage:
 *	echo HashMaker::hashing('পরবে');
 */
class HashMaker {

	/**
	 * String Hashing algorithm.
	 *
	 * @param string $bangla
	 *
	 * @return string
	 */
	public static function hashing($bangla)
	{
		// check if given parameter is a string.
		if(is_string($bangla))
		{
			$search  = array('ঈ', 'ঊ', 'খ', 'ঘ', 'ছ', 'ঝ', 'ট', 'ঠ', 'ড', 'ঢ', 'ণ', 'য', 'শ', 'ষ', 'ড়', 'ঢ়', 'ং', 'ৎ', 'ঋ'   );

			$replace = array('ই', 'উ', 'ক', 'গ', 'চ', 'জ', 'ত', 'থ', 'দ', 'ধ', 'ন', 'জ', 'স', 'স', 'র', 'র', 'ঙ', 'ত', 'রি' );

			$bangla = str_replace($search, $replace, $bangla);

			$search = array('ী', 'ৈ', 'ূ', 'ো', 'ৌ', 'ঁ', '্', 'ৃ', 'ঃ');

			$replace =array('ি',  'ই', 'ু',  '',   'উ',   '',   '', 'রি',  '');

			$bangla = str_replace($search, $replace, $bangla);

			return $bangla;
		}
		else
		{
			return '';
		}
	}
}
