<?php

use tools\useful;
/**
 * Логика что срабатывает при кроне
 * 
 * @author grynchuk
 */
class cron {
    
    public function __construct() {
      $this->conn=\tools\dbConn::getConn();
              
     }
    /**
     * Совершаем выполнение опраций по крону
     */
    function makeOps(){
        $this->make(new \DateTime());
    } 
     
    /**
     * Генерим движения в диапозоне дат 
     * для ысех клиентов сделал для того чтоб заполнить БД и сделать отчеты
     */ 
    function makeMyOps(){
       $start=  \DateTime::createFromFormat('d.m.Y','01.12.2016');
       $it= clone $start;
       $end  =  \DateTime::createFromFormat('d.m.Y','01.12.2019');
       $int= new \DateInterval('P1D');
       
      while($it<$end){
       $it->add($int);
       //\tools\useful::logMess($it->format('d.m.Y'));
       $this->make($it);
      }  
        
        
    }  
     
    /**
     * Функция совершает движения для указанной даты
     * @param \DateTime $d
     */ 
    private  function make(\DateTime $d){
      $day=clone $d;
      
      //var_dump($day);
      
      $counts=$this->getCountsOnDay($day);
       
      
      foreach($counts as $cId){          
          try{
          $count= \counts::findFirst($cId);
          $op= new \operation();
          $op->setDate($day);
          $op->setCount($count);
          $op->makePayment();   
          }catch(\Exception $e){
           useful::logMess( $e->getMessage())    ;
          }
      }
      
      
      if( (int)$day->format('d')
              ==
              1
        ){
          $countsCom= $this->getActiveCounts($day);
           
          foreach($countsCom as $cc){
              try{
              $c=\counts::findFirst($cc);    
                  
              $op= new \operation();
              $op->setCount($c);
              $op->setDate($day);
              $op->makeCommission();
              }catch(\Exception $e){
               useful::logMess( $e->getMessage())    ;
              }
          } 
          
        }
        
    }
    
    /**
     * выбираем все счета который были заведены до даты 
     * @param \DateTime $day
     * @return type
     */
    
    private function getActiveCounts(\DateTime $day){
        $res=[];
        $sql="
select c.id
from   bank.deposit dep
     , bank.counts  c
where  
dep.id=c.deposit
and
STR_TO_DATE('".$day->format('d.m.Y')."', '%d.%m.%Y') > dep.dateBegin";
        $rs = $this->conn->query($sql);
      $rs=$rs->fetchAll($rs);  
      $res=[];
      foreach($rs as $val){
        $res[]=$val[0];    
      } 
        return $res;
    }
    
    /**
     * Обираем счета по которым в указаную датц нужно совершить начисления 
     * @param \DateTime $day
     * @return type
     */
    private function getCountsOnDay(\DateTime $day){
        
        
        
        $sql="

select c.id
from   bank.deposit dep
      , bank.counts  c
where  
dep.id=c.deposit
and 
STR_TO_DATE('".$day->format('d.m.Y')."', '%d.%m.%Y') <= dep.endDate
and
STR_TO_DATE('".$day->format('d.m.Y')."', '%d.%m.%Y') > dep.dateBegin    
    
and
date_format( dep.dateBegin , '%d')= date_format( STR_TO_DATE('".$day->format('d.m.Y')."', '%d.%m.%Y') , '%d' )

union 

select c.id
from   bank.deposit dep
     , bank.counts  c
where  
dep.id=c.deposit

and
STR_TO_DATE('".$day->format('d.m.Y')."', '%d.%m.%Y') <= dep.endDate
and
STR_TO_DATE('".$day->format('d.m.Y')."', '%d.%m.%Y') > dep.dateBegin    
    
and

date_format( dep.dateBegin , '%d')=31
/* сегодня последний день месяца  и в этом месяце 30 дней */
and 

date_format(             STR_TO_DATE('".$day->format('d.m.Y')."', '%d.%m.%Y') ,  '%m'  )!=
date_format(   DATE_ADD( STR_TO_DATE('".$day->format('d.m.Y')."', '%d.%m.%Y') , interval 1 day ) , '%m' )
and
date_format( STR_TO_DATE('".$day->format('d.m.Y')."', '%d.%m.%Y'), '%d')!=31
";
        
      
      $rs = $this->conn->query($sql);
      $rs=$rs->fetchAll($rs);  
      $res=[];
      foreach($rs as $val){
        $res[]=$val[0];    
      } 
      return $res;
    }
    
    
   
    
}
