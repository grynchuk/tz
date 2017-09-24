<?php

namespace tools\dataMaker;
use  tools\useful;

/**
 * Класс для создания клиентов
 * @author grynchuk
 */
class client {
    public    $numPers=6;
    private   $codes ,$doneFio=[];
    
    
   function __construct() {
       
       $this->setIdCodes();
        
   }
   /**
    * Случайным образом генерит пол клиент
    * @return type
    */
   protected function getSex(){
        $sex=[ WOMEN
             , MEN ];
        return useful::getRand($sex);
   }
   /**
    *  Генарит набор клиентов независимо 
    *  случайным образом выбирая их пол а также имена
    *  , имена должны быть уникальными
    *   как и идентификационные коды 
    */
   function make(){
       $name=''; $secondName=''; $codeId=''; $birthday= new \DateTime();
       $numPers=$this->numPers;
       while( $numPers>0){
        $numPers--;   
      
         $sex=$this->getSex();
         
        list($name, $secondName)=explode(' ', $this->getFio($sex));
        $codeId=$this->codes[$numPers];
         
        $birthday=$this->getBirthday();
        
        $this->addClient($sex, $name,$secondName,$codeId,$birthday);
        
       }
   }
   
   /**
    * 
    * @param int        $sex
    * @param string     $name
    * @param string     $secondName
    * @param int        $codeId
    * @param \DateTime  $birthday
    */
   protected function addClient($sex, $name,$secondName,$codeId,$birthday){
//        $mess = " {$sex}  {$name} {$secondName} {$codeId} ".$birthday->format('d.m.Y'); 
//        useful::logMess($mess);

     $c= new \clients();
     $c->setBirthday($birthday);
     $c->setSex($sex);
     $c->setName($name);
     $c->setSecondName($secondName);
     $c->setCodeId($codeId);
     $c->save();
   }
   
     
   
   /**
    * Генерит случайное имя исходя из поля
    * @param int $sex пол
    * @return строка 
    */
   protected function getFio($sex){
       
       $names=[
           WOMEN  => ['Жанна Агузарова',
                  'Валентина Терешкова',
                  'Клара Цеткин',
                  'Леся Украинка',
                  'Тетка Теткина',
                  'Девкина Девкина  '
                 ]
           ,
           MEN  =>[ 'Сергей Шнуров ',
                   'Юрий Гагарин',  
                   'Алеша Попович',
                   'Тугарин Змей',
                   'Юрий Дудь',
                   'Дед Мозая'
                 ]
           
           
       ];
       
       do{
         $fio=useful::getRand($names[$sex]);               
       } while(in_array($fio , $this->doneFio  ));
       
              $this->doneFio[]=$fio;
       return $fio;
   }
   
   
   
   /**
    * Геренрит дату рождения
    * @return \DateTime
    */
   protected function getBirthday(){
     $dates=\tools\useful::getDatesInRange('01.01.1980', '01.01.1990');
     return  useful::getRand($dates) ;
   }
   
   /**
    * Генерит ид код из 12 цифр
    */
   protected function setIdCodes(){
     $numPers=$this->numPers;   
     while($numPers--){
         $code='';
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
