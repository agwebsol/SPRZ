<?
require_once('includes/Teacher_cmsFunction.php');
    class lesson_note extends Teacher_cmsFunction {
        public function index(){
            ?>
                <body>
                    <div class="panel panel-info">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <table>
                                <tr>
                                    <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-plus">Notes</span></a></td>
                                    <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-eye-open">view</span></a></td>
                                    
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
                                                    <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> Add Notes For <? echo $_SESSION['Subject_Admin']; ?></h4></div>
                                                    <div class="panel-body">
                                                        <form method="POST" action="Lesson_note.php">
                                                            <table class="table table-hover" style="width: 600px;">
                                                                <tr>
                                                                    <th>Topic</th>
                                                                    <td><input type="text" name="topic"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Note</th>
                                                                    <td>
                                                                        <textarea name="txt" cols="70" rows="20"></textarea>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        <input type="hidden" name="sub-class" value="<? echo $_SESSION['Subject_Admin']; ?>">
                                                                        <input type="hidden" name="name" value="<? echo $_SESSION['Teacher_Name']; ?>">
                                                                    </th>
                                                                    <td><input type="submit" name="submit" value="submit"></td>
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
                            <div class="container">
                                <div class="modal fade" id="myModal2" role="dialog">
                                    <div class="modal-dialog" >
                                        <div class="modal-content" style="width: 120%;">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="panel panel-primary" style="width: 670px;">
                                                    <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> View Notes <? echo $_SESSION['Subject_Admin']; ?></h4></div>
                                                    <div class="panel-body">
                                                        <form method="POST" action="Lesson_note.php?">
                                                            <table class="table table-hover" style="width: 600px;">
                                                                <?
                                                                    $subclass = $_SESSION['Subject_Admin'];
                                                                    $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/'.$subclass.'.txt';
                                                                    $index=0;
                                                                    if(file_exists($path)){
                                                                        $notes= json_decode(file_get_contents($path));
                                                                        foreach($notes as $value){
                                                                            $index++;
                                                                            $v= json_decode($value,TRUE);
                                                                            $view ='<a href="Teacher.php?task=lesson_note&app=view_note&index='.$index.'"><span class="glyphicon glyphicon-search"></span></a>';
                                                                            $view_answers='<a href="Teacher.php?task=lesson_note&app=view_answer&topic='.$v['Topic'].'"><span class="glyphicon glyphicon-eye-open">Answers</span></a>';
                                                                            ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <? echo $v['Topic']; ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <? echo $view; ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <? echo $view_answers?>
                                                                                    </td>
                                                                                </tr>
                                                                            <?
                                                                        }
                                                                    }
                                                                ?>
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
                </body>
            <?
        }
        
        public function view_note(){
            if(isset($_REQUEST['index'])){
                $index= $_REQUEST['index'];
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/'.$_SESSION['Subject_Admin'].'.txt';
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
                                    <tr>
                                        <th></th>
                                        <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-edit">Edit</span></a></td>
                                        <td><a role="button" href="Lesson_note.php?delete=yes&index=<? echo $index; ?>&subclass=<? echo $_SESSION['Subject_Admin']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                                    </tr>
                                </table>
                                
                            </div>
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
                                                    <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> Add Notes For <? echo $_SESSION['Subject_Admin']; ?></h4></div>
                                                    <div class="panel-body">
                                                        <form method="POST" action="Lesson_note.php?update=yes">
                                                            <table class="table table-hover" style="width: 600px;">
                                                                <tr>
                                                                    <th>Topic</th>
                                                                    <td><input type="text" name="topic" value="<? echo $entry['Topic']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Note</th>
                                                                    <td>
                                                                        <textarea name="txt" cols="70" rows="20"><? echo $entry['Note']; ?></textarea>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        <input type="hidden" name="index" value="<? echo $index; ?>">
                                                                        <input type="hidden" name="sub-class" value="<? echo $_SESSION['Subject_Admin']; ?>">
                                                                        <input type="hidden" name="name" value="<? echo $_SESSION['Teacher_Name']; ?>">
                                                                    </th>
                                                                    <td><input type="submit" name="update" value="submit"></td>
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
        
        public function view_answer(){
            if(isset($_REQUEST['topic'])){
                $topic = $_REQUEST['topic'];
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/Answers/'.$_SESSION['Subject_Admin'].'.txt';
                if(file_exists($path)){
                    $array = json_decode(file_get_contents($path));
                    ?>
                        <body>
                            <div class="panel panel-info">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <?
                                            foreach($array as $value){
                                                $v = json_decode($value, TRUE);
                                                $name = $v['Name'];
                                                $exp = explode('-', $name);
                                                $tp ='';
                                                foreach($exp as $val){
                                                    $tp =$val;
                                                }
                                                if($tp ==$topic){
                                                    $info_path ='/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Student_Info/'.$exp[0].'.txt';
                                                    $info = json_decode(file_get_contents($info_path), TRUE);
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?
                                                                    echo $info['fname'].' '.$info['sname']; 
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?
                                                                  echo $view_answers='<a href="Teacher.php?task=lesson_note&app=show_answer&info='.$name.'"><span class="glyphicon glyphicon-eye-open">Answer</span></a>';  
                                                                ?>
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
        }
        
        public function show_answer(){
            if(isset($_REQUEST['info'])){
                $info = $_REQUEST['info'];
                $exp = explode('-', $info);
                $tp ='';
                foreach($exp as $val){
                    $tp =$val;
                }
                
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/Answers/'.$_SESSION['Subject_Admin'].'.txt';
                if(file_exists($path)){
                    $array = json_decode(file_get_contents($path));
                    ?>
                        <body>
                            <div class="panel panel-info">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <?
                                            $index = 0;
                                            foreach($array as $value){
                                                $index++;
                                                $v = json_decode($value, TRUE);
                                                if($v['Name']==$info){
                                                    ?>
                                                        <tr>
                                                            <td>
                                                               <textarea cols="70" rows="20" disabled=><? echo $v['Answer']; ?></textarea> 
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
                                                            <td>
                                                                <a href="Teacher.php?task=lesson_note&app=view_answer&topic=<? echo $tp;  ?>"><span class="glyphicon glyphicon-arrow-left"></span> Back To Assignment List</a>
                                                            </td>
                                                            <td>
                                                                <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-plus"></span> Grade/Comments</a>
                                                            </td>
                                                        </tr>
                                                    <?
                                                }
                                            }
                                        ?>
                                    </table>
                                    <div class="container">
                                        <div class="modal fade" id="myModal1" role="dialog">
                                            <div class="modal-dialog" >
                                                <div class="modal-content" style="width: 120%;">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="panel panel-primary" style="width: 670px;">
                                                            <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span> Add Grade and Comment</h4></div>
                                                            <div class="panel-body">
                                                                <form method="POST" action="Lesson_note.php?grade">
                                                                    <table class="table table-hover" style="width: 600px;">
                                                                        <tr>
                                                                            <th>Grade</th>
                                                                            <td><input type="text" name="grade" value="<? echo $grade['grade']; ?>"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Comment</th>
                                                                            <td>
                                                                                <textarea name="comment" cols="60" rows="10"><? echo $grade['comment']; ?></textarea>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <input type="hidden" name="index" value="<? echo $index; ?>">
                                                                                <input type="hidden" name="path" value="<? echo $path; ?>">
                                                                            </th>
                                                                            <td><input type="submit" name="grade_exe" value="Grade"></td>
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
                            </div>
                        </body>
                    <?
                }
            }
        }
   //ENd     
    }
?>








