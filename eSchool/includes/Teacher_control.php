<?
    class Teacher_control{
       public function index(){
        $task = (isset($_REQUEST['task']))?$_REQUEST['task']:'Teacher_index';
        require_once('App_class/'.$task.'.php');
        $obj = new $task();
        $obj->run();
        }
        public function authorize(){
            
            if(!isset($_SESSION['teacher_id'])){
                header('LOCATION: login_teacher.php?login=no');
            }
        }
    }
?>