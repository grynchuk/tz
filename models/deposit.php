<?php
use \Phalcon\Mvc\Model;
/**
 * Description of deposit
 *
 * @author grynchuk
 * 
 * @property int          $id           Ид
 * @property float        $stavka       процентная ставка
 * @property int          $term         количество дней когда она действет, деплзит млогут и продлить 
 * @property \DateTime    $dateBegin    когда сделали вклад
 * @property float        $sumStart     сумма вклада
 */
class deposit extends Model {
    
    protected $id,
              $stavka,
              $term=365,
              $dateBegin,
              $sumStart;
      function getStavka() {
          return $this->stavka;
      }

      function getTerm() {
          return $this->term;
      }

      function getDateBegin() {
          return $this->dateBegin;
      }

      function getSumStart() {
          return $this->sumStart;
      }

      function setStavka($stavka) {
          $this->stavka = $stavka;
      }

      function setTerm($term) {
          $this->term = $term;
      }

      function setDateBegin($dateBegin) {
          $this->dateBegin = $dateBegin;
      }

      function setSumStart($sumStart) {
          $this->sumStart = $sumStart;
      }

      function getId() {
          return $this->id;
      }


    
}
