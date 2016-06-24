<?
require_once('includes/Student_cmsFunction.php');
    class Student_index extends Student_cmsFunction{
        public function index_Student(){
            ?>
            <body onload="home()">
                <div class="panel panel-info" style="width: 150%;">
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
                                $txt = new message_board("Student");
                                ?>
                                    <div style=" margin-left: 80px;">
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
        
        public function view_report(){
            //if(isset($_SESSION['id'])){
                $id = $_SESSION['student_id'];
                $term = "Term1";
                $session = '15-16';
                $array = array(
                    "id" => $id,
                    "term" => $term,
                    "session" => $session
                );
                require_once('public_class/view_grade.php');
                ?>
                    <body onload="report()">
                        <div>
                            <div></div>
                            <div>
                                <?
                                    $obj = new view_grade($array);
                                    $obj-> grades();
                                ?>
                            </div>
                        </div>
                        <script>
                            function report() {
                                    document.getElementById("report").style.backgroundColor="#E6E6E6";
                                }
                        </script>
                    </body>
                <?
                
            //}
        }
        
        public function account(){
            $id=$_SESSION['student_id'];
            ?>
                <body onload="account()">
                    <div></div>
                    <div>
                        <?
                            $id=$_SESSION['student_id'];
                            require_once('public_class/public_view_student.php');
                            $obj = new public_view_student($id);
                            $obj-> student_profile();
                            
                        ?>
                    </div>
                    <script>
                        function account() {
                                document.getElementById("account").style.backgroundColor="#E6E6E6";
                            }
                    </script>
                </body>
            <?
        }
        
        public function notes(){
            ?>
            <body onload="notes()">
                <div class="panel panel-info">
                    <div class="panel-heading"><span class="glyphicon glyphicon-book"> Notes/Assignments</span></div>
                    <div class="panel-body">
                        <table>
                            <tr>
                                <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-eye-open">Assignment</span></a></td>
                            </tr>
                        </table>
                                            
                    </div>
                    <div class="container">
                        <div class="modal fade" id="myModal1" role="dialog">
                            <div class="modal-dialog" >
                                <div class="modal-content" style="width: 120%;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel panel-primary" style="width: 670px;">
                                            <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span></h4></div>
                                            <div class="panel-body">
                                                <form method="POST" action="Student.php?task=Student_index&app=view_notes">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <?
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
                                                                    ?>
                                                                        <select name="subject">
                                                                            <option value="">---Select---</option>
                                                                            <?
                                                                                foreach($subject as $key => $value){
                                                                                    ?><option value="<? echo $key; ?>"><? echo $key; ?></option><?
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    <?
                                                                    
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <input type="submit" value="submit" name="submit">
                                                            </td>
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
                </div>
                <script>
                    function notes() {
                        document.getElementById("notes").style.backgroundColor="#E6E6E6";
                    }
                </script>
                
            </body>
            <?
        }
        
        public function view_notes(){
            if(isset($_REQUEST['submit'])){
                $subject_class= $_POST['subject'].'-'.$_SESSION['Class'];
                ?>
                    <body>
                        <div class="panel panel-info">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <?
                                        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/'.$subject_class.'.txt';
                                        $index=0;
                                        if(file_exists($path)){
                                            $notes= json_decode(file_get_contents($path));
                                            foreach($notes as $value){
                                                $index++;
                                                $v= json_decode($value,TRUE);
                                                $view ='<a href="Student.php?task=Student_index&app=show_note&index='.$index.'&subject_class='.$subject_class.'"><span class="glyphicon glyphicon-search"></span></a>'
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <? echo $v['Topic']; ?>
                                                        </td>
                                                        <td>
                                                            <? echo $view; ?>
                                                        </td>
                                                    </tr>
                                                <?
                                            }
                                        }
                                    ?>
                                    
                                </table>
                                
                            </div>
                        </div>
                    </body>
                <?
                
            }
        }
        
        public function show_note(){
            if(isset($_REQUEST['index'])){
                $index = $_REQUEST['index'];
                $subject_class = $_REQUEST['subject_class'];
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/'.$subject_class.'.txt';
                if(file_exists($path)){
                    $notes= json_decode(file_get_contents($path));
                $entry = json_decode($notes[$index-1], TRUE);
                    ?>
                        <body>
                            <div class ="panle panel-info">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <table class="table table-hover" style="width: 600px;">
                                        <tr>
                                            <td><? echo $entry['Topic']?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea rows="20" cols="70" disabled><? echo $entry['Note']; ?></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                    <div>
                                        <?
                                            $exists = 'No';
                                            $id_topic = $_SESSION['student_id'].'-'.$entry['Topic'];
                                            $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/Answers/'.$subject_class.'.txt';
                                            if(file_exists($path)){
                                                $array = json_decode(file_get_contents($path));
                                                $index = 0;
                                                foreach($array as $value){
                                                    $index++;
                                                    $v = json_decode($value, TRUE);
                                                    if($v['Name']==$id_topic){
                                                        $exists = 'Yes';
                                                       ?>
                                                            <body>
                                                                <table class="table table-hover">
                                                                    <tr>
                                                                        <th>Answer/Reply</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <textarea name="answer" rows="20" cols="70" disabled ><? echo $v['Answer']; ?></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <?
                                                                                $grade = json_decode($v['Grade'], TRUE);
                                                                                if(count($grade)>0){
                                                                                    ?>
                                                                                        <table class="table table-hover">
                                                                                            <tr>
                                                                                                <th>Grade</th>
                                                                                                <td><? echo $grade['grade']; ?></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Comment</th>
                                                                                                <td><? echo $grade['comment']; ?></td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    <?
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-edit">Edit</span></a></td>
                                                                    </tr>
                                                                </table>
                                                                <div class="container">
                                                                    <div class="modal fade" id="myModal1" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="panel panel-primary">
                                                                                        <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Answer To <? echo $entry['Topic']; ?> </h4></div>
                                                                                        <div class="panel-body">
                                                                                            <form method="POST" action="Student.php?task=Student_index&app=update_answer">
                                                                                                <table class="table table-hover">
                                                                                                    <tr>
                                                                                                        <th> Edit Answer/Reply</th>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <textarea name="answer" rows="20" cols="70"><? echo $v['Answer']; ?></textarea>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <input type="hidden" name="student_id" value="<? echo $_SESSION['student_id']?>">
                                                                                                        <input type="hidden" name="topic" value="<? echo $entry['Topic']; ?>">
                                                                                                        <input type="hidden" name="index" value="<? echo $index; ?>">
                                                                                                        <input type="hidden" name="subject_class" value="<? echo $subject_class; ?>">
                                                                                                        <td><input type="submit" name="submit" value="Submit"></td>
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
                                                
                                                if($exists=='No'){
                                                    ?>
                                                        
                                                        <a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-plus">Answer</span></a>
                                                        <div class="container">
                                                            <div class="modal fade" id="myModal1" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="panel panel-primary">
                                                                                <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>Answer To <? echo $entry['Topic']; ?> </h4></div>
                                                                                <div class="panel-body">
                                                                                    <form method="POST" action="Student.php?task=Student_index&app=add_answer">
                                                                                        <table class="table table-hover">
                                                                                            <tr>
                                                                                                <th>Answer/Reply</th>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <textarea name="answer" rows="20" cols="70">
                                                                                                        
                                                                                                    </textarea>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <input type="hidden" name="student_id" value="<? echo $_SESSION['student_id']?>">
                                                                                                <input type="hidden" name="topic" value="<? echo $entry['Topic']; ?>">
                                                                                                <input type="hidden" name="subject_class" value="<? echo $subject_class; ?>">
                                                                                                <td><input type="submit" name="submit" value="Submit"></td>
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
                                                    <?
                                                }
                                            }else{
                                                ?>
                                                    
                                                    <a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-plus">Answer</span></a>
                                                    <div class="container">
                                                        <div class="modal fade" id="myModal1" role="dialog">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="panel panel-primary">
                                                                            <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>Answer To <? echo $entry['Topic']; ?></h4></div>
                                                                            <div class="panel-body">
                                                                                <form method="POST" action="Student.php?task=Student_index&app=add_answer">
                                                                                    <table class="table table-hover">
                                                                                        <tr>
                                                                                            <th>Answer/Reply</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <textarea name="answer" rows="20" cols="70">
                                                                                                    
                                                                                                </textarea>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <input type="hidden" name="student_id" value="<? echo $_SESSION['student_id']?>">
                                                                                            <input type="hidden" name="topic" value="<? echo $entry['Topic']; ?>">
                                                                                            <input type="hidden" name="subject_class" value="<? echo $subject_class; ?>">
                                                                                            <td><input type="submit" name="submit" value="Submit"></td>
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
                                                    <?
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </body>
                    <?
                }
            }
        }
        
        public function add_answer(){
            if(isset($_POST['submit'])){
                $answer = $_POST['answer'];
                $student_id  = $_POST['student_id'];
                $topic = $_POST['topic'];
                $subject_class = $_POST['subject_class'];
                $name = $student_id.'-'.$topic;
                $answer_ = array(
                  "Name" =>$name,
                  "Answer" => $answer,
                  "Grade" =>""
                );
                $js_answer = json_encode($answer_);
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/Answers/'.$subject_class.'.txt';
                if(file_exists($path)){
                 $arry  =json_decode(file_get_contents($path));
                 $arry[]=$js_answer;
                 $js_arry= json_encode($arry);
                 $file= fopen($path, "w");
                        fwrite($file, $js_arry);
                        fclose($file);
                        echo '<a href="Student.php?task=Student_index&app=notes">Back To Assignment</a>';
                        
                }else{
                    $array =array();
                    $array[]= $js_answer;
                    $js_array= json_encode($array);
                    $file= fopen($path, "w");
                           fwrite($file, $js_array);
                           fclose($file);
                           echo '<a href="Student.php?task=Student_index&app=notes">Back To Assignment</a>';
                }
            }
        }
        
        public function update_answer(){
            if(isset($_POST['submit'])){
                $answer = $_POST['answer'];
                $student_id  = $_POST['student_id'];
                $topic = $_POST['topic'];
                $subject_class = $_POST['subject_class'];
                $index = $_POST['index'];
                $name = $student_id.'-'.$topic;
                $answer_ = array(
                  "Name" =>$name,
                  "Answer" => $answer,
                  "Grade" =>""
                );
                $js_answer = json_encode($answer_);
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/Answers/'.$subject_class.'.txt';
                if(file_exists($path)){
                    $array = json_decode(file_get_contents($path));
                    array_splice($array, $index-1, 1, $js_answer);
                    $js_array= json_encode($array);
                    $file= fopen($path, "w");
                           fwrite($file, $js_array);
                           fclose($file);
                           $n =$index-1;
                           echo '<a href="Student.php?task=Student_index&app=notes">Back To Assignment</a>';
                }
                    
                
            }
        }
    
    
    
    //ENd
    }
    
?>

