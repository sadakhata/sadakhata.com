<?php

/**
 * Avro class.
 * This is Base Class. It requires exact writting in banglish format.
 * 
 * writting 'biggan' will not work here.
 * We need to use AvroParser for that.
 *
 */
class avro {

	/**
	 * Basic Avro parser.
	 *
	 * @param string $banglish
	 *
	 * @return string
	*/
	public static function result($banglish)
	{
		if(is_string($banglish) && count($banglish) > 0)
		{
			$search = array();
			
			$replace = array();

			$search[0]             = array('Tt', 'w', 'W', 'q', 'Q', 'rri');
			
			$replace[0]            = array('ৎ', '.b', '.b', 'k', 'k', 'q');
			
			$search[1]             = array('k.kh', 'n.k', 'n.j', 'g.g');
			
			$replace[1]            = array('k.S', 'G.k', 'J.j', 'j.J');
			
			$search[2]             = array('E', 'ii', 'ee', 'uu', 'OI', 'OU');
			
			$replace[2]            = array('e', 'I', 'I', 'U', 'E', 'w');
			
			$search[3]             = array('a', 'A', 'i', 'I', 'u', 'U', 'q', 'e', 'E', 'w', 'O');
			
			$replace[3]            = array('আ', 'আ', 'ই', 'ঈ', 'উ', 'ঊ', 'ঋ', 'এ', 'ঐ', 'ঔ', 'ও');
			
			$search[4]             = array('kh', 'Kh', 'gh'/*,'Ng'*/, 'ch', 'jh'/*,'NG'*/, 'Th', 'Dh', 'th', 'dh', 'ph', 'Ph', 'bh', 'Bh', 'sh', 'Rh', 'tt', 'rY', 'ry', 'ng');
			
			$replace[4]            = array('খ', 'খ', 'ঘ'/*, 'ঙ'*/, 'ছ', 'ঝ'/*, 'ঞ'*/, 'ঠ', 'ঢ', 'থ', 'ধ', 'ফ', 'ফ', 'ভ', 'ভ', 'শ', 'ঢ়', 'ৎ', 'র‍্য', 'র‍্য', 'ং');
			
			$search[5]             = array('C', 'a', 'A', 'i', 'I', 'u', 'U', 'q', 'e', 'E', 'O', 'ng', 'w');
			
			$replace[5]            = array('ঁ', 'া', 'া', 'ি', 'ী', 'ু', 'ূ', 'ৃ', 'ে', 'ৈ', 'ো', 'ং', 'ৌ');
			
			$search[6]             = array('.y', 'A', 'k', 'K', 'g', 'c', 'j', 'T', 'D', 'N', 't', 'd', 'n', 'p', 'P', 'f', 'F', 'b', 'B', 'v', 'V', 'm', 'M', 'z', 'Z', 'r', 'l', 'L', 'S', 's', 'h', 'H', 'R', 'y', 'Y', '.', 'w', 'W', 'J', 'x', 'X', 'G', 'o', ':');
			
			$replace[6]            = array('.z', 'আ', 'ক', 'ক', 'গ', 'চ', 'জ', 'ট', 'ড', 'ণ', 'ত', 'দ', 'ন', 'প', 'প', 'ফ', 'ফ', 'ব', 'ব', 'ভ', 'ভ', 'ম', 'ম', 'য', 'য', 'র', 'ল', 'ল', 'ষ', 'স', 'হ', 'হ', 'ড়', 'য়', 'য়', '্', 'ও', 'ও', 'ঞ', 'ক্স', 'ক্স', 'ঙ', '', 'ঃ');
			
			$result = str_replace($search[0], $replace[0], $banglish);
			
			$result = str_replace($search[1], $replace[1], $result);
			
			$result = str_replace('R.', 'R', $result);
			
			$result = str_replace($search[2], $replace[2], $result);
			
			$ara = str_split($result);
			
			$length = count($ara);
			
			for( $i = $length-1; $i > -1; $i-- )
			{
				// ! preg_match('/[b-df-hj-npr-tv-zBDF-HJ-NPR-TV-Z]/', $ara[$i-1])
				if( ! isset($ara[$i-1]) || strpos('bcdfghjklmnprstvwxyzBDFGHJKLMNPRSTVWXYZ', $ara[$i-1]) === false )
				{
					$ara[$i] = str_replace($search[3], $replace[3], $ara[$i]);
				}

				// ! preg_match('/[a-zA-Z]/', $ara[$i-1])
				// stripos for case insensitive search
				if( ! isset($ara[$i-1]) || stripos('abcdefghijklmnopqrstuvwxyz', $ara[$i-1]) === false )
				{
					$ara[$i] = str_replace('o', 'অ', $ara[$i]);
				}

				// ! preg_match('/[a-zA-Z]/', $ara[$i+1])
				// stripos for case insensitive search
				if( ! isset($ara[$i+1]) || stripos('abcdefghijklmnopqrstuvwxyz', $ara[$i+1]) === false )
				{
					$ara[$i] = str_replace('.', '', $ara[$i]);
				}
			}
			
			$result = implode($ara);

			for($i = 4; $i < 7; $i++)
			{
				$result = str_replace($search[$i], $replace[$i], $result);
			}
			
			return $result;
		}
		else
		{
			return '';
		}
	}
}

/**
 * avroParser fix some basic issue like: juktoborno, putting 'y' where neccessary etc...
 * then it passes the string to avro for final conversion.
 */
class avroParser {
	/**
	 * converts J, NG, G, Ng to one character
	 *
	 * @var array
	 */
	private $ngjg_find = array('J','NG', 'G', 'Ng'); 
	
	private $ngjg_replace = array('j','J', 'g', 'G'); 
	
	/**
	 * Converts ng[aeiou] and n(kh|jh|gh) to perfect string
	 *
	 * @var array
	 */
	private $ng_find = array('nga', 'nge', 'ngi', 'ngo', 'ngu', 'ngI', 'ngO', 'ngU', 'nkh', 'njh', 'ngh'); //used
	
	private $ng_replace = array('Ga', 'Ge', 'Gi', 'Go', 'Gu', 'G', 'GO', 'GU', 'Gkh', 'J.jh', 'G.gh'); //used

	/**
	 * Maps where dot is needed.
	 *
	 * @var array
	 */
	private $dot = array();

	/**
	 * Case Sencetive characters.
	 *
	 * @var array
	 */
	private $casesencetive = array('D', 'N', 'R', 'S', 'T', 'C'/*added*/); 
	
	/**
	 * All Vowels
	 *
	 * @var array
	 */
	private static $vowels = array('a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U');  

	/**
	 * (Forgot what it was)
	 *
	 * @var array
	 */
	private $special_find = array(	 'ng.',		'gdh',		'Gdh',		'ldh',		'Ldh',		'mth',		'Mth',		'dbh',		'dBh',		'shc',		'sht',		'Gk',		'GK',		'GS',		'cJ',		'jJ',		'Jc',		'n.c',		'kh.l',			'kh.m',			'kh.n',		'.rri');  //used
	
	private $special_replace = array('G.',		'g.dh',		'g.dh',		'l.dh',		'l.dh',		'm.th',		'm.th',		'd.bh',		'd.bh',		'sh.c',		'sh.t',		'G.k',		'G.k',		'G.S',		'c.J',		'j.J',		'J.c',		'J.c',		'khl',			'khm',			'khn',		'rri');   //used

	/**
	 * replace bh with v
	 *
	 * @var array
	 */
	private static $double = array('bh');

	private static $double_replace = array('v');

	/**
	 * Constructor
	 * Make rules about when to put dot(.)
	 *
	 * @return void
	*/
	public function __construct()
	{
		$this->dot['b'] = array('b', 'd', 'j', 'l', 'r', 'y', 'Z');
		$this->dot['c'] = array('c', 'r', 'y', 'Z');
		$this->dot['d'] = array('d', 'g', 'm', 'r', 'v', 'y', 'Z');
		$this->dot['f'] = array('l', 'r', 'y', 'Z');
		$this->dot['g'] = array('g', 'l', 'm', 'n', 'N', 'r', 'y', 'Z');
		$this->dot['h'] = array('l', 'm', 'n', 'r', 'y', 'Z');
		$this->dot['j'] = array('j', 'r', 'y', 'Z');
		$this->dot['k'] = array('k', 'l', 'L', 'r', 's', 'S', 't', 'T', 'x', 'X', 'y', 'Z');
		$this->dot['l'] = array('b', 'B', 'D', 'g', 'k', 'K', 'l', 'L', 'm', 'M', 'p', 'P', 'r', 'T', 'v', 'V', 'y', 'Z');
		$this->dot['m'] = array('b', 'B', 'f', 'F', 'l', 'L', 'm', 'M', 'n', 'p', 'P', 'r', 'v', 'V', 'y', 'Z');
		$this->dot['n'] = array('c', 'd', 'D', 'j', 'k', 'K', 'm', 'M', 'n', 'r', 's', 't', 'T', 'y', 'Z');
		$this->dot['o'] = array('Z');
		$this->dot['p'] = array('l', 'L', 'n', 'p', 'P', 'r', 's', 't', 'T', 'y', 'Z');
		$this->dot['q'] = array('r', 'y', 'Z');
		$this->dot['r'] = array('b', 'B', 'c', 'd', 'D', 'f', 'F', 'g', 'G', 'h', 'H', 'j', 'J', 'k', 'K', 'l', 'L', 'm', 'M', 'n', 'N', 'p', 'P', 'q', 'Q', 'R', 's', 'S', 't', 'T', 'v', 'V', 'x', 'X', 'Z');
		$this->dot['s'] = array('f', 'F', 'k', 'K', 'l', 'L',  'm', 'M', 'n', 'p', 'P', 'r', 't', 'T', 'y', 'Z');
		$this->dot['t'] = array('m', 'M', 'n', 'r', 't', 'y', 'Z');
		$this->dot['v'] = array('l', 'L', 'r', 'y', 'Z');
		$this->dot['y'] = array('y');
		$this->dot['z'] = array('r', 'y', 'Z');
		
		$this->dot['D'] = array('D', 'r', 'y', 'Z');
		$this->dot['N'] = array('D', 'm', 'M', 'n', 'N', 'r', 'T', 'y', 'Z');
		$this->dot['R'] = array('g', 'r', 'y', 'Z');
		$this->dot['S'] = array('f', 'F', 'k', 'K', 'm', 'M', 'N', 'p', 'P', 'r', 'T', 'y', 'Z');
		$this->dot['T'] = array('m', 'M', 'r', 'T', 'y', 'Z');

		$this->dot['Ng'] = array('k', 'K', 'm', 'M', 'S', 'y', 'Z');

	}

	/**
	 * Make necessary dot.
	 * Dot is required for juktoborno
	 *
	 * @param string $input
	 *
	 * @return string
	 */
	private function dotMaker($input)
	{
		$input = str_replace($this->ngjg_find, $this->ngjg_replace, $input);
		
		$input = str_replace($this->ng_find,$this->ng_replace,$input);
		
		// Split the string with one character per index.
		$input = str_split($input);
		
		$len = count($input);

		$result = '';

		for($i = 0; $i < $len; $i++) {
		
			if($input[$i] == 'w' || $input[$i] == 'W')
			{
				if( ! isset($input[$i-1]) || in_array($input[$i-1], self::$vowels))
				{
					//aw -> aO
					$result .= 'O';
				}
				else
				{
					//bw ->bw
					$result .= 'w'; 
				}
				continue;
				
			}
			else if($input[$i] == 'o')
			{
				if(isset($input[$i-1]) && in_array($input[$i-1], self::$vowels))
				{
					$result .= 'O';
				}
				else
				{
					$result .= 'o';
				}
			}
			else
			{
				$result .= $input[$i];
			}

			if( ! in_array($input[$i], $this->casesencetive))
			{
				//make current letter lower case if it is not case sensetive	
				$input[$i] = strtolower($input[$i]);
			}

			// May be this condition will never met.
			if($input[$i] == 'N' && isset($input[$i+1]) && $input[$i+1] == 'g')
			{
				if( isset($input[$i+2]) && in_array($input[$i+2], $this->dot['Ng']) )
				{
					$result .= 'g.'; // the 'N' was added before. so 'Ng.' is added here
					
					$i++;  // for the '.', we add 1 to $i
					
					continue;	
				}	
			}

			if(isset($this->dot[$input[$i]]) && isset($input[$i+1]) && in_array($input[$i+1], $this->dot[$input[$i]]))
			{
				$result .= '.' . $input[$i+1];
				
				$i++;
			}
		}

		$result = str_replace($this->special_find, $this->special_replace, $result);

		return $result;		
	}

	/**
	 * We should always call this parse function.
	 * It's the entry point.
	 * 
	 * @param string $banglish
	 *
	 * @return string
	 */
	public function parse($banglish)
	{
		if(is_string($banglish) && count($banglish) > 0)
		{
			return avro::result($this->dotMaker(self::putY($banglish)));
		}
		else
		{
			return '';
		}
	}

	/**
	 * Put a 'y' where neccessary.
	 *  
	 * @param string $input
	 *
	 * @return string
	 */
	public static function putY($input)
	{	
		$input = str_ireplace(self::$double, self::$double_replace, $input);
		
		$len = strlen($input);
		
		$result = '';
		
		for($i = 0; $i < $len; $i++)
		{
			$result .= $input[$i];

			$j = $i + 1;
			
			if($j < $len)
			{
				if( ($input[$i] != $input[$j]) && in_array($input[$j], array('a', 'A', 'e', 'E')) && in_array($input[$i], self::$vowels))
				{
					// [aAeE][aeiou] converts to: [aAeE]y[aeiou] where $1 != $2
					$result .= 'y';
				}
				else if( ($input[$i] == 'w' || $input[$i] == 'W' ) && in_array($input[$j], self::$vowels) && ( ! isset($input[$i-1]) || in_array($input[$i-1], self::$vowels)))
				{
					// [NULLaeiou][wW][aeiou] converts to: [NULLaeiou][wW]y[aeiou]
					$result .= 'y';
				}
			}
		}
		return $result;
	}
}

