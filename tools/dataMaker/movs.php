<?php

namespace tools\dataMaker;

use  tools\useful;
/**
 * Создает типы движений
 *
 * @author grynchuk
 */
class movs {
  function __construct(){
       
  }
  function make(){
    $movs=[
         1=>'Вклад',
        -1=>'Комисcия',
         1=>'Выплата процентов'
    ];
    
    foreach($movs as $coef =>$name){
        $this->makeMove($coef, $name);
    }
      
  }
  
  function makeMove($coef, $name){
      $m= new \movs();
      $m->setCoef($coef);
      $m->setName($name);
      $m->save();
  }
  
}
