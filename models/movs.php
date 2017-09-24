<?php

/**
 * типы движений с коеф. 
 *
 * @author grynchuk
 * @property int    $id     ид
 * @property int    $coef   коеф. указывающий на то что это  списания со счета (-1)  начисления(1) 
 * @property string $name   название типа
 */
class movs extends baseModel {
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
