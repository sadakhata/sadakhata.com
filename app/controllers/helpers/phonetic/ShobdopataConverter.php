<?php

/**
 * Shobdopata Converter class
 *
 *
 * Usage:
 *	$converter = new ShobdopataConverter();
 *	echo $converter->entobn('hello world');
 */
class ShobdopataConverter {

	/**
	 *
	 * Convert given string to bangla
	 * 
	 * @param string $banglish
	 *
	 * @return string 
	 */
	private function convert($banglish)
	{
		// Check Whethere $banglish is an instance of
		// string and it's length is greater than 0.
		// Otherwise retunr null string.
		if(is_string($banglish) && count($banglish))
		{
			$search = array();
			
			$replace = array();

			$search[0] = array('Tt','.','w','W','rri','oY');
			
			$replace[0] = array('ৎ','।','.b','.b','q','o.Y');

			$search[1] = array('k','K','g','G','c','j','J','T','D','N','t','d','n','p','P','f','F','b','B','v','V','m','M','z','Z','Y','r','l','L','S','s','h','H','R','y');
			
			$replace[1] = array('k.','k.','g.','G.','c.','j.','J.','T.','D.','N.','t.','d.','n.','p.','p.','f.','f.','b.','b.','v.','v.','m.','m.','z.','z.','Y.','r.','l.','l.','S.','s.','h.','H.','R.','y.');

			$search[2] = array('n.g.','.o','.a','.A','.i','.I','.u','.U','.q','.e','.E','.O');
			
			$replace[2] = array('ng','o','a','A','i','I','u','U','q','e','E','O');

			$search[3] = array('k.h','K.h','g.h','N.g','c.h','j.h','N.G','T.h','D.h','t.h','d.h','p.h','P.h','b.h','B.h','s.h','R.h','n.g.','r.Y');
			
			$replace[3] = array('kh','Kh','gh','Ng','ch','jh','NG','Th','Dh','th','dh','ph','Ph','bh','Bh','sh','Rh','ng','rY');

			$search[4]=array('ii','ee','uu','OI','OU');
			
			$replace[4]=array('I','I','U','E','w');

			for($i = 0; $i < 5; $i++)
			{
				$banglish = str_replace($search[$i], $replace[$i], $banglish);
			}

			$search[5] = array('a','A','i','I','u','U','q','Q','e','E','w','O');
			
			$replace[5] = array('আ','আ','ই','ঈ','উ','ঊ','ঋ','ঋ','এ','ঐ','ঔ','ও');
			

			// We splited The result string into 
			// One character array $ara.
			$ara = str_split($banglish);

			$length = count($ara);

			for($i = $length-1; $i >= 0; $i--)
			{
				// ! preg_match('/[b-df-hj-npr-tv-zBDF-HJ-NPR-TV-Z]/',$ara[$i-1])
				if( ! isset($ara[$i-1]) || strpos('bcdfghjklmnprstvwxyzBDFGHJKLMNPRSTVWXYZ', $ara[$i-1]) === false )
				{
					$ara[$i] = str_replace($search[5], $replace[5], $ara[$i]);
				}

				// ! preg_match('/[a-zA-Z]/',$ara[$i-1])
				// stripos for case insensitive search
				if( ! isset($ara[$i-1]) || stripos('abcdefghijklmnopqrstuvwxyz', $ara[$i-1]) === false )
				{
					$ara[$i] = str_replace('o', 'অ', $ara[$i]);
				}

				// ! preg_match('/[a-zA-Z]/',$ara[$i+1])
				// From search[1], there may be some extra dot(.) at anywhere
				// unncessary. We try to remove those dot(.)
				// stripos for making case insencetive search
				if( ! isset($ara[$i+1]) || stripos('abcdefghijklmnopqrstuvwxyz', $ara[$i+1]) === false )
				{
					$ara[$i] = str_replace('.', '', $ara[$i]);
				}
			}


			$result = '';

			for($i = 0; $i < $length; $i++)
			{
				$result .= $ara[$i];
			}

			$search[6] = array('kh','Kh','gh','Ng','ch','jh','NG','Th','Dh','th','dh','ph','Ph','bh','Bh','sh','Rh','tt','rY','ng');
			
			$replace[6] =array('খ','খ','ঘ','ঙ','ছ','ঝ','ঞ','ঠ','ঢ','থ','ধ','ফ','ফ','ভ','ভ','শ','ঢ়','ৎ','র‍্য','ং');

			$search[7] = array('C',':','a','A','i','I','u','U','q','Q','e','E','O','ng','w');
			
			$replace[7] = array('ঁ','ঃ','া','া','ি','ী','ু','ূ','ৃ','ৃ','ে','ৈ','ো','ং','ৌ');       

			$search[8] = array('.y','A','k','K','g','c','j','T','D','N','t','d','n','p','P','f','F','b','B','v','V','m','M','z','Z','r','l','L','S','s','h','H','R','y','Y','.','0','1','2','3','4','5','6','7','8','9','w','W','J','x','X','G','o','।।।');
			
			$replace[8] = array('.z','আ','ক','ক','গ','চ','জ','ট','ড','ণ','ত','দ','ন','প','প','ফ','ফ','ব','ব','ভ','ভ','ম','ম','য','য','র','ল','ল','ষ','স','হ','হ','ড়','য়','য','্','০','১','২','৩','৪','৫','৬','৭','৮','৯','ও','ও','ঞ','ক্স','ক্স','ঙ','','...');

			for($i=6; $i<9; $i++)
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

    /**
	 * Converts given string to bangla.
	 * If the string contains [something]
	 * then [something] will not be converted 
	 * to bangla.
	 *
	 * @param string $banglish 
	 *
	 * @return string
     */
    public function entobn($banglish)
    {
        if(is_string($banglish) && count($banglish) > 0)
    	{
    		$tokens = explode('[', $banglish);
    		
            $count = count($tokens);

    		$result = '';

    		for($i = 1; $i < $count; $i++)
    		{
    			$tokens[$i] = explode(']', $tokens[$i], 2);
    			
                $result .= $tokens[$i][0] . $this->convert( $tokens[$i][1] );
    		}
    		
            $result = $this->convert($tokens[0]) . $result;
    		
            return htmlspecialchars($result);
    	}
    	else
    	{
    		return '';
    	}
	}
}
