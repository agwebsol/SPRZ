<?php
    class search {
        var $_params;
        public function __construct($params){
          $this->_params = $params;  
        }
        public function list_student_subclass(){
            include('db_connect.php');
            $sql = "SELECT * FROM Register WHERE Subclass = '$this->_params'";
            $result = $conn->query($sql);
            $array = array();
            if($result=$conn->query($sql)){
                while ($row = mysqli_fetch_assoc($result)){
                    foreach ($row as $key=>$value){
                        error_reporting(E_ALL ^ E_NOTICE);
                        $array[$key].=$value.'*';
                        }
                        
                }
                $json = json_encode($array);
                echo  $json;
                
            }
        }
        
        public function list_student_class(){
            include('db_connect.php');
            $sql = "SELECT * FROM Register WHERE Class = '$this->_params'";
            $result = $conn->query($sql);
            $array = array();
            if($result=$conn->query($sql)){
                while ($row = mysqli_fetch_assoc($result)){
                    foreach ($row as $key=>$value){
                        error_reporting(E_ALL ^ E_NOTICE);
                        $array[$key].=$value.'*';
                        }
                        
                }
                $json = json_encode($array);
                echo  $json;
                
            }
        }
        
        public function list_teacher(){
            include('db_connect.php');
            $sql = "SELECT * FROM Teacher_Table";
            $result = $conn->query($sql);
            $array = array();
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    foreach($row as $key => $value){
                        error_reporting(E_ALL ^ E_NOTICE);
                        $array[$key] .=$value.'*';
                    }
                    
                }
                $json = json_encode($array);
                echo $json;
                
            }
            
            
        }
        
        public function list_all_Student(){
            include('db_connect.php');
            $sql = "SELECT * FROM Register";
            $result = $conn->query($sql);
            $array = array();
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    foreach($row as $key => $value){
                        error_reporting(E_ALL ^ E_NOTICE);
                        $array[$key] .=$value.'*';
                    }
                    
                }
                $json = json_encode($array);
                echo $json;
                
            }
            
        }
        
        public function list_Student_Room(){
            include('db_connect.php');
            $sql = "SELECT * FROM Register WHERE Room_No='$this->_params'";
            $result = $conn->query($sql);
            $array = array();
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    foreach($row as $key => $value){
                        error_reporting(E_ALL ^ E_NOTICE);
                        $array[$key] .=$value.'*';
                    }
                    
                }
                $json = json_encode($array);
                echo $json;
                
            }
            
        }
        
        public function list_rooms(){
            include('db_connect.php');
            $sql = "SELECT * FROM Hostels WHERE Block_Name = '$this->_params'";
            $result = $conn->query($sql);
            $array = array();
            if($result=$conn->query($sql)){
                while ($row = mysqli_fetch_assoc($result)){
                    foreach ($row as $key=>$value){
                        error_reporting(E_ALL ^ E_NOTICE);
                        $array[$key].=$value.'*';
                        }
                        
                }
                $json = json_encode($array);
                echo  $json;
                
            }
            
        }
    //ENd
    }    
?>