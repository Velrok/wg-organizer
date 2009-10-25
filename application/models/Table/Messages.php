<?php
/**
 * @author
 * @date
 * @year
 *
 * Decription ...
 */

class Table_Messages extends BaseTable {
  /**
   * @var = Table_Messages
   */
  private static $uniqueInstance = null;

  protected $_name = 'Messages';
  protected $_rowClass = 'Message';

  /**
   * @return Table_Messages
   */
  public static function getInstance()
  {
    if(!self::$uniqueInstance){
      self::$uniqueInstance = new Table_Messages();
    }
    return self::$uniqueInstance;
  }

/**
 *
 * @param Resident $resident
 * @param int $amount
 *
 * @return array<Resident>
 */
  public function getLatestFor(Resident $resident, $amount=30)
  {
    $select = $this->select()->from($this->_name)
    ->where('resident_id = ?', $resident->id)
    ->limit($amount)
    ->order('created_at DESC');
    return $this->fetchAll($select);
  }
}//endClass