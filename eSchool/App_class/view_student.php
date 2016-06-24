<?
require_once('includes/Admin_cmsFunction.php');
     class view_student extends Admin_cmsFunction{
        public function student(){
            if(isset($_POST['submit'])){
                $class = $_POST['class'].$_POST['subclass'];
                $search = array(
                  "class" => "search",
                  "method" =>"list_student_subclass",
                  "params" => $class
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://localhost/SMS/Backend/");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($search));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                curl_close ($ch);
                $json_result = json_decode($result, TRUE);
                $array_result = array($json_result);
                ?>
                    <html>
                        <head>
                            
                        </head>
                        <body onload="student()">
                            <?include('html/Student.html');?>
                           <div class="panel panel-primary">
                              <div class="panel-heading"><h5><span class="glyphicon glyphicon-blackboard"></span> <? echo $class; ?></h5></div>
                              <div class="panel-body">
                                 <table class="table table-hover" style="width: 100%;">
                                     <tr><th>Name</th><th>Student ID<th/></tr>
                                         <?   
                                        if(count($array_result)>0){
                                            error_reporting(E_ALL ^ E_NOTICE);
                                            foreach($array_result as $key){
                                                $id = explode('*', $key['ID'] );
                                                $name = explode('*', $key['Name'] );
                                                $admission = explode('*', $key['Student_ID'] );
                                                $class = explode('*', $key['Class'] );
                                                 for($i=0; $i<count($id)-1; $i++){
                                                   ?>
                                                   <tr>
                                                     <td><?php echo $name[$i]; ?></td><td><? echo $admission[$i]; ?></td>
                                                     <td><a href="Admin.php?task=view_student&app=student_profile&id=<? echo $admission[$i]; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                                                   </tr>
                                                  <?
                                      
                                                  }
                             
                                             }
                                         }
                                         ?>
                                 </table>
                              </div>
                           </div>
                        </body>
                    </html>
                <? 
            }
        }
        
        
        public function student_profile(){
            if(isset($_REQUEST['id'])){
                $id = $_REQUEST['id'];
                require_once('public_class/public_view_student.php');
                $obj = new public_view_student($_REQUEST['id']);
                $obj-> student_profile();
                
                ?><body onload="student()">
                    <?include('html/Student.html');?>
                    <div>
                        <table class="table table-hover" style="width: 400px;">
                           <tr>
                              <th><span role="button" class="btn btn-link btn-m" data-toggle="modal" data-target="#password"><span class="glyphicon glyphicon-lock"></span> Reset Password</span></th>
                              <th><span role="button" class="btn btn-link btn-m" data-toggle="modal" data-target="#grade"><span class="glyphicon glyphicon-eye-open"></span> Report Card</span></th>
                              <th><span role="button" class="btn btn-link btn-m" data-toggle="modal" data-target="#attendance"><span class="glyphicon glyphicon-calendar"></span> Attendance</span></th>
                              <th><span role="button" class="btn btn-link btn-m" data-toggle="modal"><a href="Admin.php?task=view_student&app=edit_student&id=<? echo $_REQUEST['id']; ?>"><span class="glyphicon glyphicon-edit"></span>Edit</a></span></th>
                           </tr>
                        </table>
                    </div>
                    
                    <div class="container">
                       <div class="modal fade" id="grade" role="dialog">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       
                                   </div>
                                   <div class="modal-body">
                                       <div class="panel panel-primary">
                                          <div class="panel-heading"><h4>Select</h4></div>
                                          <div>
                                             <form name="myForm" action="Admin.php?task=view_student&app=view_grade" method="post">
                                                <table class="table table-hover" >
                                                 <tr>
                                                    <th>Session</th>
                                                    <td>
                                                        <select name="session">
                                                            <option value="15-16"> 2015/2016</option>
                                                            <option value="16-17"> 2016/2017</option>
                                                            
                                                        </select>
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <th>Term</th>
                                                    <td>
                                                        <select name="term">
                                                            <option value="Term1"> Term 1</option>
                                                            <option value="Term2"> Term 2</option>
                                                            <option value="Term3"> Term 3</option>
                                                        </select>
                                                    </td>
                                                 </tr>
                                                 <tr><th><input type="hidden" value="<? echo $_REQUEST['id'] ?>" name="id"></th></tr>
                                                 <tr>
                                                  <th></th><td><input type="submit" name="submit" value="search"></td>
                                                 </tr>
                                                    
                                                </table>
                                            </form>
                                          </div>
                                       </div>
                                       
                                       <span id="result"></span>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    
                    
                     <div class="container">
                       <div class="modal fade" id="attendance" role="dialog">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   </div>
                                   <div class="modal-body">
                                       <div class="panel panel-primary">
                                          <div class="panel-heading"><span class="glyphicon glyphicon-calendar">Attendance</span></div>
                                          <div class="panel-body">
                                                <?
                                               
                                                   $term = 'Term1';
                                                   $session = '15-16';
                                                   $array = array(
                                                       "id" => $id,
                                                       "term" => $term,
                                                       "session"=>$session
                                                   );
                                                   $js  = json_encode($array);
                                                   require_once('public_class/view_attendance.php');
                                                   $obj = new view_attendance($js);
                                                   $obj-> attendance();
                                                ?>
                                          </div>
                                       </div>
                                       
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                     <div class="container">
                       <div class="modal fade" id="password" role="dialog">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   </div>
                                   <div class="modal-body">
                                       <div class="panel panel-primary">
                                          <div class="panel-heading"><span class="glyphicon glyphicon-lock">Password</span></div>
                                          <div class="panel-body">
                                             <form method="POST" action="Admin.php?task=view_student&app=reset_password&id=<? echo $id; ?>">
                                                <table class="table table-hover">
                                                   <tr>
                                                      <th>User</th>
                                                      <td><input type="text" name="user"></td>
                                                   </tr>
                                                   <tr>
                                                      <th>Password</th>
                                                      <td><input type="text" name="password"></td>
                                                   </tr>
                                                   <tr>
                                                      <th></th>
                                                      <td><input type="submit" name="reset" value="Reset"></td>
                                                   </tr>
                                                </table>
                                             </form>
                                                
                                          </div>
                                       </div>
                                       
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
                     </body>
                  <?  

            }
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }
            
        public function reset_password(){
            if(isset($_REQUEST['id'])){
               $id = $_REQUEST['id'];
               $login = base64_encode($_POST['user'].$_POST['password']);
               require_once('db_connect.php');
               $sql = "UPDATE Register SET User_login = '$login' WHERE Student_ID='$id' ";
               $result = $conn->query($sql);
               if($result){
                  ?>
                    <a href="Admin.php?task=view_student&app=student_profile&id=<? echo $id; ?>" role="button"><span class="glyphicon glyphicon-circle-arrow-left"></span>Back</a> 
                  <?
               }
            }
        }
        public function edit_student(){
            if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
            $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Student_Info/'.$id.'.txt';
            $file = file_get_contents($path);
            $js = json_decode($file, TRUE);
            
            ?>
                <body onload="student()">
                  <?include('html/Student.html');?>
                   <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-edit"></span></div>
                        <div class="panel-body">
                           <form enctype="multipart/form-data" name="sregistration" method="POST" action="Admin.php?task=view_student&app=edit_student_exe">
                              <table class="table table-hover"  style="width:100%; margin-left:0px;">
                                  <tr><th>Student Firstname</th><td><input type="text" name="fname" value="<? echo $js['fname']; ?>"required></td></tr>
                                  <tr><th>Student Surname</th><td><input type="text" name="sname" value="<? echo $js['sname']; ?>" required></td></tr>
                                  <tr><th>Date Of Birth</th><td><input type="date" name="dob" value="<? echo $js['dob']; ?>"></td></tr>
                                  <tr><th>Address</th><td><textarea name="address"><? echo $js['address']; ?></textarea></td></tr>
                                  <tr><th>State Of Origin</th><td><input type="text" name="state" value="<? echo $js['state']; ?>"></td></tr>
                                  <tr><th>Nationality</th><td><input type="text" name="nation" value="<? echo $js['nation']; ?>"></td></tr>
                                  <tr><th>L.G.A</th><td><input type="text" name="lga" value="<? echo $js['lga']; ?>"></td></tr>
                                  <tr><th>Religion</th><td><input type="text" name="rel" value="<? echo $js['rel']; ?>"></td></tr>
                                  <tr><th>Student ID</th><td><input type="hidden" name="add_no" value="<? echo $js['add_no']; ?>" required></td></tr>
                                  <tr>
                                      <th>Gender</th>
                                      <td>
                                          <select name="gender" required>
                                              <option value="<? echo $js['gender']; ?>" selected><? echo $js['gender']; ?></option>
                                              <option value="male">Male</option>
                                              <option value="female">Female</option>
                                          </select>
                                      </td>
                                  </tr>
                                  <tr>
                                      <th>Class</th>
                                      <td>
                                          <select name="class" required >
                                              <option value="<? echo $js['class']; ?>" selected><? echo $js['class']; ?></option>
                                              <option value="KG 1">KG 1</option>
                                              <option value="KG 2">KG 2</option>
                                              <option value="KG 3">KG 3</option>
                                              <option value="Primary 1"> Primary 1</option>
                                              <option value="Primary 2"> Primary 2</option>
                                              <option value="Primary 3"> Primary 3</option>
                                              <option value="Primary 4"> Primary 4</option>
                                              <option value="Primary 5"> Primary 5</option>
                                              <option value="Primary 6"> Primary 6</option>
                                              <option value="JSS 1"> JSS 1</option>
                                              <option value="JSS 2"> JSS 2</option>
                                              <option value="JSS 3"> JSS 3</option>
                                              <option value="SSS 1"> SSS 1</option>
                                              <option value="SSS 2"> SSS 2</option>
                                              <option value="SSS 3"> SSS 3</option>
                                          </select>
                                      </td>
                                  </tr>
                                  <tr>
                                      <th>Subclass</th>
                                      <td>
                                          <select name="subclass" required>
                                              <option value="<? echo $js['subclass']; ?>" selected><? echo $js['subclass']; ?></option>
                                              <option value="A">A</option>
                                              <option value="B">B</option>
                                              <option value="C">C</option>
                                              <option value="D">D</option>
                                              <option value="E">E</option>
                                              <option value="F">F</option>
                                              <option value="G">G</option>
                                              <option value="H">H</option>
                                          </select>
                                      </td>
                                  </tr>
                                  <tr>
                                      <th>Term</th>
                                          <td>
                                              <select name="term">
                                                  <option value="<? echo $js['term']; ?>" selected><? echo $js['term']; ?></option>
                                                  <option value="t1">1st Term</option>
                                                  <option value="t2">2nd Term</option>
                                                  <option value="t3">3rd Term</option>
                                              </select>
                                          </td>
                                  </tr>
                                  <tr>
                                      <th>Section</th>
                                          <td>
                                              <select name="session" required>
                                                  <option value="<? echo $js['session']; ?>" selected><? echo $js['session']; ?></option>
                                                  <option value="14/15">2014/2015</option>
                                                  <option value="15/16">2015/2016</option>
                                                  <option value="16/17">2016/2017</option>
                                              </select>
                                          </td>
                                  </tr>
                                  <tr>
                                      <th>Student Picture</th><td><input type="file" name="image"><input type="hidden" name="img" value="<? echo $js['image']; ?>"></td>
                                  </tr>
                                  <tr>
                                      <th>Accomodation</th>
                                      <td>
                                          <select name="accom">
                                              <option value="<? echo $js['accom']; ?>" selected><? echo $js['accom']; ?></option>
                                              <option value="Day">DAY</option>
                                              <option value="Boarding">BOARDING</option>
                                          </select>
                                      </td>
                                  </tr>
                                  <tr>
                                      <th>Status</th>
                                      <td>
                                          <select name="status">
                                              <option value="active">Active</option>
                                              <option value="de_active">De-active</option>
                                          </select>
                                      </td>
                                  </tr>
                                      <tr><th>Parent Name</th><td><input type="text" name="pname" value="<? echo $js['pname']; ?>"></td></tr>
                                      <tr><th>Parent Address</th><td><input type="text" name="padd" value="<? echo $js['padd']; ?>"></td></tr>
                                      <tr><th>Phone No.</th><td><input type="text" name="parent_phone" value="<? echo $js['parent_phone']; ?>"></td></tr>
                                      <tr><th>Email</th><td><input type="text" name="pemail" value="<? echo $js['pemial']; ?>"></td></tr>
                                      <tr><th>Emergency Contact</th><td><input type="text" name="emrcontact" value="<? echo $js['emrcontact']; ?>"></td></tr>
                                      <tr>
                                       <td><a href="Admin.php?task=view_student&app=student_profile&id=<? echo $id; ?>" role="button"><span class="glyphicon glyphicon-knight"></span>Back</a></td>
                                      <td><input type="submit" name="submit" value="UPDATE"></td>
                                      </tr>
                                      
                              </table>
                          </form>
                        </div>
                   </div>
                </body>
            <?
            
           }
        }
        
        public function edit_student_exe(){
            if($_POST['submit']){
                $fname =$this->test_input($_POST['fname']);
                $sname =$this->test_input($_POST['sname']);
                $dob =$this->test_input($_POST['dob']);
                $address =$this->test_input($_POST['address']);
                $state =$this->test_input($_POST['state']);
                $nation =$this->test_input($_POST['nation']);
                $lga =$this->test_input($_POST['lga']);
                $rel =$this->test_input($_POST['rel']);
                $add_no =$this->test_input($_POST['add_no']);
                $gender =$this->test_input($_POST['gender']);
                $class =$this->test_input($_POST['class']);
                $subclass =$this->test_input($_POST['subclass']);
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
                $image = '';
                $image_name = $_FILES["image"]["name"];
                $name = $fname.' '.$sname;
                $s_class = $class.$subclass;
                
                if(!$image_name ==''){
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
                            //$uploadOk = 0;
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
                        
                        }else{$this->image= $_POST['img']; }
                        
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
                        
                        require_once('db_connect.php');
                        $sql = "UPDATE Register SET Name = '$name', Class='$class', Gender='$gender', Subclass='$s_class',
                            Session='$session', Room_No ='$accom' WHERE Student_ID = '$add_no' ";
                        $result = $conn->query($sql);
                        if($result){
                            $js = json_encode($register);
                            $folder = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Student_Info/'.$add_no.'.txt';
                            $file = fopen($folder, "w");
                            fwrite($file, $js);
                            fclose($file);
                            echo 'Successfully Update student';
                        }else{'Failed';}
                
            }
            
        }
        
        public function view_grade(){
            if(isset($_POST['submit'])){
               $id = $_POST['id'];
               $term = $_POST['term'];
               $session = $_POST['session'];
               $array = array(
                   "id" => $id,
                   "term" => $term,
                   "session" => $session
               );
               require_once('public_class/view_grade.php');
               $obj = new view_grade($array);
               $obj-> grades();
               ?>
                   <div>
                       <table>
                          <tr>
                           <th><a href="Student.php?task=Student_Index&app=view_student&id=<? echo $id; ?>">Back To Student Profile</a></th>
                          </tr>
                       </table>
                   </div>
               <?
            }
        }
     //End   
     }
?>