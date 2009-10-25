<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class Table_Residents extends BaseTable {
	/**
	 * @var = Table_Residents
	 */
	private static $uniqueInstance = null;
	
	protected $_name = 'Residents';
	protected $_rowClass = 'Resident';
	
	
	/**
	 * @return Table_Residents
	 */
	public static function getInstance()
	{
		if(!self::$uniqueInstance){
			self::$uniqueInstance = new Table_Residents();
		}
		return self::$uniqueInstance;
	}
	
	/**
	 * @param string $email
	 * @param string $password
	 * @return 
	 */
	public function findResidentByEmailAndPasswordhash($email, $password)
	{
		$select = $this->select()
			->where('email = ?', $email)
			->where('password_hash = ?', md5($password));
		$rows = $this->fetchAll($select);
		if ($rows->count() == 1){
			return $rows->current();
		} else {
			return null;
		}
	}
	
	public function findByAppAuthKey($key) {
		$select = $this->select()->where('appauth_key = ?', $key);
		return $this->fetchRow($select);
		
	}
	
	/**
	 * @param string email
	 * @return boolean
	 */
	public function residentExists($email)
	{
		$select = $this->select()
			->where('email = ?', $email);
		$rows = $this->fetchAll($select);
		if($rows->count() > 0){
			return true;
		} else {
			return false;
		}
	}
}//endClass