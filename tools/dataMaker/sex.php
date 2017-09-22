<?php
namespace tools\dataMaker;

/**
 * Генерим полы
 *
 * @author grynchuk
 */
class sex {
    
    function __construct(){
        $this->data=[ 'ж' ,'м' ];
    }
    
    public  function make(){
                
        foreach($this->data as $val){
           $sex= new \sex();
           $sex->setName($val);
           $sex->save();    
        }
    }
    
}
