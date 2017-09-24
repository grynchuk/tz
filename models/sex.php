<?php

/**
 * Класс полов клиентов
 * @author grynchuk
 * 
 * @property int    $id   идентификатор
 * @property string $name Название пола
 */
class sex extends baseModel{
  protected   $id,
              $name ;
  
  
      function getId() {
          return $this->id;
      }
 
      function getName() {
          return $this->name;
      }
      
      function setName($name) {
          $this->name = $name;
      }
      
      }

