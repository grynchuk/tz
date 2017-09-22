<?php
use \Phalcon\Mvc\Model;
/**
 * Класс счетов
 *
 * @author grynchuk
 * @property int $id Ид
 * @property int $client ид клиента
 * @property int $deposit Ид депозита
 * 
 */
class counts extends Model {
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
    
}
