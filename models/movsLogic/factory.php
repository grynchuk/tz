<?php

namespace movsLogic;
/**
 * Фабрика логик движения
 *
 * @author grynchuk
 */
class factory {
    
    public static function getLogic(\counts $count, $moveId){
        
        $movs=[
             MOVE_DEPOSIT=> self::getNameSpaced('deposit')            
           , MOVE_PAYMENT=> self::getNameSpaced('payment')
           , MOVE_COMMISSION=> self::getNameSpaced('commission')                  
        ];
        
        if(array_key_exists($moveId, $movs)
           and 
           class_exists( $className=$movs[$moveId] )
          ){
            
            $inst=new $className();
            
            $inst->setCount($count);
//            var_dump($inst);
//            die();
          }else{
              throw new \Exception('money move logic not found');
          }
          
          return $inst;
    } 
    
    protected static function getNameSpaced($class){
        
        return '\\'. __NAMESPACE__.'\\'.$class ;
    }
}
