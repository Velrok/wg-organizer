<?php
/**
 * @author 
 * @date 
 * @year 
 * 
 * Decription ...  
 */

class MessagesController extends ApplicationController  
{

  public function indexAction()
  {
    $this->view->messages = $this->getCurrentResident()->getLatestMessages(20);
  }

}//endClass