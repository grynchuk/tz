<?php

namespace tools;

/**
 * класс с полезными методами
 *
 * @author grynchuk
 */
class useful {
    /**
     * Логирует сообщения 
     * @param string $mess
     * @param bool $isConsole 
     */
    public static function logMess($mess,$isConsole=true){
        $date=new \DateTime();
        $template=[
          '<br>',
          PHP_EOL
        ];
        
        echo sprintf(' %1$s    %2$s  '.$template[intval($isConsole)],$date->format('d.m.Y H:i:s'),$mess );
        
    }
    
    /**
     * Получает случайное значение из массива
     * @param array $arr
     * @return mixed
     */
    public static function getRand($arr){
        return $arr[rand(0,count($arr)-1)];
    }
    
    /**
     * Тест функции формат getDatesInRange
     */
    public static function testDates(){
        $res=self::getDatesInRange('01.09.2017', '01.10.2017');
        foreach($res as $val){
            self::logMess($val->format('d.m.Y'));
        }
    } 
    
    /**
     * Получаем набор дней подряд из указанного деапозона 
     * @param string $start  формат   'd.m.Y'
     * @param string $end    формат   'd.m.Y'
     * @return type
     */
    public static function getDatesInRange(  $start,   $end){
        static $store=[];
        
        $key=$start."_".$end;
        if(!isset($store[$key])){ 
                    
        $start= \DateTime::createFromFormat('d.m.Y', $start);
        $end=   \DateTime::createFromFormat('d.m.Y', $end);
        $int= new \DateInterval('P1D');
        $res=[];
        while($start<$end){
         $res[]=  clone $start;
         $start->add($int);
        }
         $store[$key]=$res;   
        }
           
        return  $store[$key];
    }
    
    /**
     * Выполняет запрос
     * @param type $q
     * @return array
     */    
    public static function getQueryRes($q){
         
        $conn= \tools\dbConn::getConn(); 
        $rs = $conn->query($q);
        $rs->setFetchMode( \Phalcon\Db::FETCH_NUM );
        $rs=$rs->fetchAll($rs);
        
        return $rs;
    }
    /**
     * Вывод таблици
     * @param type $data
     * @param type $head
     * @return string
     */
    public static function showTab($data, $head){
        $o='<table>';
        $o.='<tr>';
        foreach($head as $h){
         $o.="<td>".$h."</td>";    
        }
        $o.='</tr>';
        foreach( $data  as $row  ){
             $o.='<tr>';
               foreach($row as $t  
                       ){
                          $o.="<td>".$t."</td>";
                       }
             $o.='</tr>';      
        };
        return $o;
    }
    
    
}
