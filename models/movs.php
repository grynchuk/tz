<?php
use \Phalcon\Mvc\Model;
/**
 * типы движений с коеф. 
 *
 * @author grynchuk
 * @property int    $id     ид
 * @property int    $coef   коеф. указывающий на то что это убыток(-1) прибыль(1) или тип без движений 0
 * @property string $name   название типа
 */
class movs extends Model {
    protected $id
             ,$coef
             ,$name;
     function getId() {
         return $this->id;
     }

     function getCoef() {
         return $this->coef;
     }

     function getName() {
         return $this->name;
     }
     

     function setCoef($coef) {
         $this->coef = $coef;
     }

     function setName($name) {
         $this->name = $name;
     }


}
