<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class Message extends BaseModel {

  /**
   *
   * @return mixed id
   */
  protected function __doInsert() {
    if(empty($this->from)) $this->from = "System";
    
    return parent::__doIsert();
  }

  /**
   *
   * @param string $from
   */
  public function setFrom($from){
    $this->from = $from;
  }

  /**
   *
   * @param Resident $resident Resident this message is for
   */
  public function setFor(Resident $resident) {
    Zend_Debug::dump($this->id);
    $this->resident_id = $resident->getId();
  }

  /**
   *
   * @param string $title
   */
  public function setTitle($title) {
    $this->title = $title;
  }

  /**
   *
   * @param string $message
   */
  public function setMessage($message) {
    $this->message = $message;
  }
	
}//endClass