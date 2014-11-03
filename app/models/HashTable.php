<?php

/**
 * HashTable class.
 */
class HashTable extends Eloquent {

	/**
	 * Table Name
	 *
	 * @var string
	 */
	protected $table = 'hashTable';
	
	/**
	 * We don't have created_at and updated_at columns 
	 *
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * Static Table Name for static functions.
	 *
	 * @var string
	 */
	private static $tableName = 'hashTable';


	/**
	 * Valid chars for hashTable.
	 * These variables are only for inserting multiple rows in hashTable
	 *
	 * @var array
	 */
	private $validChars = array("অ", "আ", "ই", "ঈ", "উ", "ঊ", "ঋ", "এ", "ঐ", "ও", "ঔ", "া", "ি", "ী", "ু", "ূ", "ৃ", "ে", "ৈ", "ো", "ৌ", "ক", "খ", "গ", "ঘ", "ঙ", "চ", "ছ", "জ", "ঝ", "ঞ", "ট", "ঠ", "ড", "ঢ", "ণ", "ত", "থ", "দ", "ধ", "ন", "প", "ফ", "ব", "ভ", "ম", "য", "র", "ল", "শ", "ষ", "স", "হ", "ড়", "ঢ়", "য়", "ৎ", "ং", "ঃ", "ঁ", "্");
	
	/**
	 * Array of inserted words in hashTable
	 *
	 * @var array
	 */
	private $insertedDataList;

	/**
	 * Query on hashTable using multiple hash value.
	 *
	 * @param array $hashedString
	 *
	 * @return DataBase object
	 */
	public static function getRowsByHashValues($hashedString)
	{
		return DB::table(self::$tableName)->whereIn('hash', $hashedString)->get();
	}

	/**
	 * Insert multiple (hash, bangla) pairs in hashTable
	 *
	 * @param string $string
	 *
	 * @return int
	 */
	public function insertMultipleRows($string)
	{
		if(mysql_errno() == 0)
		{
			$string = $this->fixChars($string);
			
			$str = $this->myExplode($string);

			$mapping = array();

			$len = count($str);
			
			for($i=0; $i < $len; $i++ )
			{
				$value = HashMaker::hashing($str[$i]);

				if( (strlen($value) > 0) && (strlen($str[$i]) > 0))
				{
					// Mapping like:
					// realValue => hashValue
					$mapping[ $str[$i] ] = $value ;
				}
				
			}

			if(count($mapping) > 0 )
			{
				return $this->checkAndInsert($mapping);
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}

	/**
	 * Check if a (hash, bangla) pair already exists. If already exists, we remove
	 * that pair from mapping. And then we insert them in the database.
	 *
	 * @param array $mapping
	 *
	 * @return int
	 */
	public function checkAndInsert($mapping)
	{
		$ara = array();

		foreach ($mapping as $key => $value)
		{
			$ara[] = $key;
		}

		$rows = DB::table(self::$tableName)->whereIn('bangla', $ara)->get();

		foreach ($rows as $row)
		{
			unset($mapping[$row->bangla]);
		}


		if(count($mapping) > 0)
		{
			$ara = array();
			
			$this->insertedDataList = array();

			foreach ($mapping as $key => $value)
			{
				$ara[] = array('bangla' => $key, 'hash' => $value);
				
				$this->insertedDataList[] = $key;
			}

			if( DB::table(self::$tableName)->insert($ara) )
			{
				// Success!!!
				return count($mapping);
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}

	/**
	* Fix some Unicode issue
	*
	* @param string $str
	*
	* @return string
	*/
	private function fixChars($str)
	{
		$find = array(   "ব়", "ড়", "ঢ়", "য়");
		
		$replace = array("র",   "ড়",   "ঢ়",  "য়"  );
		
		$str = str_replace($find, $replace, $str);
		
		return $str;
	}

	/**
	 * Explode a string and validate it.
	 * 
	 * @param string $string
	 *
	 * @return array
	 */
	public function myExplode($string)
	{
		$tok = explode(' ', $string);
		
		$str = array();

		$len = count($tok);
		
		for($i=0; $i<$len; $i++)
		{
			$value = $tok[$i];
			
			$value = str_replace($this->validChars, '', $value);
			
			if(empty($value))
			{
				$str[] = $tok[$i];
			}
		}

		return $str;
	}

	/**
	 * Return insertedDataList.
	 *
	 * @return array
	 */
	public function getInsertedDataList()
	{
		return $this->insertedDataList;
	}
}