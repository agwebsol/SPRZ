<?
require_once('includes/Admin_cmsFunction.php');
class manage_grade extends Admin_cmsFunction {
    
    public function grade(){
        if(isset($_POST['submit'])){
            $class = $_POST['class'];
            $year = $_POST['session'].'/'.$_POST['term'];
            
            ?>
            <body onload="student()">
                <? include('html/student.html'); ?>
                <div class="panel panel-primary">
                    <div class="panel-heading"><span class="glyphicon glyphicon-wrench"></span>Select Student To Manage Grade</div>
                    <div class="panel-body">
                        <form method="POST" action="Admin.php?task=manage_grade&app=grade_manage">
                            <table>
                                <tr>
                                
                                    <td>
                                            <select name="student_id" required>
                                                <option value="">---Select---</option>
                                                <?php
                                                    $search = array(
                                                      "class" => "search",
                                                      "method" => "list_student_class",
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
                                                            for($i=0; $i<=$k-2; $i++){
                                                            ?><option value="<? echo $id[$i].'-'.$fname[$i]; ?>"><? echo $fname[$i]; ?></option><?    
                                                            
                                                            }
                                                        }
                                                    }
                                                                                
                                                ?>
                                            </select>
                                    </td>
                                
                                   <td><input type="hidden" name="year" value="<? echo $year; ?>"></th><td></td> 

                                <td><input class="button" type="submit" name="submit" value="Manage Grade" ></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </body>
            <?
        }
    }
    
    public function grade_manage(){
        if(!$_POST['student_id']==""){
            $name_id = $_POST['student_id'];
            $name_id = explode("-", $name_id);
            $id = $name_id[0];
            $name = $name_id[1];
            $year = $_POST['year'];
            $a = explode("/", $year);
            $session =$a[0];
            $term = $a[1];
            $path =   '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/'.$session.'/Grades/'.$id.'.txt';
            if(file_exists($path)){
                $report = file_get_contents($path);
                $json=json_decode($report, TRUE);
                $term_report = $json[$term];
                $js = json_decode($term_report);
                $k=0;
                ?>
                <body onload="student()">
                    <? include('html/student.html'); ?>
                    <div>
                        <div class="panel panel-primary">
                            <div class="panel-heading"><? echo $name; ?></div>
                            <div class="panel-body">
                                <form method="POST" action ="Admin.php?task=manage_grade&app=grade_exe">
                                    <table class="table table-hover">
                                        <?
                                            foreach($js as $key =>$value){
                                                $k++;
                                                $v = json_decode($value, TRUE);
                                                    ?>
                                                        <tr>
                                                            <th><? echo $key; ?></th><td><input type="hidden" value="<? echo $key; ?>" name="<? echo $k; ?>"></td>
                                                            <td>
                                                                <ul style="">
                                                                    <li><span><h6>Test 1</h6></span><input type="text" name="<? echo $k.'Test1'; ?>" value="<? echo $v['Test1']; ?>"></li>
                                                                    <li><span><h6>Test 2</h6></span><input type="text" name="<? echo $k.'Test2'; ?>" value="<? echo $v['Test2']; ?>"></li>
                                                                    <li><span><h6>Test 3</h6></span><input type="text" name="<? echo $k.'Test3'; ?>" value="<? echo $v['Test3']; ?>"></li>
                                                                    <li><span><h6>Exam</h6></span><input type="text" name="<? echo $k.'Exam'; ?>" value="<? echo $v['Exam']; ?>"></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        
                                                    <?
                                            }
                                       ?>
                                       <tr>     
                                            <td>
                                                <input type="submit" name="submit" value="submit">
                                                <input type="hidden" name="id" value="<? echo $id; ?>">
                                                <input type="hidden" name="name" value="<? echo $name; ?>">
                                                <input type="hidden" name="term" value="<? echo $term; ?>">
                                                <input type="hidden" value="<? echo $path; ?>" name="path">
                                            </td>
                                       </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </body>  
                <?
            }else{ echo '<h4>No Entry Recorded Yet.</h4>';}
            
        }
    }
    
    public function grade_exe(){
        if(isset($_POST['submit'])){
           $count = count($_POST);
           $path = $_POST['path'];
           $name = $_POST['name'];
           $term = $_POST['term'];
           $k=0;
           $file = file_get_contents($path);
           $report= json_decode($file, TRUE);
           $term1 = $report[$term];
           $js = json_decode($term1, TRUE);
           
           ?>
                <body onload="student()">
                    <? include('html/student.html'); ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><? echo $name.' '.$term; ?> Report Card</div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tr>
                                    <th><h4>Subject</h4></th><th>Test 1</th><th>Test 2</th><th>Test 3</th><th>Exam</th><th>Total</th>
                                </tr>
                                <?
                                   for($i=0; $i<=$count-60; $i++){
                                        error_reporting(E_ALL ^ E_NOTICE);
                                            $k++;
                                            $subject = $_POST[$k];
                                            $test1 = $_POST[$k.'Test1'];
                                            $test2 = $_POST[$k.'Test2'];
                                            $test3 = $_POST[$k.'Test3'];
                                            $exam = $_POST[$k.'Exam'];
                                            $array = array(
                                                "Subject" => $subject,
                                                "Test1" => $test1,
                                                "Test2" => $test2,
                                                "Test3" => $test3,
                                                "Exam" => $exam
                                            );
                                            $grade = json_encode($array);
                                            foreach($js as $key => $value){
                                                if($key ==$subject){
                                                   $js[$key] =$grade; 
                                                }
                                            }
                                            $total = $test1 + $test2 + $test3 + $exam;
                                            ?>
                                            <tr>
                                                <th><? echo $subject; ?></th>
                                                <td><? echo $test1; ?></td>
                                                <td><? echo $test2; ?></td>
                                                <td><? echo $test3; ?></td>
                                                <td><? echo $exam; ?></td>
                                                <td><? if(!$total ==0){ echo $total; } ?></td>
                                            </tr>
                                            <? 
                                    }
                                    $json = json_encode($js);
                                    $report[$term] = $json;
                                    $report_card = json_encode($report);
                                    $fill = fopen($path, "w");
                                            fwrite($fill, $report_card);
                                            fclose($fill);
                                    
                                ?>
                            </table>
                        </div>
                    </div>
                </body>
           <?
        }
    }
//End    
}
?>