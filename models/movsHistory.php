<?php

/**
 * Класс для записи истории движений
 *
 * @author grynchuk
 * @property int        $id         Ид
 * @property int        $count      счет
 * @property float      $moveSum    сумма движения
 * @property int        $moveId     тип движения
 * @property \DateTime  $date       дата движения
 */
class movsHistory extends baseModel {
    protected $id,
              $count,
              $moveSum,
              $moveId,
              $date;
    
     public function getSource()
    {
        return "movsHistory";
    }
    
      function getId() {
          return $this->id;
      }

      function getCount() {
          return $this->count;
      }

      function getMoveSum() {
          return $this->moveSum;
      }

      function getMoveId() {
          return $this->moveId;
      }

      function getDate() {
          return $this->date;
      }


      function setCount($count) {
          $this->count = $count;
      }

      function setMoveSum(\movsLogic $ml) {
          $this->moveSum = $ml->getSum();
      }

      function setMoveId($moveId) {
          $this->moveId = $moveId;
      }

      function setDate(\DateTime $date) {
          $this->date = $date->format('Y-m-d');
      }     
}
