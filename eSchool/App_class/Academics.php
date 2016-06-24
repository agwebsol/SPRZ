<?
require_once('includes/Admin_cmsFunction.php');
class Academics extends Admin_cmsFunction {
    public function index(){
        ?>
            <html>
                <head>
                    
                </head>
                <body onload="academics()">
                    <? include('html/Academics.html'); ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</div>
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
                                        <td><a href="Admin.php?task=Academics&app=edit_calender"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                        <td>
                                            
                                        </td>
                                    
                                    </tr>
                                </table>
                                
                            </form>
                                <table class="table table-hover" style="width: 400px;">
                                    <tr>
                                        <th>
                                            <form name="form2" method="POST" action="Admin.php?task=Academics&app=view_time_table">
                                            <select name="class" required >
                                                <option value="">---Class Time Table---</option>
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
                                            <button onclick="onsubmit()"><span class="glyphicon glyphicon-search"></span></button>
                                        </form>
                                        </th>
                                        <td>
                                            <a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-comment"></span>Message Board</a>
                                        </td>
                                    </tr>
                                </table>
                                
                            <div id="calender" style="float: left;">
                                <?
                                    require_once('message_board.php');
                                    $txt = new message_board("Admin");
                                    ?>
                                        <div style=" margin-left: 100px;">
                                            <?$txt->show_board();?>
                                        </div>
                                    <?
                                ?>
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
                                                    <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>New Message Board Entry</h4></div>
                                                    <div class="panel-body">
                                                        <form method="POST" action="message_board.php?add=yes">
                                                            <table class="table table-hover">
                                                                <tr>
                                                                    <th>Date</th><td><input type="date" name="date"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Message</th>
                                                                    <td>
                                                                        <textarea name="message">
                                                                            
                                                                        </textarea>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th></th>
                                                                    <td>
                                                                        <input type="submit" name="submit" value="submit">
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
                            
                            <script>
                                function onsubmit(){
                                    document.getElementById("form2").submit();
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
                        </div>
                    </div>
                </body>
            </html>
        <?
        
    }
    public function edit_calender(){
        ?>
            <body>
                <div class="panel panel-primary">
                    <div class="panel panel-heading">
                     <span class="glyphicon glyphicon-calendar"></span> Calendar 
                    </div>
                    <div class="panel-body">
                        <form method ="POST" action="Admin.php?task=Academics&app=edit_calender">
                            <table class="table table-hover" style="width:100px;">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </td>
                                    <td>
                                        <select name= "month" onchange="calender(this.value)">
                                            <option value="">Select Month</option>
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
                                        <input type="submit" name="submit" value="submit">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <div>
                            <?
                                if(isset($_POST['submit'])){
                                    $month = $_POST['month'];
                                    $year = date("Y");
                                    $day = 01;
                                    $date = date_create($year.'-'.$month.'-'.$day);
                                    $total_days = date_format($date, "t");
                                    $first_day = date_format($date, "w");
                                    ?>
                                        <!DOCTYPE html>
                                            <html>
                                                <head>
                                                        <meta charset="utf-8">
                                                        <meta name="viewport" content="width=device-width, initial-scale=1">
                                                        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                                                        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
                                                </head>
                                                <body>
                                                    <div class="panel panel-primary" style="width: 400px;">
                                                        <div class="panel-heading"><? echo date_format($date, "F"); ?> <? echo $year; ?></div>
                                                        <div class="panel-body">
                                                            <table class="table table-hover">
                                                                <tr>
                                                                    <th>Mon</th>
                                                                    <th>Tue</th>
                                                                    <th>Wed</th>
                                                                    <th>Thur</th>
                                                                    <th>Fri</th>
                                                                    <th>Sat</th>
                                                                    <th>Sun</th>
                                                                </tr>
                                                                <tr>
                                                                    <?
                                                                        $k = "";
                                                                        for($i=0; $i<=$total_days+$first_day-1; $i++){
                                                                            ?>
                                                                                <td>
                                                                                    <?
                                                                                        if($i == $first_day){
                                                                                            $k = 1;
                                                                                        }
                                                                                        if(!$k ==""){
                                                                                            
                                                                                            
                                                                                            ?>
                                                                                                <button type="button" class="btn btn-info btn-xs" id="<? echo $k; ?>" onclick="run(<? echo $k; ?>, <? echo $month; ?>, <? echo $year; ?>)"><? echo $k; ?></button>

                                                                                            <?
                                                                                            $k++;
                                                                                        }
                                                                                    ?>
                                                                                </td>
                                                                            <?
                                                                            if($i%7==0){
                                                                                ?></tr><tr><?
                                                                            }
                                                                        }
                                                                    ?>
                                                                </tr>
                                                            </table>
                                                            <script>
                                                                
                                                                function run(day,month,year){
                                                                   $("#myModal").modal();
                                                                   if (window.XMLHttpRequest) {
                                                                   xmlhttp = new XMLHttpRequest();
                                                                   } else {
                                                                      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                                                   }
                                                                   xmlhttp.onreadystatechange = function() {
                                                                      if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                                                         document.getElementById("data").innerHTML = xmlhttp.responseText;
                                                                      }
                                                                   };
                                                                   xmlhttp.open("GET","calender.php?admin=yes&day="+day+"&month_="+month+"&year="+year, true);
                                                                   xmlhttp.send();
                                                                   
                                                                   
                                                                }
                                                             </script>
                                                            <div class="container">
                                                                <div class="modal fade" id="myModal" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 id="head" class="modal-title">Schedule</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div id="data">
                                                                                    
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
                                            </html>
                                        <?
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </body>
        <?
        
    }
    public function edit_calendar_form(){
        if(isset($_POST['day'])){
            $day = $_REQUEST['day'];
            $month = $_POST['month'];
            $year = $_POST['year'];
            $index = $_POST['index'];
            $dt = $year.'-'.$month.'-'.$day;
            $date_ = date_create($dt);
            $month_ = date_format($date_, "M");
            $full_date = date_format($date_, "M").' '.date_format($date_, "D").' '.$day.', '.$year;
            $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Calender.txt';
            if(file_exists($path)){
                $month_array = json_decode(file_get_contents($path), TRUE);
                $mon = json_decode($month_array[$month_]);
                $entry = json_decode($mon[$index-1], TRUE);
                ?>
                    <body>
                        <div class= "Panel panel-primary" style="width: 400px;">
                            <div class="panel-heading"><? echo $full_date; ?></div>
                            <div class="panel-body">
                                <form method="POST" action="calender.php">
                                    <table class="table table-hover" style="width: 400px;">
                                       <tr>
                                          <th>From</th>
                                          <td>
                                             <select name="start_hour" required>
                                                <option value="<? echo $entry['Start_hour']; ?>"><? echo $entry['Start_hour']; ?></option>
                                                <?
                                                   for($i=1; $i<=12; $i++){
                                                      ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                   }
                                                ?>
                                             </select>
                                          </td>
                                          <td>
                                             <select name="start_min" required>
                                                <option value="<? echo $entry['Start_min']; ?>"><? echo $entry['Start_min']; ?></option>
                                                <?
                                                   for($i=0; $i<=60; $i++){
                                                      ?><option value="<? echo $i; ?>"><? if($i<=9){echo '0'.$i; }else{ echo $i; } ?></option><?
                                                   }
                                                ?>
                                             </select>
                                          </td>
                                          <td>
                                             <select name="s_day">
                                                <option value="<? echo $entry['S_day']; ?>"><? echo $entry['S_day']; ?></option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                             </select>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>To</th>
                                          <td>
                                             <select name="end_hour" required>
                                                <option value="<? echo $entry['End_hour']; ?>"><? echo $entry['End_hour']; ?></option>
                                                <?
                                                   for($i=1; $i<=12; $i++){
                                                      ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                   }
                                                ?>
                                             </select>
                                          </td>
                                          <td>
                                             <select name="end_min" required>
                                                <option value="<? echo $entry['End_min']; ?>"><? echo $entry['End_min']; ?></option>
                                                <?
                                                   for($i=0; $i<=60; $i++){
                                                      ?><option value="<? echo $i; ?>"><? if($i<=9){echo '0'.$i; }else{ echo $i; } ?></option><?
                                                   }
                                                ?>
                                             </select>
                                          </td>
                                          <td>
                                             <select name="e_day">
                                                <option value="<? echo $entry['E_day']; ?>"><? echo $entry['E_day']; ?></option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                             </select>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th>Entry</th>
                                          <td>
                                             <textarea name="entry">
                                                <? echo $entry['Entry']; ?>
                                             </textarea>
                                          </td>
                                       </tr>
                                       <tr>
                                          <th></th>
                                          <td>
                                             <input type="hidden" name="day" value="<? echo $day; ?>">
                                             <input type="hidden" name="month" value="<? echo $month_; ?>">
                                             <input type="hidden" name="year" value="<? echo $year; ?>">
                                             <input type="hidden" name="index" value="<? echo $index; ?>">
                                             <input type="submit" name="update" value="Update">
                                          </td>
                                       </tr>
                                    </table>
                                 </form>
                                <form method="POST" action="calender.php">
                                    <input type="hidden" name="day" value="<? echo $day; ?>">
                                    <input type="hidden" name="month" value="<? echo $month_; ?>">
                                    <input type="hidden" name="year" value="<? echo $year; ?>">
                                    <input type="hidden" name="index" value="<? echo $index; ?>">
                                    <input type="submit" name="delete" value="Delete Entry">
                                </form>
                                
                            </div>
                        </div>
                    </body>
                <?
            }
            
            
        }
    }
    public function view_time_table(){
        if(isset($_REQUEST['class'])){
            $class = $_POST['class'];
            $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Time_Table/Time_Table.txt';
            if(file_exists($path)){
                $file = file_get_contents($path);
                $json = json_decode($file, TRUE);
                $class_week = $json[$class];
                $week = json_decode($class_week, TRUE);
                ?>
                    <body>
                        
                        <div class="panel panel-primary" style="width: 105%;">
                            <div class="panel-heading">Class Time Table For <? echo $class;  ?></div>
                            <div class ="panel-body">
                                <form>
                                    <table class="table table-hover" style="width:900px;">
                                        <tr>
                                            <th>
                                                
                                                <span>
                                                    Monday
                                                    <form method="POST" action="Admin.php?task=Academics&app=add_schedule">
                                                    <input type="hidden" name="day" value="">
                                                    <input type="hidden" name="class" value="<? echo $class; ?>">
                                                    <input type="hidden" name="submit" value="+">
                                                </form>
                                                    <form method="POST" action="Admin.php?task=Academics&app=add_schedule">
                                                    <input type="hidden" name="day" value="Monday">
                                                    <input type="hidden" name="class" value="<? echo $class; ?>">
                                                    <input type="submit" name="submit" value="+">
                                                </form>
                                                
                                                </span>
                                            </th>
                                            <th>
                                                Tuesday<form method="POST" action="Admin.php?task=Academics&app=add_schedule">
                                                    <input type="hidden" name="day" value="Tuesday">
                                                    <input type="hidden" name="class" value="<? echo $class; ?>">
                                                    <input type="submit" name="submit" value="+">
                                                </form>
                                            </th>
                                            <th>
                                                Wednesday
                                                <form method="POST" action="Admin.php?task=Academics&app=add_schedule">
                                                    <input type="hidden" name="day" value="Wednesday">
                                                    <input type="hidden" name="class" value="<? echo $class; ?>">
                                                    <input type="submit" name="submit" value="+">
                                                </form>
                                            </th>
                                            <th>
                                                Thursday
                                                <form method="POST" action="Admin.php?task=Academics&app=add_schedule">
                                                    <input type="hidden" name="day" value="Thursday">
                                                    <input type="hidden" name="class" value="<? echo $class; ?>">
                                                    <input type="submit" name="submit" value="+">
                                                </form>
                                            </th>
                                            <th>
                                                Friday
                                                <form method="POST" action="Admin.php?task=Academics&app=add_schedule">
                                                    <input type="hidden" name="day" value="Friday">
                                                    <input type="hidden" name="class" value="<? echo $class; ?>">
                                                    <input type="submit" name="submit" value="+">
                                                </form>
                                            </th>
                                            <th>
                                                Saturday
                                                <form method="POST" action="Admin.php?task=Academics&app=add_schedule">
                                                    <input type="hidden" name="day" value="Saturday">
                                                    <input type="hidden" name="class" value="<? echo $class; ?>">
                                                    <input type="submit" name="submit" value="+">
                                                </form>
                                            </th>
                                            <th>
                                                Sunday
                                                <form method="POST" action="Admin.php?task=Academics&app=add_schedule">
                                                    <input type="hidden" name="day" value="Sunday">
                                                    <input type="hidden" name="class" value="<? echo $class; ?>">
                                                    <input type="submit" name="submit" value="+">
                                                </form>
                                            </th>
                                        </tr>
                                        <tr>
                                            <?
                                                foreach($week as $key => $value){
                                                    $v = json_decode($value);
                                                    $k = 0;
                                                    ?>
                                                        <td>
                                                            <?
                                                                foreach($v as $slot){
                                                                    $k++;
                                                                    $sub = json_decode($slot, TRUE);
                                                                    if($sub['Start_minute']<=9){
                                                                        $s_minute = '0'.$sub['Start_minute'];
                                                                    }else{
                                                                        $s_minute = $sub['Start_minute'];
                                                                    }
                                                                    if($sub['End_minute']<=9){
                                                                        $e_minute = '0'.$sub['End_minute'];
                                                                    }else{
                                                                        $e_minute = $sub['End_minute'];
                                                                    }
                                                                    $day = $sub['Day'];
                                                                    ?>
                                                                        <div>
                                                                            <table class="table table-hover">
                                                                                <tr style="color:GREEN;">
                                                                                    <td>
                                                                                        <? echo $sub['Start_hour'].':'.$s_minute.' '.$sub['Start'].'-'.$sub['End_hour'].':'.$e_minute.' '.$sub['End']; ?>
                                            
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="color:BLUE;">
                                                                                    <td>
                                                                                        <? echo $sub['Entry']; ?>
                                                    
                                                                                        
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <form method="POST" action="Admin.php?task=Academics&app=edit_time_table">
                                                                                            <input type="hidden" value="<? echo $class; ?>" name="class">
                                                                                            <input type="hidden" value="<? echo $day; ?>" name="day">
                                                                                            <input type="hidden" value="<? echo $k;?>" name="index">
                                                                                            <input type="hidden" value="Edit" name="edit">
                                                                                        </form>
                                                                                        <form method="POST" action="Admin.php?task=Academics&app=edit_time_table">
                                                                                            <input type="hidden" value="<? echo $class; ?>" name="class">
                                                                                            <input type="hidden" value="<? echo $day; ?>" name="day">
                                                                                            <input type="hidden" value="<? echo $k;?>" name="index">
                                                                                            <input type="submit" value="Edit" name="edit">
                                                                                        </form>
                                                                                    </td>
                                                                                </tr>
                                                                    
                                                                            </table>
                                                                        </div><br>
                                                                    <?
                                                                }
                                                            ?>
                                                        </td>
                                                        
                                                    <?
                                                }
                                            ?>
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
    
    public function add_schedule(){
        if(isset($_POST['submit'])){
            $day = $_POST['day'];
            $class = $_POST['class'];
            ?>
                <body>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h4><? echo $class.' '.$day; ?> New Entry</h4></div>
                        <div class="panel-body">
                            <form method="POST" action="Admin.php?task=Academics&app=add_schedule">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Start Time</th>
                                        <td>
                                            <select name="start_hour" required>
                                                <option value="">--Select--</option>
                                                <?
                                                    for($i=0; $i<=12; $i++ ){
                                                        ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="start_minute" required>
                                                <option value="">--Select--</option>
                                                <?
                                                    for($i=0; $i<=60; $i++ ){
                                                        ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="start" required>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>End Time</th>
                                        <td>
                                            <select name="end_hour" required>
                                                <option value="">--Select--</option>
                                                <?
                                                    for($i=0; $i<=12; $i++ ){
                                                        ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="end_minute" required>
                                                <option value="">--Select--</option>
                                                <?
                                                    for($i=0; $i<=60; $i++ ){
                                                        ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="end" required>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Enter Description</th>
                                        <td>
                                            <textarea name="entry" rows="7" cols="30" required>
                                                
                                            </textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><input type="hidden" name="class" value="<? echo $class; ?>"><input type="hidden" name="day" value="<? echo $day;?>"></th>
                                        <td><input type="submit" name="add" value="submit"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </body>
            <?  
        }
        
        if(isset($_POST['add'])){
            $day = $_POST['day'];
            $class = $_POST['class'];
            $start_hour = $_POST['start_hour'];
            $start_minute =$_POST['start_minute'];
            $start = $_POST['start'];
            $end_hour = $_POST['end_hour'];
            $end_minute = $_POST['end_minute'];
            $end = $_POST['end'];
            $entry =$_POST['entry'];
            $array = array(
              "Start_hour" => $start_hour,
              "Start_minute" => $start_minute,
              "Start" => $start,
              "End_hour" => $end_hour,
              "End_minute" => $end_minute,
              "End" => $end,
              "Entry" => $entry,
              "Day" => $day
            );
            $conflict = 'No';
            $schd = json_encode($array);
            $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Time_Table/Time_Table.txt';
            if(file_exists($path)){
                $file = file_get_contents($path);
                $json = json_decode($file, TRUE);
                $class_week = $json[$class];
                $week = json_decode($class_week, TRUE);
                foreach($week as $key=> $value){
                    if($key == $day){
                        $schedule = json_decode($value);
                        foreach($schedule as $s){
                            $v = json_decode($s, TRUE);
                            if($v['End_hour']==$start_hour){
                                if($v['End_minute']>=$start_minute){
                                    $conflict ='Yes';
                                }
                            }
                        }
                        
                    }
                }
                if($conflict=='Yes'){
                    echo 'There is A Conflict of Schedule';
                }
                if($conflict=='No'){
                    foreach($week as $key => $value){
                        if($key == $day){
                            $schedule = json_decode($value);
                            $schedule[]=$schd;
                            $js_schd = json_encode($schedule);
                            $week[$day] = $js_schd;
                        }
                    }
                    $js_week = json_encode($week);
                    $json[$class] = $js_week;
                    $time = json_encode($json);
                    $fill = fopen($path, "w");
                            fwrite($fill, $time);
                            fclose($fill);
                   
                }
                
            }
        }
    }
    
    public function edit_time_table(){
        if(isset($_POST['edit'])){
            $day=$_POST['day'];
            $class = $_POST['class'];
            $index = $_POST['index'];
            $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Time_Table/Time_Table.txt';
            if(file_exists($path)){
                $txt = file_get_contents($path);
                $time_table = json_decode($txt, TRUE);
                $class_schd = $time_table[$class];
                $class_week = json_decode($class_schd, TRUE); 
                $day_schd = $class_week[$day];
                $day_ = json_decode($day_schd);
                $day_s = json_decode($day_[$index-1], TRUE);
                ?>
                <body>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h4><? echo $class.' '.$day; ?> Edit Entry</h4></div>
                    <div class="panel-body">
                        
                        <form method="POST" action="Admin.php?task=Academics&app=update_table">
                            <table class="table table-hover">
                                <tr>
                                    <th>Start Time</th>
                                    <td>
                                        <select name="start_hour" required>
                                            <option value="<? echo $day_s['Start_hour']; ?>"><? echo $day_s['Start_hour']; ?></option>
                                            <?
                                                for($i=0; $i<=12; $i++ ){
                                                    ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="start_minute" required>
                                            <option value="<? echo $day_s['Start_minute']; ?>"><? echo $day_s['Start_minute']; ?></option>
                                            <?
                                                for($i=0; $i<=60; $i++ ){
                                                    ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="start" required>
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>End Time</th>
                                    <td>
                                        <select name="end_hour" required>
                                            <option value="<? echo $day_s['End_hour']; ?>"><? echo $day_s['End_hour']; ?></option>
                                            <?
                                                for($i=0; $i<=12; $i++ ){
                                                    ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="end_minute" required>
                                            <option value="<? echo $day_s['End_minute']; ?>"><? echo $day_s['End_minute']; ?></option>
                                            <?
                                                for($i=0; $i<=60; $i++ ){
                                                    ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="end" required>
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Enter Description</th>
                                    <td>
                                        <textarea name="entry" rows="7" cols="30" required>
                                          <? echo $day_s['Entry']; ?>  
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th><input type="hidden" name="class" value="<? echo $class; ?>">
                                    <input type="hidden" name="day" value="<? echo $day;?>">
                                    <input type="hidden" name='index' value="<? echo $index; ?>">
                                    </th>
                                    <td><input type="submit" name="update" value="submit"></td>
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
    public function update_table(){
        if(isset($_POST['update'])){
                $day = $_POST['day'];
                $class = $_POST['class'];
                $index = $_POST['index'];
                $start_hour = $_POST['start_hour'];
                $start_minute =$_POST['start_minute'];
                $start = $_POST['start'];
                $end_hour = $_POST['end_hour'];
                $end_minute = $_POST['end_minute'];
                $end = $_POST['end'];
                $entry =$_POST['entry'];
                $array = array(
                  "Start_hour" => $start_hour,
                  "Start_minute" => $start_minute,
                  "Start" => $start,
                  "End_hour" => $end_hour,
                  "End_minute" => $end_minute,
                  "End" => $end,
                  "Entry" => $entry,
                  "Day" => $day
                );
                $conflict = 'No';
                $schd = json_encode($array);
                $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Time_Table/Time_Table.txt';
                if(file_exists($path)){
                    $file = file_get_contents($path);
                    $json = json_decode($file, TRUE);
                    $class_week = $json[$class];
                    $week = json_decode($class_week, TRUE);
                    foreach($week as $key=> $value){
                        if($key == $day){
                            $schedule = json_decode($value);
                            foreach($schedule as $s){
                                $v = json_decode($s, TRUE);
                                if($v['End_hour']==$start_hour){
                                    if($v['End_minute']>=$start_minute){
                                        $conflict ='Yes';
                                    }
                                }
                            }
                            
                        }
                    }
                    if($conflict =='No'){
                        foreach($week as $key => $value){
                            if($key == $day){
                                $schedule = json_decode($value);
                                array_splice($schedule, $index-1, 1, $schd);
                                $js_schd = json_encode($schedule);
                                $week[$day] = $js_schd;
                            }
                        }
                        $js_week = json_encode($week);
                        $json[$class] = $js_week;
                        $time = json_encode($json);
                        $fill = fopen($path, "w");
                                fwrite($fill, $time);
                                fclose($fill);
                    }
                    if($conflict =='Yes'){
                        echo 'Conflict';
                    }
                    
                }
            }
    }
    
    
//End
}
?>

