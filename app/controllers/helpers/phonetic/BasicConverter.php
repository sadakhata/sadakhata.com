<?php

/**
 * Basic Converter class
 *
 * Usage:
 *	$converter = new BasicConverter();
 *	echo $converter->entobn('hello world');
 */
class BasicConverter {

	/**
	 * Convert given string to bangla
	 * 
	 * @param string $banglish
	 *
	 * @return string 
	 */
    private function convert($banglish)
    {
    	
		// Check Whethere $banglish is an instance of string and it's length is
		// greater than 0. Otherwise return null string.
        if(is_string($banglish) && count($banglish) > 0)
        {
        	$search = array();

        	$replace = array();

            $search[0] = array('ii','ee','uu','rri','OI','OU');

            $replace[0] =array('I','I','U','q','E','O');
            
            $result = str_replace($search[0], $replace[0], $banglish);

            $search[1] = array('a','i','I','u','U','q','Q','e','E','o','O');

            $replace[1] = array('আ','ই','ঈ','উ','ঊ','ঋ','ঋ','এ','ঐ','ও','ঔ');
                        
			// We splited The $result string into One character array $ara. 
            $ara = str_split($result);

            $length = count($ara);
            
            for($i = $length-1; $i >= 0; $i--)
            {
            	// ! preg_match('/[b-df-hj-npr-tv-zBDF-HJ-NPR-TV-Z]/',$ara[$i-1])
            	// strpos return false if a needle is not found in heystack. We
            	// need to check if return value of strpos is strickly false.
            	// as it will return 0 if a needle is found at first position of 
            	// a string.
				if( ! isset($ara[$i-1]) || strpos('bcdfghjklmnprstvwxyzBDFGHJKLMNPRSTVWXYZ', $ara[$i-1]) === false )
				{
				    $ara[$i] = str_replace($search[1], $replace[1], $ara[$i]);
				}
            }

            // Join all the pieces in one string.
            $result = implode($ara);

            $search[2] = array('kh','Kh','gh','Ng','ch','jh','NG','Th','Dh','th','dh','ph','Ph','bh','Bh','sh','Rh','tt','. ','rz');
            
            $replace[2] = array('খ','খ','ঘ','ঙ','ছ','ঝ','ঞ','ঠ','ঢ','থ','ধ','ফ','ফ','ভ','ভ','শ','ঢ়','ৎ','। ','র‍্য');

            $search[3] = array('C',':','a','i','I','u','U','q','Q','e','E','o','O','ng');
            
            $replace[3]  = array('ঁ','ঃ','া','ি','ী','ু','ূ','ৃ','ৃ','ে','ৈ','ো','ৌ','ং');

            $search[4]  = array('A','k','K','g','c','j','T','D','N','t','d','n','p','P','f','F','b','B','v','V','m','M','z','Z','r','l','L','S','s','h','H','R','y','Y','.','0','1','2','3','4','5','6','7','8','9','w','W','J','x','X','G','্্্');
            
            $replace[4] = array('অ','ক','ক','গ','চ','জ','ট','ড','ণ','ত','দ','ন','প','প','ফ','ফ','ব','ব','ভ','ভ','ম','ম','য','য','র','ল','ল','ষ','স','হ','হ','ড়','য়','য়','্','০','১','২','৩','৪','৫','৬','৭','৮','৯','ও','ও','ঞ','ক্স','ক্স','ঙ','...');

            for($i = 2; $i < 5; $i++)
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
	 * If the string contains [something] then [something] will not be 
	 * converted to bangla.
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