<?php
use \Phalcon\Mvc\Model;
/**
 * Базовая логика для моделей тут идет выброс искл. в случае ошибок
 *
 * @author grynchuk
 */
abstract class baseModel extends Model  {
    
    function save($data = NULL, $whiteList = NULL){
        if(parent::save($data, $whiteList)===false){
             $this->notifyError();
       }
        
    }
    
    function delete(){
        if(parent::delete()===false){
            $this->notifyError();
        }
        
    }
    
    private function notifyError(){
       $mess = implode( '  ' ,  $this->getMessages() );
       throw new \Exception($mess); 
    }
    
}
