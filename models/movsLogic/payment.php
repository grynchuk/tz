<?php

namespace movsLogic;

/**
 * Логика начисления процентов по депозиту
 *
 * @author grynchuk
 */
class payment extends baseLogic implements \movsLogic {
   
    function __construct() {
         
    }
    
    function getSum() {        
      // один счет один депозит
      $currentSum=$this->count->getCurrentSum();    
      
      // То колличество суммы что начисляется каждый месяц
      // Берем всю сумму за весь период * то за какую долю 
      // состовляет текущий период начисления 
      // от общего времени вклада 
     
     // die("$currentSum  {$this->deposit->rate} ");
      
      $sum =  
              (
              $currentSum * 
                $this->deposit->rate*
              ( cal_days_in_month(CAL_GREGORIAN, date('m'),date('Y') )/$this->getNumDaysYear()  )
              )/100
             ;
      return $sum;
    }
    
    /**
     * Считаем сколько дней в году 365 или 364
     * @return int
     */
    function getNumDaysYear(){
        for($i=1,$n=0, $l=12; $i<=$l;$i++ ){
            $n+=cal_days_in_month(CAL_GREGORIAN, $i ,date('Y') );
        }
       return  $n;
    }
   
    
    
    
}
