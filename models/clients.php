<?php
use \Phalcon\Mvc\Model;
/**
 * Класс клиента с указанными свойствами
 * 
 * @author grynchuk
 * 
 * @property int        $id      Ид
 * @property int        $codeId  Идентификационный еод
 * @property string     $name    Имя
 * @property int        $sex      ИД пола
 * @property \DateTime  $birthday день рождения
 */
class clients extends Model {
    protected $id,
              $codeId,
              $name,
              $secondName,
              $sex, 
              $birthday;
    
      function getId() {
          return $this->id;
      }

      function getCodeId() {
          return $this->codeId;
      }

      function getName() {
          return $this->name;
      }

      function getSecondName() {
          return $this->secondName;
      }

      function getSex() {
          return $this->sex;
      }

      function getBirthday() {
          return $this->birthday;
      }

      

      function setCodeId($codeId) {
          $this->codeId = $codeId;
      }

      function setName($name) {
          $this->name = $name;
      }

      function setSecondName($secondName) {
          $this->secondName = $secondName;
      }

      function setSex($sex) {
          $this->sex = $sex;
      }

      function setBirthday( \DateTime $birthday) {
          $this->birthday = $birthday;
      }
      
}
