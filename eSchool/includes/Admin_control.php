<?php
    class Admin_control {
        
        public function Admin_method(){
          $task = (isset($_REQUEST['task']))?$_REQUEST['task']:'Academics';
          require_once('App_class/'.$task.'.php');
          $obj = new $task();
          $obj->run();
          
        }
        
        
    }
?>