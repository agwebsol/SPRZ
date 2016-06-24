<?
require_once('includes/Admin_cmsFunction.php');
class Staff extends Admin_cmsFunction {
    public function index(){
        ?>
            <html>
                <body onload="staff()">
                    <? include('html/Staff.html'); ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-file"></span>Staff Management</div>
                        <div class="panel-body" style="margin-top:10px;">
                            <table class="table table-hover" style="width:300px;">
                                <tr>
                                    <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-plus">Staff</span></a></td>
                                
                                    <td><a href="Admin.php?task=Staff&app=permissions"><span class="glyphicon glyphicon-info-sign">Access</span> </a></td>
                                
                                    <td><a href="Admin.php?task=Staff&app=teacher"> <span class="glyphicon glyphicon-user">View</span></a></td>
                                </tr>
                               
                            </table>
                        </div>
                    </div>
                    
                    <div class="container">
                                <div class="modal fade" id="myModal1" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> New Teaching Staff To Database</h4></div>
                                                    <div class="panel-body">
                                                        <form method="POST" action="Admin.php?task=Staff&app=save_teacher">
                                                            <table class="table table-hover">
                                                                <tr>
                                                                    <th>Firstname</th><td><input type="text" name="fname"></td>
                                                                    <th>Surname</th><td><input type="text" name="sname"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Address</th><td><input type="text" name="address"></td>
                                                                    <th>Date Of Birth</th><td><input type="date" name="dob"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Gender</th><td><select name="gender"><option value="Male">Male</option><option value="Female">Female</option></select></td>
                                                                    <th>Degree</th><td><input type="text" name="degree"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th></th><td><input type="submit" name="submit" value="submit"></td>
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
            </html>
        <?
    }
    
    public function save_teacher(){
        if(isset($_POST['submit'])){
            require_once('db_connect.php');
            $fname = $this->test_input($_POST['fname']);
            $sname = $this->test_input($_POST['sname']);
            $name = $fname.' '.$sname;
            $address = $this->test_input($_POST['address']);
            $dob= $this->test_input($_POST['dob']);
            $gender = $this->test_input($_POST['gender']);
            $degree = $this->test_input($_POST['degree']);
            $user_id = rand(0,1000000);
            $sql ="SELECT * FROM Teacher_Table WHERE Name = '$name' ";
            $result = $conn->query($sql);
            if(mysqli_num_rows($result)<1){
                $sql_insert  = "INSERT INTO Teacher_Table (ID, Name, User_ID) VALUES
                                ('NULL', '$name', '$user_id')";
                if($conn->query($sql_insert)){
                mysqli_close($conn);
                $array = array(
                  "Name" =>$name,
                  "address" =>$address,
                  "dob"=>$dob,
                  "gender" => $gender,
                  "degreee" => $degree
                );
                $json = json_encode($array);
                $folder = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Teachers_Info/'.$user_id.'.txt';
                $file = fopen($folder, "w");
                        fwrite($file, $json);
                        fclose($file);
                ?>
                    <body onload="staff()">
                        <? include('html/Staff.html'); ?>
                        <div class="panel panel-info" style="width:300px; margin-left: 200px; margin-top: 50px;">
                            <div class="panel heading"><span class="glyphicon glyphicon-plus"></span></div>
                            <div class="panel-body">
                                Successfully Added Teacher To The Database.
                            </div>
                        </div>
                    </body>
                <? 
               
               
                }else{echo 'failed to insert';}
                
            }else{
                ?>
                    <body onload="staff()">
                        <? include('html/Staff.html'); ?>
                        <div class="panel panel-info" style="width:300px; margin-left: 200px; margin-top:50px;">
                            <div class="panel heading"><span class="glyphicon glyphicon-remove"></span></div>
                            <div class="panel-body">
                                Teacher Already Exist.
                            </div>
                        </div>
                    </body>
                <?
            }
            
            
        }
    }
    
    function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }
            

    public function teacher(){
        ?>
            <body onload="staff()">
                <? include('html/Staff.html'); ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">Select Teacher</div>
                    <div class="panel-body">
                        <form method="POST">
                            <table class="table table-hover" style="width:30px;">
                                <tr>
                                    <td>
                                        <select name="teacher">
                                            <option value ="">---Select---</option>
                                            <?php
                                                $search = array(
                                                  "class" => "search",
                                                  "method" => "list_teacher",
                                                  "params" => ""
                                                );
                                                $ch = curl_init();
                                                curl_setopt($ch, CURLOPT_URL, "http://localhost/eSchool/Backend/");
                                                curl_setopt($ch, CURLOPT_POST, true);
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($search));
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                $result = curl_exec($ch);
                                                curl_close ($ch);
                                                $json_result = json_decode($result, TRUE);
                                                $array = array($json_result);
                                                if(count($array)>0){
                                                    foreach($array as $key){
                                                        $id = explode('*', $key['ID']);
                                                        $name = explode('*', $key['Name']);
                                                        $user_id = explode('*', $key['User_ID']);
                                                        $k = count($id);
                                                        for($i=0; $i<=$k-1; $i++){
                                                        ?><option value="<? echo $id[$i]; ?>"><? echo $name[$i]; ?></option><?    
                                                        
                                                        }
                                                    }
                                                }
                                                                        
                                           ?>
                                        </select>
                                    </td>

                                    <td><input type="submit" name="submit" value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </body>
        <?
        if(isset($_POST['submit'])){
            $id = $_POST['teacher'];
            require_once('db_connect.php');
            $sql ="SELECT * FROM Teacher_Table WHERE ID= '$id'";
            $result = $conn ->query($sql);
            if($result){
                $row = mysqli_fetch_assoc($result);
                ?>
                    <body onload="staff()">
                        <? include('html/Staff.html'); ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading"><? echo $row['Name']; ?></div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <tr>
                                        <th>User ID</th><td><? echo $row['User_ID']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Subject Admin</th><td><? echo $row['Subject_Admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Class Admin</th><td><? echo $row['Class_Admin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><a href="Admin.php?task=Staff&app=reset_login&id=<? echo $row['ID']; ?>"><span class="glyphicon glyphicon-password">Reset-Login</span></a></td>
                                        <td><a href="Admin.php?task=Staff&app=delete_teacher&id=<? echo $row['ID']; ?>"><span class="glyphicon glyphicon-remove">Delete</span></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </body>
                
                <?
            }
            
        }
    }
    
    public function delete_teacher(){
        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
            require_once('db_connect.php');
            $sql ="DELETE FROM Teacher_Table WHERE ID = '$id'";
            $result = $conn->query($sql);
            if($result){
                ?>
                    <body onload="staff()">
                        <? include('html/Staff.html'); ?>
                        <div class="panel panel-info" style="width:300px; margin-left: 200px; margin-top: 50px;">
                            <div class="panel heading"><span class="glyphicon glyphicon-remove"></span></div>
                            <div class="panel-body">
                                Successfully Deleted Teacher.
                            </div>
                        </div>
                    </body>
                <?
            }
        }
    }
    public function reset_login(){
        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
            require_once('db_connect.php');
            $sql ="SELECT * FROM Teacher_Table WHERE ID= '$id'";
            $result = $conn ->query($sql);
            if($result){
                $row = mysqli_fetch_assoc($result);
                ?>
                    <body onload="staff()">
                        <? include('html/Staff.html'); ?>
                        <div class="panel panel-warning" style="width:450px;">
                            <div class="panel-heading">Reset Password <? echo $row['Name']; ?></div>
                            <div class="panel-body">
                                <form method="POST" action="Admin.php?task=Staff&app=reset_login_exe">
                                    <table class="table table-hover" style="width:400px;">
                                    <tr>
                                        <th>Username</th><td><input type="text" name="username" required></td>
                                    </tr>
                                    <tr>
                                        <th>Password</th><td><input type="password" name="password" required ></td>
                                    </tr>
                                    <tr>
                                        <th><input type="hidden" name="id" value="<? echo $row['ID']; ?>"></th><td><input type="submit" name="submit" value="Reset"></td>
                                    </tr>
                                    </table>
                                </form>
                            </div>
                        </div>   
                    </body>
                <?
            }
        }
    }
    
    public function reset_login_exe(){
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $username =$_POST['username'];
            $password = $_POST['password'];
            $user_login  =$username.$password;
            $hash = base64_encode($user_login);
            require_once('db_connect.php');
            $sql = "UPDATE Teacher_Table SET User_Login ='$hash' WHERE ID = '$id'";
            $result = $conn->query($sql);
            if($result){
               ?>
                    <body onload="staff()">
                        <? include('html/Staff.html'); ?>
                        <div class="panel panel-info" style="width:300px; margin-left: 200px; margin-top: 50px;">
                            <div class="panel heading"><span class="glyphicon glyphicon-password"></span></div>
                            <div class="panel-body">
                                Reset Successfull.
                            </div>
                        </div>
                    </body>
                <?
            }
        }
    }
    public function permissions (){
        ?>
            <body onload="staff()">
                <? include('html/Staff.html'); ?>
                <div class="panel panel-primary">
                    <div class="panel-heading"><span class="glyphicon glyphicon-info-sign">Access</span></div>
                    <div class= "panel-body">
                        <form method="POST">
                            <table class="table table-hover">
                                <tr>
                                    <th>Select Teacher</th>
                                    <td>
                                        <select name="teacher">
                                            <option value="">---Select----</option>
                                            <?php
                                                $search = array(
                                                  "class" => "search",
                                                  "method" => "list_teacher",
                                                  "params" => ""
                                                );
                                                $ch = curl_init();
                                                curl_setopt($ch, CURLOPT_URL, "http://localhost/SMS/Backend/");
                                                curl_setopt($ch, CURLOPT_POST, true);
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($search));
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                $result = curl_exec($ch);
                                                curl_close ($ch);
                                                $json_result = json_decode($result, TRUE);
                                                $array = array($json_result);
                                                if(count($array)>0){
                                                    foreach($array as $key){
                                                        $id = explode('*', $key['ID']);
                                                        $name = explode('*', $key['Name']);
                                                        $user_id = explode('*', $key['User_ID']);
                                                        $k = count($id);
                                                        for($i=0; $i<=$k-1; $i++){
                                                        ?><option value="<? echo $id[$i]; ?>"><? echo $name[$i]; ?></option><?    
                                                        
                                                        }
                                                    }
                                                }
                                                                        
                                           ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th><td><input type="submit" name="submit" value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </body>
        <?
        if(isset($_POST['submit'])){
            $teacher = $_POST['teacher'];
            require_once('db_connect.php');
            $sql = "SELECT * FROM Teacher_Table WHERE ID = '$teacher'";
            $result= $conn->query($sql);
            if($result){
                $subject = array(
                                "Mathematics" => '',
                                "English" => "",
                                "Science" => "",
                                "Intro Technology" => "",
                                "Social Studies" => "",
                                "Agriculture" =>"",
                                "Religious Studies" => "",
                                "Agriculture" =>"",
                                "Physical Education" =>"",
                                "Relgious Studies" => "",
                                "Fine Art"=> "",
                                "Computer Science" => "",
                                "Literature" =>"",
                                "Economics" => "",
                                "Music" => "",
                                "Art" =>"",
                                "Futher Mathematics" => "",
                                "Geography" =>""
                            );
                $row= mysqli_fetch_assoc($result);
                ?>
                    <body onload="staff()">
                        <? include('html/Staff.html'); ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading"><? echo $row['Name']; ?></div>
                            <div class="panel-body">
                                <form method="POST" action="Admin.php?task=Staff&app=update_permission">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Subject Administrator</th>
                                            <td>
                                                <select name="subject_admin">
                                                    <option value="">---Select---</option>
                                                    <?
                                                        foreach($subject as $key => $value){
                                                            ?><option value="<? echo $key; ?>"><? echo $key; ?></option><?
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="class_sub" >
                                                    <option value="">---Select---</option>
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
                                            <th>Class Administrator</th>
                                            <td>
                                                <select name="class">
                                                    <option value="">---Select---</option>
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
                                            <td>
                                                <select name="subclass">
                                                <option value="">---Select---</option>
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
                                            <th>Permission</th>
                                            <td>
                                                <select name="permission" required>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><input type="hidden" value="<? echo $row['ID']; ?>" name="id"></th><td><input type="submit" name="submit" value="Submit"></td>
                                        </tr>
                                            
                                    </table>
                                </form>
                            </div>
                        </div>
                    </body>
                
                <?
            }
            
        }
    }
    
    public function update_permission(){
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $subject_admin = $_POST['subject_admin'].'-'.$_POST['class_sub'];
            $class_teacher = $_POST['class'].$_POST['subclass'];
            $permission = $_POST['permission'];
            require_once('db_connect.php');
            $sql = "UPDATE Teacher_Table SET Subject_Admin ='$subject_admin', Class_Admin = '$class_teacher', Permission ='$permission' WHERE ID = '$id'";
            $result = $conn->query($sql);
            if($result){
                ?>
                    <body onload="staff()">
                        <? include('html/Staff.html'); ?>
                        <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                            <div class="panel heading"><span class="glyphicon glyphicon-ok"></span></div>
                            <div class="panel-body">
                                Teacher Profile Updated.
                            </div>
                        </div>
                    </body>
                <?
            }

        }
    }
//End
}
?>