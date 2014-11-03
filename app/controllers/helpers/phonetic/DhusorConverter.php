<?php

/**
 * Dhusor Converter class
 *
 * Usage:
 *  $converter = new DhusorConverter();
 *  echo $converter->entobn('hello world');
 */
class DhusorConverter {
    
    /**
     * Convert given string to bangla
     * 
     * @param string $banglish
     *
     * @return string 
     */
    private function convert($banglish)
    {
        if(is_string($banglish) && count($banglish) > 0)
        {
            $search = array();

            $replace = array();

            $search[0]  = array('w','W','ii','ee','uu','rri','OI','OU');
            
            $replace[0] = array('b','b','I','I','U','q','E','w');
            
            $result = str_replace($search[0], $replace[0], $banglish);

            $search[1]  = array('a','A','i','I','u','U','q','Q','e','E','w','O');
            
            $replace[1] = array('আ','আ','ই','ঈ','উ','ঊ','ঋ','ঋ','এ','ঐ','ঔ','ও');
            
            // We splited The result string into One character array $ara.
            $ara = str_split($result);
            $length = count($ara);
            
            for($i = $length-1; $i >= 0; $i--)
            {
                // ! preg_match('/[b-df-hj-npr-tv-zBDF-HJ-NPR-TV-Z]/', $ara[$i-1])
                if( ! isset($ara[$i-1]) || strpos('bcdfghjklmnprstvwxyzBDFGHJKLMNPRSTVWXYZ', $ara[$i-1]) === false )
                {
                    $ara[$i] = str_replace($search[1], $replace[1], $ara[$i]);
                }

                // ! preg_match('/[a-zA-Z]/', $ara[$i-1])
                // stripos for case insensitive search
                if( ! isset($ara[$i-1]) || stripos('abcdefghijklmnopqrstuvwxyz', $ara[$i-1]) === false )
                {
                    $ara[$i] = str_replace('o', 'অ', $ara[$i]);
                }
            }

            $result = '';

            for($i = 0; $i < $length; $i++)
            {
                $result .= $ara[$i];
            }
            
            $search[2]  = array('kh','Kh','gh','Ng','ch','jh','NG','Th','Dh','th','dh','ph','Ph','bh','Bh','sh','Rh','tt','. ','rz');
            
            $replace[2] = array('খ','খ','ঘ','ঙ','ছ','ঝ','ঞ','ঠ','ঢ','থ','ধ','ফ','ফ','ভ','ভ','শ','ঢ়','ৎ','। ','র‍্য');

            $search[3]  = array('C',':','a','A','i','I','u','U','q','Q','e','E','O','ng','w','W');

            $replace[3] = array('ঁ','ঃ','া','া','ি','ী','ু','ূ','ৃ','ৃ','ে','ৈ','ো','ং','ৌ','ৌ');

            $search[4]  = array('A','k','K','g','c','j','T','D','N','t','d','n','p','P','f','F','b','B','v','V','m','M','z','Z','r','l','L','S','s','h','H','R','y','Y','.','0','1','2','3','4','5','6','7','8','9','w','W','J','x','X','G','o','্্্');

            $replace[4] = array('আ','ক','ক','গ','চ','জ','ট','ড','ণ','ত','দ','ন','প','প','ফ','ফ','ব','ব','ভ','ভ','ম','ম','য','য','র','ল','ল','ষ','স','হ','হ','ড়','য়','য','্','০','১','২','৩','৪','৫','৬','৭','৮','৯','ও','ও','ঞ','ক্স','ক্স','ঙ','','...');

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
     *
     * If the string contains [something] then [something] will not be converted  
     * to bangla.
     *
     * @param string $banglish 
     *
     * @return string
     */
    function entobn($banglish)
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

