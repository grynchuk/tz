<?php

namespace tools\dataMaker;
use  tools\useful;
/**
 * Description of client
 *
 * @author grynchuk
 */
class client {
    public    $numPers=6;
    private   $codes ;
    
    
   function __construct() {
       
       $this->setIdCodes();
       
   }
   
   function getSex(){
        $sex=[11,12];
        return useful::getRand($sex);
   }
   
   function make(){
       var_dump($this->numPers,$this->numPers>0);
       while( $this->numPers>0){
           $this->numPers--;
           
//        $sex=$this->getSex();
//        list($name, $secondName)=explode(' ', $this->getFio($sex));
//        $codeId=$this->codes[$this->numPers];
//        $birthday=$this->getBirthday();
//        
//        
//        $mess = " {$sex}  {$name} {$secondName} {$codeId} ".$birthday->format('d.m.Y'); 
        useful::logMess($mess);
       }
   }
   
   
   function getFio($sex){
       
       static $done=[];
       
       $names=[
           11  => ['Жанна Агузарова',
                  'Валентина Терешкова',
                  'Клара Цеткин',
                  'Леся Украинка',
                  'Тетка Теткина',
                  'Девкина  Девкина  '
                 ]
           ,
           12  =>[ 'Сергей Шнуров ',
                   'Юрий Гагарин',  
                   'Алеша Попович',
                   'Тугарин Змей',
                   'Юрий Дудь',
                   'Дед Мозая'
                 ]
           
           
       ];
       
       do{
        $fio=useful::getRand($names[$sex]);
       } while(in_array($fio , $done  ));
              $done[]=$fio;
       return $fio;
   }
   
   
   
   
   function getBirthday(){
     $dates=\tools\useful::getDatesInRange('01.01.1980', '01.01.1990');
     return  useful::getRand($dates) ;
   }
   
   
   function setIdCodes(){
     $numPers=$this->numPers;   
     while($numPers--){
       for($i=0, $code=''; 
           $i<12;
           $i++
          ){
            $code.=(string)rand(0, 9);
          }
      $this->codes[]=$code;    
     }  
   }
   
   
   
   
}
