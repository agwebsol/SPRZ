<?
require_once('includes/Teacher_cmsFunction.php');
class Teacher_index extends Teacher_cmsFunction {
    
    public function index_Teacher(){
        
        ?>
            <body onload="home()">
                <div class="panel panel-primary">
                    <div class="panel-heading"><span class="glyphicon glyphicon-dashboard">Dashboard</span></div>
                    <div class="panel-body">
                        <form method ="POST" action="Admin.php?task=Academics&app=edit_calender">
                            <table class="table table-hover" style="width:80px; float:left;">
                                <tr>
                                    <td><span class="glyphicon glyphicon-calendar"></span></td>
                                    <td>
                                        <select name= "month" onchange="calender(this.value)">
                                            <option value="">Calender</option>
                                            <option value="1">Jan</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Mar</option>
                                            <option value="4">Apr</option>
                                            <option value="5">May</option>
                                            <option value="6">Jun</option>
                                            <option value="7">Jul</option>
                                            <option value="8">Aug</option>
                                            <option value="9">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                            
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    
                    </div>
                    <div id="calender">
                            <?
                                require_once('message_board.php');
                                $txt = new message_board("Teacher");
                                ?>
                                    <div style=" margin-left: 100px;">
                                        <?$txt->show_board();?>
                                    </div>
                                <?
                            ?>
                    </div>
                </div>
                <script>
                    function home() {
                        document.getElementById("home").style.backgroundColor="#E6E6E6";
                    }
                    function calender(month){
                        if (window.XMLHttpRequest) {
                            xmlhttp = new XMLHttpRequest();
                        } else {
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function() {
                            if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                document.getElementById("calender").innerHTML = xmlhttp.responseText;
                            }
                        };
                        xmlhttp.open("GET","calender.php?view=yes&month="+month, true);
                        xmlhttp.send();
                    }
                </script>
            </body>
        <?
    }
    
    public function view_by_class(){
            if(isset($_POST['submit'])){
                $class = $_POST['class'].$_POST['subclass'];
                $search = array(
                  "class" => "search",
                  "method" =>"list_student_subclass",
                  "params" => $class
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://localhost/eSchool/Backend/");
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
                        <body>
                           <div class="panel panel-primary">
                            <div class="panel-heading"><span class="glyphicon glyphicon-th"> <? echo $class; ?></span></div>
                            <div>
                                <table class="table table-hover" style="width: 600px;">
                                    <tr><th>Name</th><th>Actions<th/><th> </th></tr>
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
                                                        <td><?php echo $name[$i].' '.$admission[$i]; ?></td>
                                                        <td><a href="Teacher.php?task=Teacher_index&app=view_student&id=<? echo $admission[$i] ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                                                        <td></td>
                                                      </tr>
                                                      <?php
                                                        
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
        
        public function view_student(){
            if(isset($_REQUEST['id'])){
                $id=$_REQUEST['id'];
                require_once('public_class/public_view_student.php');
                $obj = new public_view_student($_REQUEST['id']);
                $obj-> student_profile();
                
                ?>
                    <body>
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <table>
                                   <tr>
                                    <th><button role="button" class="btn btn-link btn-m" data-toggle="modal" data-target="#grade">View Grade</button></th>
                                   </tr>
                                   <tr>
                                    <th><button role="button" class="btn btn-link btn-m" data-toggle="modal" data-target="#attend">View Attendace</button></th>
                                   </tr>
                                </table>
                            </div>
                        </div>
                    </body>
                    
                    <div class="container">
                       <div class="modal fade" id="grade" role="dialog">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h4 class="modal-title">View Grade</h4>
                                   </div>
                                   <div class="modal-body">
                                       <div class="panel panel-primary">
                                        <div class="panel-heading"><span class="glyphicon glyphicon-eye-open"> Report Card</span></div>
                                        <div class="panel-body">
                                            <form name="myForm" action="Teacher.php?task=Teacher_index&app=view_grade" method="post">
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
                       <div class="modal fade" id="attend" role="dialog">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h4 class="modal-title">Attendance</h4>
                                   </div>
                                   <div class="modal-body">
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
                                       
                                       <span id="result"></span>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                    </div>
     <?  

            }
        }
        
        public function view_grade(){
            if(isset($_POST['id'])){
                $term = $_POST['term'];
                $session = $_POST['session'];
                $id = $_POST['id'];
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
                            <th><a href="Teacher.php?task=Teacher_Index&app=view_student&id=<? echo $id; ?>">Back To Student Profile</a></th>
                           </tr>
                        </table>
                    </div>
                <?
                
            }
            
        }
        
        public function manage_grade(){
            //Session For Teacher_Table
            if(!isset($_POST['submit'])){
                 $sub= $_SESSION['Subject_Admin'];
                 $arry =explode("-", $sub);
                 $class = $arry[1];
                 ?>
                    <body onload="report()">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><span class="glyphicon glyphicon-wrench"></span> Manage Report For <? echo $_SESSION['Subject_Admin']; ?></div>
                            <div class="panel-body">
                                <form method="POST" action="Teacher.php?task=Teacher_index&app=grade">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Select Student To Manage Grade</th>
                                            <td>
                                                    <select name="student_id">
                                                        <option value="">---Select---</option>
                                                        <?php
                                                            $search = array(
                                                              "class" => "search",
                                                              "method" => "list_student_class",
                                                              "params" => $class
                                                            );
                                                            
                                                            $ch = curl_init();
                                                            curl_setopt($ch, CURLOPT_URL, "http://localhost/SMS/Backend/");
                                                            curl_setopt($ch, CURLOPT_POST, true);
                                                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($search));
                                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                            $result = curl_exec($ch);
                                                            curl_close ($ch);
                                                            $json = json_decode($result, TRUE);
                                                            $json = array($json);
                                                            var_dump($json);
                                                            if(count($json)>0){
                                                                foreach($json as $key){
                                                                    $id = explode('*', $key['Student_ID']);
                                                                    $fname = explode('*', $key['Name']);
                                                                    $k = count($id);
                                                                    for($i=0; $i<=$k-1; $i++){
                                                                        $this->name = $fname[$i];
                                                                    ?><option value="<? echo $id[$i].'-'.$fname[$i]; ?>"><? echo $fname[$i]; ?></option><?    
                                                                    
                                                                    }
                                                                }
                                                            }
                                                                                        
                                                        ?>
                                                    </select>
                                            </td>
                                            <td>
                                                <select name="term">
                                                    <option value="Term1">Term 1</option>
                                                    <option value="Term2">Term 2</option>
                                                    <option value="Term3">Term 3</option>
                                                    
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><input type="hidden" name="name" value="<? echo $this->name; ?>"></th><td><input type="submit" name="submit" value="submit" ></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <script>
                            function report() {
                                document.getElementById("report").style.backgroundColor="#E6E6E6";
                            }
                        </script>
                    </body>
                 <?
            }
        }
        
        public function grade(){
            if(isset($_POST['submit'])){
                //Information Provided from Teacher_Table Session Information
                $name_id = $_POST['student_id'];
                $name_id = explode("-", $name_id);
                $id = $name_id[0];
                $name = $name_id[1];
                $sub= $_SESSION['Subject_Admin'];
                $arry =explode("-", $sub);
                $class = $arry[1];
                $subject = $arry[0];
                $term =$_POST['term'];
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Grades/'.$id.'.txt';
                if(file_exists($path)){
                    $file = file_get_contents($path);
                    $js = json_decode($file, TRUE);
                    $t_report = $js[$term];
                    $term_report = json_decode($t_report, TRUE);
                    $grades = $term_report[$subject];
                    $grade = json_decode($grades, TRUE);
                        ?>
                            <body onload="report1()">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"><? echo $name.' '.$subject.' '.$class; ?> <? echo $term; ?></div>
                                    <div class="panel-body">
                                        <form method="POST" action="Teacher.php?task=Teacher_Index&app=add_grade">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th>Test 1</th><td><input type="text" name="test1" value="<? echo $grade['Test1']; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <th>Test 2</th><td><input type="text" name="test2" value="<? echo $grade['Test2']; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <th>Test 3</th><td><input type="text" name="test3" value="<? echo $grade['Test3']; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <th>Exam</th><td><input type="text" name="exam" value="<? echo $grade['Exam']; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <input type="hidden" name="name" value="<? echo $name; ?>">
                                                        <input type="hidden" name="term" value="<? echo $term; ?>">
                                                        <input type="hidden" name="subject" value="<? echo $subject; ?>">
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th><input type="hidden" name="path" value="<? echo $path; ?>"></th><td><input type="submit" name="submit" value="submit"></td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                                <script>
                                    function report1(){
                                        document.getElementById("report").style.backgroundColor="#E6E6E6";
                                    }
                                </script>
                            </body>
                        <?
                    
                }else{ echo 'No';}
            }
        }
        
        public function add_grade(){
            if(isset($_POST['submit'])){
                $test1 = $_POST['test1'];
                $test2 = $_POST['test2'];
                $test3 = $_POST['test3'];
                $exam = $_POST['exam'];
                $grade_entry = array(
                'Test1' => $test1,
                'Test2' => $test2,
                'Test3' => $test3,
                'Exam' => $exam
                 );
                $path = $_POST['path'];
                $term = $_POST['term'];
                $subject = $_POST['subject'];
                if(file_exists($path)){
                    $file = file_get_contents($path);
                    $json = json_decode($file, TRUE);
                    $t_report = $json[$term];
                    $term_report = json_decode($t_report, TRUE);
                    foreach($term_report as $key => $value){
                        if($key == $subject){
                            $grade = json_encode($grade_entry);
                            $term_report[$key] = $grade; 
                            $js_term = json_encode($term_report);
                            $json[$term] =$js_term;
                            $js = json_encode($json);
                            $fill = fopen($path, "w");
                                    fwrite($fill, $js);
                                    fclose($fill);
                        }
                    }
                    $n_grade = file_get_contents($path);
                    $new_grade = json_decode($n_grade,TRUE);
                    $new_grade_term = $new_grade[$term];
                    $n_term = json_decode($new_grade_term, TRUE);
                    ?>
                        <body onload="report2()">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><span class="glyphicon glyphicon-th"></span>Report Card <? echo $_POST['name'].' '.$term; ?></div>
                                <div>
                                    <table class = "table table-hover">
                                        <tr>
                                            <th>Subject</th><th>Test 1</th><th>Test 2</th><th>Test 3</th><th>Exam</th>
                                        </tr>
                                        <?
                                            foreach($n_term as $key=> $value){
                                                $v = json_decode($value, TRUE);
                                                ?>
                                                    <tr>
                                                        <td><? echo $key; ?></td>
                                                        <td><? echo $v['Test1'];?></td>
                                                        <td><? echo $v['Test2'];?></td>
                                                        <td><? echo $v['Test3'];?></td>
                                                        <td><? echo $v['Exam'];?></td>
                                                    </tr>
                                                <?
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                            <script>
                                function report2(){
                                    document.getElementById("report").style.backgroundColor="#E6E6E6";
                                }
                            </script>
                        </body>
                    <?                    
                }
                
                
                
            }
            
        }
        
        
        
        
       
        
        public function manage_attendance(){
            if(!isset($_POST['submit'])){
                $class= $_SESSION['Class_Admin'];
                 ?>
                    <body onload="attendance()">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><span class="glyphicon glyphicon-calendar"></span></div>
                            <div class="panel-body">
                                <form method="POST" action="Teacher.php?task=Teacher_index&app=manage_attendance">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Select Student To Manage Attendance</th>
                                            <td>
                                                    <select name="student">
                                                        <option value="">---Select---</option>
                                                        <?php
                                                            $search = array(
                                                              "class" => "search",
                                                              "method" => "list_student_subclass",
                                                              "params" => $class
                                                            );
                                                            $ch = curl_init();
                                                            curl_setopt($ch, CURLOPT_URL, "http://localhost/eSchool/Backend/");
                                                            curl_setopt($ch, CURLOPT_POST, true);
                                                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($search));
                                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                            $result = curl_exec($ch);
                                                            curl_close ($ch);
                                                            $json = json_decode($result, TRUE);
                                                            $json = array($json);
                                                            var_dump($json);
                                                            if(count($json)>0){
                                                                foreach($json as $key){
                                                                    $id = explode('*', $key['Student_ID']);
                                                                    $fname = explode('*', $key['Name']);
                                                                    $k = count($id);
                                                                    for($i=0; $i<=$k-1; $i++){
                                                                    ?><option value="<? echo $id[$i]; ?>"><? echo $fname[$i]; ?></option><?    
                                                                    
                                                                    }
                                                                }
                                                            }
                                                                                        
                                                        ?>
                                                    </select>
                                            </td>
                                            <td>
                                                <select name="term">
                                                    <option value="Term1">Term 1</option>
                                                    <option value="Term2">Term 2</option>
                                                    <option value="Term3">Term 3</option>
                                                    
                                                </select>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <th></th><td><input type="submit" name="submit" value="submit" ></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <script>
                            function attendance() {
                                document.getElementById("attendance").style.backgroundColor="#E6E6E6";
                            }
                        </script>
                    </body>
                 <?
            }
            
            
            if(isset($_POST['submit'])){
                // Session Information
                $id = $_POST['student'];
                $term = $_POST['term'];
                $info = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Student_info/'.$id.'.txt';
                $txt = json_decode(file_get_contents($info),TRUE);
                $fname = $txt['fname'];
                $sname = $txt['sname'];
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Attendance/'.$term.'/'.$id.'.txt';
                if(file_exists($path)){
                    $file = file_get_contents($path);
                    $attd = json_decode($file);
                    ?>
                        <body onload="attendance1()">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><span class="glyphicon glyphicon-calendar"></span><? echo $fname.' '.$sname; ?></div>
                                <div class="panel-body">
                                    <span>
                                        <span role="button" class="btn btn-link btn-m" data-toggle="modal" data-target="#attd"><span class="glyphicon glyphicon-plus"></span></span>
                                    </span>
                                    <form>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Date</th><th>Status</th>
                                            </tr>
                                            <tr>
                                               <?
                                                foreach($attd as $value){
                                                    $v = json_decode($value, TRUE);
                                                    ?>
                                                    <tr>
                                                        <td><?echo $v['date']; ?></td><td><?echo $v['status'];?></td>
                                                        <td>
                                                            <a href="Teacher.php?task=Teacher_index&app=edit_attendance&id=<? echo $id; ?>&term=<? echo $term; ?>&date=<? echo $v['date']; ?>&path=<? echo $path; ?>&"><span class="glyphicon glyphicon-edit">Edit</span></a>
                                                        </td>
                                                    </tr>
                                                    <?
                                                }
                                               ?>
                                            </tr>
                                        </table>
                                    </form>
                                    <div class="container">
                                        <div class="modal fade" id="attd" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Take Attendance for Student</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="panel panel-primary">
                                                            <div class="panel-heading"><span class="glyphicon glyphicon-plus"></span></div>
                                                            <div class="panel-body">
                                                                <form name="myForm" action="Teacher.php?task=Teacher_index&app=manage_attendance" method="post">
                                                                    <table class="table table-hover" >
                                                                        <tr>
                                                                            <th>Term</th><td><input type="hidden" name="term" value="<? echo $term; ?>"><input type="button" value="<? echo $term; ?>"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>DATE</th><td><input type="date" name="date"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>STATUS</th>
                                                                            <td>
                                                                                <select name ="status">
                                                                                    <option value="Present">Present</option>
                                                                                    <option value="Absent">Absent</option>
                                                                                    <option value="Holiday">Holiday</option>
                                                                                    <option value="Excused">Excused</option>
                                                                                    
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th><input type="hidden" name="id" value="<? echo $id; ?>"></th><td><input type="submit" name="push" value="submit"></td>
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
                                </div>
                            </div>
                            <script>
                            function attendance1() {
                                document.getElementById("attendance").style.backgroundColor="#E6E6E6";
                            }
                        </script>
                        </body>
                    <?
                }else{
                    ?>
                        <body onload="attendance2()">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><span class="glyphicon glyphicon-plus"></span></div>
                                <div class="panel-body">
                                    <form Method="POST" action="Teacher.php?task=Teacher_index&app=manage_attendance">
                                        <table class="table table-hover">
                                            
                                                
                                            <tr>
                                                <th>Term</th><td><input type="hidden" name="term" value="<? echo $term; ?>"><input type="button" value="<? echo $term; ?>"></td>
                                            </tr>
                                                
                                            
                                            <tr>
                                                <th>DATE</th><td><input type="date" name="date"></td>
                                            </tr>
                                            <tr>
                                                <th>STATUS</th>
                                                <td>
                                                    <select name ="status">
                                                        <option value="Present">Present</option>
                                                        <option value="Absent">Absent</option>
                                                        <option value="Holiday">Holiday</option>
                                                        <option value="Excused">Excused</option>
                                                        
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><input type="hidden" name="id" value="<? echo $id; ?>"></th><td><input type="submit" name="add" value="submit"></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <script>
                                function attendance2() {
                                    document.getElementById("attendance").style.backgroundColor="#E6E6E6";
                                }
                            </script>
                        </body>
                    <?
                    
                }
            }
            
            if(isset($_POST['add'])){
                $id = $_POST['id'];
                $date = $_POST['date'];
                $status = $_POST['status'];
                $term = $_POST['term'];
                
                
                $array = array(
                          "date" => $date,
                          "status" => $status
                        );
                $dt = date_create($date);
                $day = date_format($dt, "D");
                if($day == 'Sat' || $day=='Sun'){
                    echo 'We Party Weekend';
                    }else{
                        $attd = json_encode($array);
                        $attendance = array();
                        $attendance[]=$attd;
                        $json = json_encode($attendance);
                        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Attendance/'.$term.'/'.$id.'.txt';
                        $file = fopen($path, "w");
                        fwrite($file, $json);
                        fclose($file);
                    }
            }
            
            if(isset($_POST['push'])){
                $id = $_POST['id'];
                $date = $_POST['date'];
                $status = $_POST['status'];
                $term = $_POST['term'];
                
                $array = array(
                          "date" => $date,
                          "status" => $status
                        );
                $attd = json_encode($array);
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Attendance/'.$term.'/'.$id.'.txt';
                if(file_exists($path)){
                    $file = file_get_contents($path);
                    $js = json_decode($file);
                    $check = 'No';
                    foreach($js as $value){
                        $v = json_decode($value, TRUE);
                        if($v['date']==$date){
                          $check= 'Yes';
                          echo 'This entry Exist Find and Edit';
                        }
                    }
                    if($check =='No'){
                        $dt = date_create($date);
                        $day = date_format($dt, "D");
                        if($day == 'Sat' || $day=='Sun'){
                           echo 'We Party Weekend'; 
                        }else{
                            array_push($js, $attd);
                            $json = json_encode($js);
                            $file = fopen($path, "w");
                            fwrite($file, $json);
                            fclose($file);
                        }
                    }
                }
            }
            
        }
        
        public function edit_attendance(){
            $file =file_get_contents($_REQUEST['path']);
            $js = json_decode($file);
            $index = '';
            $count = count($js);
            $date = $_REQUEST['date'];
            $date2= '';
            $k=0;
            $id = $_REQUEST['id'];
            $path = $_REQUEST['path'];
            $term = $_REQUEST['term'];
            
            $path2= '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Student_Info/'.$id.'.txt';
            $info = file_get_contents($path2);
            $student = json_decode($info,TRUE);
            
            for($i=0; $i<=$count-1; $i++){
                $v=json_decode($js[$i], TRUE);
                if($v['date'] == $date){
                    $this->date2 = $v['date'];
                    $this->index= $i;
                }
                
            }
            ?>
                <body onload="attendance3()">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h2 style="color:BLACK;"><? echo $student['fname'].' '.$student['sname'].' '.$term; ?></h2></div>
                        <div class="panel-body">
                            <form Method="POST" action="Teacher.php?task=Teacher_index&app=update_attendance">
                                <table class="table table-hover">
                                    
                                    <tr>
                                        <th>Term</th><td><input type="hidden" name="term" value="<? echo $term; ?>"><input type="button" value="<? echo $term; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>DATE </th><td><input type="hidden" name="pdate" value="<? echo $this->date2; ?>"><input type="date" name="date"> Replace <? echo $this->date2; ?></td>
                                    </tr>
                                    <tr>
                                        <th>STATUS</th>
                                        <td>
                                            <select name="status">
                                                <option>--Select--</option>
                                                <option value="Present">Present</option>
                                                <option value="Absent">Absent</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><input type="hidden" name="index" value="<? echo $this->index; ?>"><input type="hidden" name="id" value="<? echo $id; ?>"></th><td><input type="submit" name="edit" value="submit"></td>
                                    </tr>
                                    
                                </table>
                            </form>
                            <form method="POST" action ="Teacher.php?task=Teacher_index&app=delete_attendance">
                                <table>
                                    <tr>
                                        <th>
                                            <input type="hidden" name="path" value ="<? echo $path; ?>">
                                            <input type ="hidden" name= "date"value ="<? echo $date; ?>">
                                            <input type="hidden" name="index" value="<? echo $this->index; ?>">
                                            <input type="submit" name ="delete" value = "DELETE">
                                        </th>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <script>
                        function attendance3() {
                            document.getElementById("attendance").style.backgroundColor="#E6E6E6";
                        }
                    </script>
                </body>
            <?
        }
        
        
        public function delete_attendance(){
            if(isset($_POST['delete'])){
                $path = $_POST['path'];
                $date = $_POST['date'];
                $index = $_POST['index'];
                $file = file_get_contents($path);
                $js = json_decode($file);
                $k = 0;
                foreach($js as $value){
                    $k=$k+1;
                    $v = json_decode($value, TRUE);
                    if($v['date'] == $date){
                        array_splice($js, $k-1, 1);
                        $json = json_encode($js);
                        $fill = fopen($path, "w");
                        fwrite($fill, $json);
                        fclose($fill); 
                    }
                }
            }
            
        }
        
        public function update_attendance(){
           if(!$_POST['date']==""){
                $id = $_POST['id'];
                echo $date = $_POST['date'];
                echo $status = $_POST['status'];
                
                $term = $_POST['term'];
                $index =$_POST['index'];
                $exist = False;
                $same =False;
                $pdate =$_POST['pdate'];
                
                
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Attendance/'.$term.'/'.$id.'.txt';
                $file =file_get_contents($path);
                $js = json_decode($file);
                $count = count($js);
                $k =0;
                $kt = '';
                $dt = date_create($date);
                $day = date_format($dt, "D");
                if($day == 'Sat' || $day=='Sun'){
                    echo 'We Party Weekend';
                }else{
                    $k = 0;
                    foreach($js as $value){
                        $k++;
                        $v=json_decode($value, TRUE);
                        if($v['date']==$date){
                            $array2 = array(
                                    "date" => $v['date'],
                                    "status" => $status,
                                  );
                            $attd2 = json_encode($array2);
                            $exist =True;
                            array_splice($js, $k-1, 1, $attd2);
                            $json = json_encode($js);
                            $fill = fopen($path, "w");
                                    fwrite($fill, $json);
                                    fclose($fill);
                            
                        }
                    }
                    
                    if($exist ==False){
                        $array = array(
                                "date" => $date,
                                "status" => $status,
                              );
                        $attd = json_encode($array);
                        array_splice($js, $index, 1, $attd);
                        $json1 = json_encode($js);
                        $fill1 = fopen($path, "w");
                                fwrite($fill1, $json1);
                                fclose($fill1); 
        
                        
                    }
                
                }
                
            } 
        }
        
        
        
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }
        
//ENd        
}
?>