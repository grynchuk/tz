<?php
use Phalcon\Mvc\Controller;

class ReportsController extends Controller
{
    public function indexAction()
    {
          
    }

    public function reportOneAction()
    {
          // Pass the $postId parameter to the view
        
$sex1= \bank\sex::find();
         
     foreach($sex1 as $s){
       
        var_dump( $s->getId()  , mb_detect_encoding($s->getName())   );
       
         
     }

       die();
        $this->view->report = 1;
    }
    
    
    public function reportTwoAction($arg1,$arg2)
    {
    
          // Pass the $postId parameter to the view
        $this->view->report = 2;
    }
    
}