<?php


/**
 * Класс банковских операций
 *
 * @author grynchuk
 * @property \clients $client Клиент
 * @property \counts  $count Счет 
 * @property \date    $date Дата операции
 */
class operation {
    
    private $client,
            $count,
            $date;
    
    function setClient(\clients $client) {
        $this->client=$client;
    }
    
    function getDate() {
        return $this->date;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }

        
    
    function getClient(){
        return $this->client;
    }
      /**
       * Взымает комиссию по счету
       */
     function makeCommission(){
        $this->makeMoneyOp(MOVE_COMMISSION);
     } 
     /**
      * Делает начисление процентов по депозиту
      */
     function makePayment(){             
         $this->makeMoneyOp(MOVE_PAYMENT);
     }
     
     /**
      * делает начисление или списание денег со счета в зависимости от типа
      * @param type $type
      * @throws \Exception
      */
     private function makeMoneyOp($type){
        if(!$this->count) throw new \Exception('не задан счет'); 
         
        $hist= new \movsHistory();
        $hist->setCount($this->count->getId());
        $hist->setDate($this->date);
        $hist->setMoveId($type);        
        $logic=\movsLogic\factory::getLogic($this->count, $type);           
        $hist->setMoveSum($logic);       
        $hist->save();
     }
            /**
             * Добавляет депозит клиенту 
             * @param type $sum сумма
             * @param type $rate ставка
             * @throws \Exception 
             */ 
      function makeDeposit($sum, $rate){
       $dep='';   
       try{   
        // Добавляем счет условие один счет один депозит
        $this->addCount();   
           
           
        $dep= new \deposit();
        $b=clone $this->date;
        $dep->setDateBegin($b);
        $b->add(new \DateInterval('P1Y'));
        $dep->setEndDate($b);
        $dep->setRate($rate);        
        $dep->setSum($sum);
        $dep->save();
       //связываем счет и депозит
        $this->count->setDeposit($dep->getId());
        $this->count->save();
        //Устанавливаем движение
        $hist= new movsHistory();
        $hist->setCount($this->count->getId());
        $hist->setDate($this->date);
        $hist->setMoveId(MOVE_DEPOSIT);
        // Получаем логику расчета суммы начисления
        $logic=\movsLogic\factory::getLogic($this->count, MOVE_DEPOSIT);
        
        $hist->setMoveSum($logic);
        $hist->save();
       }catch(\Exception $e){
           if($this->count){ $this->count->delete(); }
           if($dep){ $dep->delete(); }
          
          throw new \Exception($e->getMessage());     
       } 
        
      }
    
      
      
      
      
      
      function setCount(\counts $count){
          $this->count=$count;
      }
      
      function getCount(\counts $count){
          $this->count=$count;
      }
      
      /**
       * Добавляет счет клиенту
       */
      function addCount(){
        $this->count= new \counts();
        $this->count->setClient($this->client->getId());        
        $this->count->setDeposit(0);        
        $this->count->save();
      }
      
      
    
}
