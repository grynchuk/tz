<?php
use \Phalcon\Mvc\Model;
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
class movsHistory extends Model {
    protected $id,
              $count,
              $moveSum,
              $moveId,
              $date;
    
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

      function setMoveSum($moveSum) {
          $this->moveSum = $moveSum;
      }

      function setMoveId($moveId) {
          $this->moveId = $moveId;
      }

      function setDate($date) {
          $this->date = $date;
      }     
}
