<?php
    class Admin_cmsFunction {
        public function run(){
            $method = (isset($_REQUEST['app']))?$_REQUEST['app']:'index';
            $this->$method();
             }
        
    }
?>