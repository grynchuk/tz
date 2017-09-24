<?php

namespace movsLogic;

/**
 * Базовая логика 
 *
 * @author grynchuk
 */
abstract class baseLogic {
    protected $deposit
             ,$count;
             
    /**
     * Устанавливаем счет
     * @param \counts $count
     * @throws \Exception
     */
    public function setCount(\counts $count) {
        //echo'fffff';
        $this->count=$count;
         $this->deposit=  \deposit::FindFirst($count->getDeposit()) ;
         if(! $this->deposit  ){
             throw new \Exception(' Не найдено депозита привязанного к счету '.$count->getId());
         }
    }
    
   
    
    
}
