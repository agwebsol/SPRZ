<?
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    session_start();
    class login extends CI_Controller{
        function __construct(){
            parent::__construct();
        }
        
        function index(){
            if(isset($_POST['submit'])){
               $_SESSION['user'] = $_POST['user'];
               $_SESSION['pass'] = $_POST['pass'];
               if($_SESSION['user']==='Admin')
               header('LOCATION: index.php/Admin');
            }
            $this->load->view('Backend/login.php');
        }
    
    }
?>