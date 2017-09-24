<?php

namespace tools\dataMaker;

/**
 * Класс действий собектами
 *
 * @author grynchuk
 */
class genOps {
    
     
    function __construct() {
        
    }
    
    
    
    /**
     * Удаляет все существующие депозиты счета и движения
     */
    function clearAll(){
       $m=\movsHistory::find();
       foreach( $m as $mm){
           $mm->delete();
       }
       
       $c=  \counts::find();
       foreach( $c as $cc  ){
           $cc->delete();
       }
       
       $d=  \deposit::find();
       foreach( $d as $dd  ){
           $dd->delete();
       }
    }
    
    /**
     * Добавляет всем клиентам депозиты один или два каждому
     */
    function makeDeposit(){
        $cs= \clients::find();
        
        foreach( $cs as $c ){
         
            for($i=0, $l=rand(1,2);
                $i<$l;
                $i++
               ){
                  $d= new deposit();
                  $d->make($c);
                }
        }
        
    }
    
}
