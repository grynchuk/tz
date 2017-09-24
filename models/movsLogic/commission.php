<?php

namespace movsLogic;
/**
 * Логика снятия комиссий
 *
 * @author grynchuk
 */
class commission extends baseLogic implements \movsLogic {
    
    function getSum() {
       $currentSum=$this->count->getCurrentSum();    
       $res=0;
       
       if( $currentSum >0 and $currentSum<=1000 ){
           $res=$currentSum*0.05;
           $res=($res<50)? 50 : $res;
       }
       
       if( $currentSum >1000 and $currentSum<=10000 ){
           $res=$currentSum*0.06;
       }
       
       if( $currentSum >10000  ){
           $res=$currentSum*0.07;
           $res=($res>5000)? 5000 : $res;
       }
       return $res;
    }
}
