<?php

namespace movsLogic;

/**
 * Класс для записи истории  внесения депозитов 
 * @author grynchuk
 */
class deposit extends baseLogic implements \movsLogic {
   
    
    function __construct() {
    }
    
    public function getSum() {
       return  $this->deposit->getSum() ;
    }
    
   
    
}
