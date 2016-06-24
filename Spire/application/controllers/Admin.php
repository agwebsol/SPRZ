<?
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    session_start();
    class Admin extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }
        
        public function index(){
            $this->dashboard();
        }
        
        public function dashboard(){
            $page['title'] ='dashboard';
            $page['portal'] = 'Admin';
            $this->load->view('backend/index', $page);
        }
        
        public function manage_student(){
            $page['title'] ='manage_student';
            $page['portal'] ='Admin';
            $this->load->view('backend/index', $page);
            if(isset($_POST['submit'])){
                $fname = $this->test_input($_POST['fname']);
                $sname = $this->test_input($_POST['sname']);
                $gender = $this->test_input($_POST['gender']);
                $dob = $this->test_input($_POST['dob']);
                $pob = $this->test_input($_POST['pob']);
                $nation = $this->test_input($_POST['nation']);
                $month = $this->test_input($_POST['month']);
                //$entry_level = $this->test_input($_POST['entry_level']);
                $previous_school = $this->test_input($_POST['previous_school']);
                $religion = $this->test_input($_POST['religion']);
                $father = $this->test_input($_POST['father']);
                $father_work = $this->test_input($_POST['father_work']);
                $father_office = $this->test_input($_POST['father_office']);
                $father_email = $this->test_input($_POST['father_email']);
                $father_home = $this->test_input($_POST['father_home']);
                $mother = $this->test_input($_POST['mother']);
                $mother_work = $this->test_input($_POST['mother_work']);
                $mother_office = $this->test_input($_POST['mother_office']);
                $mother_email = $this->test_input($_POST['mother_email']);
                $mother_home = $this->test_input($_POST['mother_home']);
                $payer = $this->test_input($_POST['payer']);
                $name_contact = $this->test_input($_POST['name_contact']);
                $contact_address = $this->test_input($_POST['contact_address']);
                $section = $this->test_input($_POST['section']);
                $student_id = rand(0, 100000000);
                $array = array(
                  "Fname" => $fname,
                  "Sname" => $sname,
                  "Gender" => $gender,
                  "DOB" => $dob,
                  "POB" => $pob,
                  "Nation" => $nation,
                  "Month" => $month,
                  "Entry_level" =>"",
                  "Section" => $section,
                  "Previous_school" => $previous_school,
                  "Religion" => $religion,
                  "Father" =>$father,
                  "Father_work" => $father_work,
                  "Father_office" => $father_office,
                  "Father_email" => $father_email,
                  "Father_home" => $father_home,
                  "Mother" =>$mother,
                  "Mother_work" => $mother_work,
                  "Mother_office" => $mother_office,
                  "Mother_email" => $mother_email,
                  "Mother_home" => $mother_home,
                  "Payer" => $payer,
                  "name_contact" => $name_contact,
                  "contact_address" => $contact_address,
                  "Student_ID" => $student_id
                );
                $js_arry = json_encode($array);
                echo $js_arry;
            }
        }
        
        public function manage_class($param1 =''){
            $data['title'] = 'manage_class';
            $data['portal'] = 'Admin';
            $data['page'] =$param1;
            if($param1=='create'){
                
            }else{
                $this->load->view('backend/index', $data);
            }
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }
?>