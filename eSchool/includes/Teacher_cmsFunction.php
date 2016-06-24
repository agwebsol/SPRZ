<?
class Teacher_cmsFunction{
    public function run(){
        $method = (isset($_REQUEST['app']))?$_REQUEST['app']:'index_Teacher';
        $this->$method();
    }
}
?>