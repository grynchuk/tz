<?php

namespace tools\dataMaker;

/**
 * Добавляет депозит к клиенту 
 * сослучайно сгенеренными параметрами
 *
 * @author grynchuk
 */
class deposit {
         function __construct() {
             
         }
         
         function make(\clients $c){
               
         //    $c= \clients::findFirst(36);
             
             $o= new \operation();
             $o->setClient($c);
             $o->setDate($this->getDate());
             $o->makeDeposit( 
                     $this->getSum() ,
                     $this->getStavka()
                     );
         }
         
         
         function getDate(){
                $start=  \DateTime::createFromFormat('d.m.Y','01.01.2017');
                $it= clone $start;
                $end  =  \DateTime::createFromFormat('d.m.Y','01.12.2017');
                $int= new \DateInterval('P1D');
                $d=[];
                  while($it<$end){
                         $it->add($int);
                          
                     $d[]=clone $it;        
                  } 
                  
                return \tools\useful::getRand($d);  
         }
         
         function getSum(){
             $opt=[
                 [0    , 1000   ],
                 [1000 , 10000  ],
                 [10000, 100000 ],
             ];
             $ind= rand(0, 2);        
             
             return rand($opt[$ind][0],$opt[$ind][1] );
         }
         
         function getStavka(){
             $stavki=[
                 1.5
               , 10
               , 12
               , 15
               , 20  
             ];
             return \tools\useful::getRand($stavki);
         }
}
