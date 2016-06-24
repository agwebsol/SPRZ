<?
    class Student_control{
       public function index(){
        $task = (isset($_REQUEST['task']))?$_REQUEST['task']:'Student_index';
        require_once('App_class/'.$task.'.php');
        $obj = new $task();
        $obj->run();
        }
        
        public function authorize(){
            
            if(!isset($_SESSION['student_id'])){
                header('LOCATION: login_student.php?login=no');
            }
        }
    }
?>