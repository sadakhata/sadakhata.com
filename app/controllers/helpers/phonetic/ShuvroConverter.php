<?php

/**
 * Shuvro Converter class
 *
 * Usage
 *	$converter = new ShuvroConverter();
 * 	echo $converter->entobn('amar sonar bangla ami tomay valobasi');
 */
class ShuvroConverter {

	/**
	 * 2-dimentional suggestions.
	 * 
	 * @var array
	 */
	private $suggestions = array();

	/**
	 * List of all the delimeters.
	 *
	 * @var array
	 */
	public $delimeter;

	/**
	 * Explode the given string.
	 *
	 * We assume that, a string starts with english characters( [a-zA-Z:] )
	 * We define some subsequent english characters as `good string`
	 * and subsequent non-english characters are `bad string`.
	 *
	 * We also assume that, given string has format:
	 * ((good string)(bad string))*
	 * 
	 * We save those `good string` in $str array and `bad string` in $delimeters array. 
	 *
	 * @param string $string
	 *
	 * @return array
	 */
	private function myExplode($string)
	{
		$last_into = true; // last into good

		$start = 0;

		$end = 0;

		$str = array();

		$delimeter = array();

		$english_number = array('.', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

		$bangla_number =  array('।', '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');

		$count = strlen($string);

		for($i = 0; $i < $count; $i++)
		{
			// preg_match('/[a-zA-Z:]/', $string[$i])
			if(strpos('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ:', $string[$i]) !== false )
			{
				if($last_into == false)
				{
					$delimeter[] = str_replace('।।।', '...', str_replace($english_number, $bangla_number, substr($string, $start, $end-$start)));
					
					$start = $end;

					$end++;
				}
				else
				{
					//if last into good
					$end++;
				}

				$last_into = true; //last into good
			}
			else
			{
				if($last_into == true)
				{
					$str[] = substr($string, $start, $end-$start);

					$start = $end;

					$end++;
				}
				else
				{
					$end++;
				}

				$last_into = false;
			}
		}


		if($last_into == true)
		{
			$str[] = substr($string, $start, $end-$start);
		}
		else
		{
			$delimeter[] = str_replace('।।।', '...', str_replace($english_number, $bangla_number, substr($string, $start, $end-$start)));
		}

		return array($str, $delimeter);
	}

	/**
	 * Converts a string to bangla
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public function entobn($string)
	{
		$avro = new avroParser();

		list($str, $this->delimeter) = $this->myExplode($string);

		$hash = array();

		$len = count($str);

		if($len > 0)
		{
			for($i = 0; $i < $len; $i++)
			{
				$str[$i] = $avro->parse($str[$i]);

				$hashedString[] = substr( HashMaker::hashing($str[$i]), 0, 61);
			}

			$rows = HashTable::getRowsByHashValues($hashedString);

			foreach ($rows as $row)
			{
				$hash[ $row->hash ][] = $row->bangla;
			}

		}

		$result = '';

		for($i = 0; $i < $len; $i++ )
		{
			$this->suggestions[] = isset($hash[ $hashedString[$i] ]) ? $hash[ $hashedString[$i] ] : array() ;

			$this->bestWord($str[$i], $this->suggestions[$i]);

			$result .= $this->suggestions[$i][0];

			$result .= isset($this->delimeter[$i]) ? $this->delimeter[$i] : ''; 
		}

		return htmlspecialchars($result);
	}

	/**
	 * Chose best word based on levenshtein algorithm And we place the best word
	 * at $words[0]
	 *
	 * @param string $word
	 *
	 * @param array &$words
	 *
	 * @return void
	 */
	private function bestWord($word, array &$words)
	{
		$bestWordPosition = 0;

		$len = count($words);

		if($len == 0)
		{
			$words[] = $word;
		}

		$dist = 1000000000;

		for($i = 0; $i < $len; $i++)
		{
			//insert cost = 1, replace cost = 3, delete cost = 2.
			$tmp = levenshtein($word, $words[$i], 1, 3, 2); 

			if($tmp < $dist)
			{
				$dist = $tmp;

				$bestWordPosition = $i;
			}
		}

		// swapping. We put the best value at index 0.
		$tmp = $words[0];

		$words[0] = $words[$bestWordPosition];

		$words[$bestWordPosition]  = $tmp;

		if(!in_array($word, $words))
		{
			$words[] = $word;
		}
	}

	/**
	 * Dropdown menu builder for every good string.
	 *
	 * @return string
	 */
	public function getSuggestions()
	{
		$len = count($this->suggestions);

		$ret = ''; 

		for($i = 0; $i < $len; $i++)
		{
			if(strlen($this->suggestions[$i][0]) == 0) continue;

			$ret = $ret . '<select id="s' . $i . '">';

			foreach ($this->suggestions[$i] as $value) 
			{
				$ret = $ret . '<option>' . $value . '</option>';
			}

			$ret = $ret . '</select>';
		}
		return $ret;
	}
}
