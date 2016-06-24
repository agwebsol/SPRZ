<?
require('includes/Admin_cmsFunction.php');
class register_exe extends Admin_cmsFunction {
    function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }
    public function register(){
        if(isset($_POST['submit'])){
            $fname =$this->test_input($_POST['fname']);
            $sname =$this->test_input($_POST['sname']);
            $dob =$this->test_input($_POST['dob']);
            $address =$this->test_input($_POST['address']);
            $state =$this->test_input($_POST['state']);
            $nation =$this->test_input($_POST['nation']);
            $lga =$this->test_input($_POST['lga']);
            $rel =$this->test_input($_POST['rel']);
            $add_no = rand(0,100000000);
            $gender =$this->test_input($_POST['gender']);
            $class =$this->test_input($_POST['class']);
            $subclass = $this->test_input($_POST['subclass']);
            $term =$this->test_input($_POST['term']);
            $session =$this->test_input($_POST['session']);
            $accom =$this->test_input($_POST['accom']);
            $status =$this->test_input($_POST['status']);
            $pname = $this->test_input($_POST['pname']);
            $padd = $this->test_input($_POST['padd']);
            $parent_phone = $this->test_input($_POST['parent_phone']);
            $pemail = $this->test_input($_POST['pemail']);
            $emrcontact = $this->test_input($_POST['emrcontact']);
            $name = $fname.' '.$sname;
            $errMsg = false;
            $s_class = $class.$subclass;
            $image = '';
                
            
            
            require_once('db_connect.php');
            $sql = "SELECT * FROM Register WHERE Name = '$name'";
            $result = $conn->query($sql);
            if(mysqli_num_rows($result)<1){
                $sql_insert = "INSERT INTO Register (ID, Name, CLass, Student_ID, Gender, Subclass, Session, Room_No) VALUES
                ('NULL','$name', '$class','$add_no','$gender','$s_class', '$session', '$accom')";
                $insert = $conn->query($sql_insert);
                if($insert){
                    
                    if(isset($_FILES["image"]["name"])){
                        $target_dir = "/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Images/";
                        $img = basename($_FILES["image"]["name"]);
                        $target_file = $target_dir.$img;
                        $this->image = $img;
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        $check = getimagesize($_FILES["image"]["tmp_name"]);
                        if($check !== false) {
                            
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                        if (file_exists($target_file)) {
                        echo "Sorry, file already exists.";
                        $uploadOk = 0;
                        }
                        if ($_FILES["image"]["size"] > 500000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                        }
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                        }
                        if ($uploadOk == 0) {
                                echo "Sorry, your file was not uploaded.";
                            } else {
                                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                        
                                    } else {
                                            echo "Sorry, there was an error uploading your file.";
                                        }
                                }
                    
                    }else{echo 'Failed';}
                    
                    
                    $register = array(
                    "fname" => $fname,
                    "sname" => $sname,
                    "address" => $address,
                    "dob" =>$dob,
                    "state" =>$state,
                    "nation" =>$nation,
                    "lga" =>$lga,
                    "rel" => $rel,
                    "add_no" =>$add_no,
                    "gender" =>$gender,
                    "class" =>$class,
                    "subclass" =>$subclass,
                    "term" =>$term,
                    "session" =>$session,
                    "accom" =>$accom,
                    "status" =>$status,
                    "pname" =>$pname,
                    "padd" =>$padd,
                    "parent_phone" =>$parent_phone,
                    "pemial" => $pemail,
                    "emrcontact" => $emrcontact,
                    "image" => $this->image
                    
                    );
                    
                    $js = json_encode($register);
                    $folder = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Student_Info/'.$add_no.'.txt';
                    $file = fopen($folder, "w");
                    fwrite($file, $js);
                    fclose($file);
                    $str = explode(" ", $class);
                    $report =$str[0];
                    $report_card = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Grades/'.$add_no.'.txt';
                   
                    
                    if($report=='Primary'){
                        $subject = array(
                            "Mathematics" => '',
                            "English" => "",
                            "Social Studies" => "",
                            "Science" => "",
                            "Home Economics" => "",
                            "Fine Art" =>"",
                            "Religious Studies" => "",
                            "Qualitative-Reasoning" =>"",
                            "Physical Education" =>"",
                            "Religious-Studies" =>"",
                            "Computer-Science" => "",
                            "Vocabulary" =>""
                        );
                        $entry=json_encode($subject);
                        $year = array(
                            "Term1" => $entry,
                            "Term2" => $entry,
                            "Term3" => $entry
                             );
                        $sub = json_encode($year);
                        $file = fopen($report_card, "w");
                        fwrite($file, $sub);
                        fclose($file);
                          
                    }
                    
                    if($report=='JSS'){
                        $subject = array(
                            "Mathematics" => '',
                            "English" => "",
                            "Science" => "",
                            "Intro Technology" => "",
                            "Social-Studies" => "",
                            "Agriculture" =>"",
                            "Religious Studies" => "",
                            "Agriculture" =>"",
                            "Physical Education" =>"",
                            "Relgious-Studies" => "",
                            "Fine Art"=> "",
                            "Computer Science" => "",
                            "Literature" =>"",
                            "Economics" => "",
                            "Music" => ""
                        );
                        $entry=json_encode($subject);
                        $year = array(
                            "Term1" => $entry,
                            "Term2" => $entry,
                            "Term3" => $entry
                             );
                        $sub = json_encode($year);
                        $file = fopen($report_card, "w");
                        fwrite($file, $sub);
                        fclose($file);
                          
                    }
                    
                    if($report=='SSS'){
                        $subject = array(
                            "Mathematics" => '',
                            "English" => "",
                            "Biology" => "",
                            "Science" => "",
                            "Chemistry" => "",
                            "Physics" =>"",
                            "Futher Mathematics" => "",
                            "Literature" =>"",
                            "Economics" =>"",
                            "Geography" => "",
                            "Art" => "",
                            "History" =>"",
                            "Music" => "",
                            "Government" =>"",
                            "Agriculture" => "",
                            "Computer Science" =>""
                        );
                        $entry=json_encode($subject);
                        $year = array(
                            "Term1" => $entry,
                            "Term2" => $entry,
                            "Term3" => $entry
                             );
                        $sub = json_encode($year);
                        $file = fopen($report_card, "w");
                        fwrite($file, $sub);
                        fclose($file);
                          
                    }
                    
                    
                    ?>
                        <body onload="student()">
                        <? include('html/Student.html'); ?>
                            <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                                <div class="panel heading"><span class="glyphicon glyphicon-ok"></span></div>
                                <div class="panel-body">
                                    New Student Added To The Database.
                                </div>
                            </div>
                        </body>
                    <?
                }
            }else{
                ?>
                    <body onload="student()">
                        <? include('html/Student.html'); ?>
                        <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                            <div class="panel heading"><span class="glyphicon glyphicon-remove"></span></div>
                            <div class="panel-body">
                                Student Already Exist.
                            </div>
                        </div>
                    </body>
                <?
            }
        }
    }
}
?>