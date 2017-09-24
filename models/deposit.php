<?php

/**
 * Description of deposit
 *
 * @author grynchuk
 * 
 * @property int          $id           Ид
 * @property float        $rate         процентная ставка
 * @property \DateTime    $endDate      когда закончится время вклада
 * @property \DateTime    $dateBegin    когда сделали вклад
 * @property float        $sum     сумма вклада
 */


class deposit extends baseModel {
    
    protected $id,
              $rate,              
              $endDate,
              $dateBegin,
              $sum;
    
      function getId() {
          return $this->id;
      }

      function getRate() {
          return $this->rate;
      }

      function getEndDate() {
          return $this->endDate;
      }

      function getDateBegin() {
          return $this->dateBegin;
      }

      function getSum() {
          return $this->sum;
      }

      function setId($id) {
          $this->id = $id;
      }

      function setRate($rate) {
          $this->rate = $rate;
      }

      function setEndDate(\DateTime $dateEnd) {
          $this->endDate = $dateEnd->format('Y-m-d');
      }

      function setDateBegin(\DateTime $dateBegin) {
         $this->dateBegin = $dateBegin->format('Y-m-d');
      }

      function setSum($sum) {
          $this->sum = $sum;
      }

      
  //$this->dateBegin = $dateBegin->format('Y-m-d');
    
}
