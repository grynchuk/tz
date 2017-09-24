<?php
use Phalcon\Mvc\Controller;
use \tools\useful;
class ReportsController extends Controller
{
    public function indexAction()
    {
          
    }

    public function reportBankProfitAction()
    {
        $sql="select  dd.mon ,  sum(  dd.mov )
from
(
select date_format(  mH.date, '%m.%Y' ) as mon ,   
       
       mH.moveSum 
	   *
       (
        case when mH.moveId=10 then 0
        else m.coef
        end   
        ) as mov
from 
 bank.movsHistory  mH, 
 bank.movs m
where   mH.moveId=m.id
) dd
group by dd.mon
order by  dd.mon desc
" ;  
      $data=useful::getQueryRes($sql);
      
       
      $this->view->data=$data; 
    }
    
    
    public function reportAvgDepAction()
    {
    
        $sql1="
select 
 
  avg(
   case when cl.bd>18 and cl.bd<=25 then dp.sum 
   else 0
   end 
   )
  ,
   avg(
   case when cl.bd>25 and cl.bd<=50 then dp.sum 
   else 0 
   end
   )
,
   avg(
   case when cl.bd>50 then dp.sum 
   else 0 
  end
   )
 
from 
bank.deposit dp,
bank.counts c,
(select *, floor(datediff(curdate(),birthday) / 365) as bd from bank.clients) cl
where  c.deposit=dp.id 
  and  c.client=cl.id 
";
        $sql2="
select 
 
  sum(
   case when cl.bd>18 and cl.bd<=25 then 1 
   else 0
   end 
   )
  ,
   sum(
   case when cl.bd>25 and cl.bd<=50 then 1 
   else 0 
   end
   )
,
   sum(
   case when cl.bd>50 then 1
   else 0 
  end
   )
 
from 
bank.deposit dp,
bank.counts c,
(select *, floor(datediff(curdate(),birthday) / 365) as bd from bank.clients) cl
where  c.deposit=dp.id 
  and  c.client=cl.id 
";
        
        $dataSum=useful::getQueryRes($sql1);
        $dataCol=useful::getQueryRes($sql2);      
       
      $this->view->dataSum=$dataSum;
       $this->view->dataCol=$dataCol;
    }
    
}