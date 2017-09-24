<?php
/**
 * Класс счетов
 *
 * @author grynchuk
 * @property int $id Ид
 * @property int $client ид клиента
 * @property int $deposit Ид депозита
 * 
 */
class counts extends baseModel {
    protected $id,
              $client,
              $deposit;

      function getId() {
          return $this->id;
      }

      function getClient() {
          return $this->client;
      }

      function getDeposit() {
          return $this->deposit;
      }

      
      function setClient($client) {
          $this->client = $client;
      }

      function setDeposit($deposit) {
          $this->deposit = $deposit;
      }
      /**
       * Получает текущую ситуацию по счету
       * @return string
       */
      public function getCurrentSum(){
         $conn= \tools\dbConn::getConn();
         
        $sql = 'select sum( mH.moveSum * m.coef) as cs 
                from 
                 movsHistory  mH, 
                 movs m
                where mH.count='.$this->id.'
                   and mH.moveId=m.id
                group by mH.count
                ';

        $rs = $conn->query($sql);
        $rs=$rs->fetchAll($rs);
        return $rs[0][0];
      }
      
    
}
