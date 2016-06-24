<?
    if(isset($_REQUEST['view'])){
        $month = $_REQUEST['month'];
        $year = date("Y");
        $day = 01;
        $date = date_create($year.'-'.$month.'-'.$day);
        
        $total_days = date_format($date, "t");
        $first_day = date_format($date, "w");
        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Calender.txt';
        if(file_exists($path)){
            $month_array = json_decode(file_get_contents($path), TRUE);
            $Month = json_decode($month_array[date_format($date, "M")]);
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
                            <div class="panel panel-primary" style="width: 120%;">
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
                                                                    ?><h4><? echo $k; ?></h4><?
                                                                    foreach($Month as $value){
                                                                        $v = json_decode($value, TRUE);
                                                                        if($v['day']==$k){
                                                                            ?>
                                                                                
                                                                                        <span>
                                                                                        <? echo $v['Start_hour'].':'.$v['Start_min'].' '.$v['S_day'].'-'.$v['End_hour'].':'.$v['End_min'].' '.$v['E_day']; ?><br>
                                                                                        <? echo $v['Entry']; ?>
                                                                                        </span>
                                                                                   
                                                                            <?
                                                                        }
                                                                    }
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
                            
                                </div>
                            </div>
                            
                        </body>
                    </html>
            <?
        }

    }
?>









<?
    if(isset($_REQUEST['admin'])){
        $day = $_REQUEST['day'];
        $month_ = $_REQUEST['month_'];
        $year = $_REQUEST['year'];
        $dt = $year.'-'.$month_.'-'.$day;
        $date_ = date_create($dt);
        $month_ = date_format($date_, "M");
        $full_date = date_format($date_, "M").' '.date_format($date_, "D").' '.$day.', '.$year;
        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Calender.txt';
        if(file_exists($path)){
            $txt = file_get_contents($path);
            $month_array = json_decode($txt, TRUE);
            $month_txt = $month_array[$month_];
            $month = json_decode($month_txt);
            ?>
                <body>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><? echo $full_date; ?></div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tr>
                                    <th>Time</th>
                                    <th>Event</th>
                                </tr>
                                <?
                                    $index=0;
                                  foreach($month as $value){
                                    $index++;
                                    $v= json_decode($value, TRUE);
                                    if($v['day']==$day){
                                        if($v['Start_min']<9 || $v['End_min']<9){
                                            $st = '0'.$v['Start_min'];
                                            $ed = '0'.$v['End_min'];
                                        }
                                        ?>
                                            <tr>
                                                <td><? echo $v['Start_hour'].':'.$st.' '.$v['S_day'].'-'.$v['End_hour'].':'.$ed.' '.$v['E_day']; ?></td>
                                                <td><? echo $v['Entry']; ?></td>
                                                <td>
                                                    <form name="edit" method ="POST" action="Admin.php?task=Academics&app=edit_calendar_form">
                                                        <input type="hidden" name="month" value="<? echo $month_; ?>">
                                                        <input type="hidden" name="index" value="<? echo $index; ?>">
                                                        <input type="hidden" name="day" value="<? echo $day; ?>">
                                                        <input type="hidden" name="year" value="<? echo $year; ?>">
                                                        <button><span class="glyphicon glyphicon-edit"></span></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?
                                    }
                                  }
                                ?>
                            </table>
                            <script>
                                function formSubmit() {
                                    document.getElementById("edit").submit();
                                }
                            </script>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel panel-heading"><span class="glyphicon glyphicon-plus"></span></div>
                        <div class="panel panel-body">
                            <form method="POST" action="calender.php">
                                <table class="table table-hover" style="width:300px;">
                                   <tr>
                                      <th>From</th>
                                      <td>
                                         <select name="start_hour" required>
                                            <option value="">Hour</option>
                                            <?
                                               for($i=1; $i<=12; $i++){
                                                  ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                               }
                                            ?>
                                         </select>
                                      </td>
                                      <td>
                                         <select name="start_min" required>
                                            <option value="">Minute</option>
                                            <?
                                               for($i=0; $i<=60; $i++){
                                                  ?><option value="<? echo $i; ?>"><? if($i<=9){echo '0'.$i; }else{ echo $i; } ?></option><?
                                               }
                                            ?>
                                         </select>
                                      </td>
                                      <td>
                                         <select name="s_day">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                         </select>
                                      </td>
                                   </tr>
                                   <tr>
                                      <th>To</th>
                                      <td>
                                         <select name="end_hour" required>
                                            <option value="">Hour</option>
                                            <?
                                               for($i=1; $i<=12; $i++){
                                                  ?><option value="<? echo $i; ?>"><? echo $i; ?></option><?
                                               }
                                            ?>
                                         </select>
                                      </td>
                                      <td>
                                         <select name="end_min" required>
                                            <option value="">Minute</option>
                                            <?
                                               for($i=0; $i<=60; $i++){
                                                  ?><option value="<? echo $i; ?>"><? if($i<=9){echo '0'.$i; }else{ echo $i; } ?></option><?
                                               }
                                            ?>
                                         </select>
                                      </td>
                                      <td>
                                         <select name="e_day">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                         </select>
                                      </td>
                                   </tr>
                                   <tr>
                                      <th>Entry</th>
                                      <td>
                                         <textarea name="entry">
                                            
                                         </textarea>
                                      </td>
                                   </tr>
                                   <tr>
                                      <th></th>
                                      <td>
                                         <input type="hidden" name="day" value="<? echo $day; ?>">
                                         <input type="hidden" name="month" value="<? echo $month_; ?>">
                                         <input type="hidden" name="year" value="<? echo $year; ?>">
                                         <input type="submit" name="calendar" value="Submit">
                                      </td>
                                   </tr>
                                </table>
                             </form>
                        </div>
                    </div>
                </body>
            <?
        }
        
    }
?>

<?
    if(isset($_POST['calendar'])){
        $start_hour =$_POST['start_hour'];
        $start_min = $_POST['start_min'];
        $s_day = $_POST['s_day'];
        $end_hour =$_POST['end_hour'];
        $end_min = $_POST['end_min'];
        $e_day = $_POST['e_day'];
        $entry = $_POST['entry'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $array = array(
           "day" => $day,
          "Start_hour"=>$start_hour,
          "Start_min" =>$start_min,
          "S_day" => $s_day,
          "End_hour" => $end_hour,
          "End_min" => $end_min,
          "E_day" => $e_day,
          "Entry" => $entry
        );
        $slot = json_encode($array);
        $dt = $year.'-'.$month.'-'.$day;
        $date_ = date_create($dt);
        $month_ = date_format($date_, "M");
        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Calender.txt';
         if(file_exists($path)){
                $txt = file_get_contents($path);
                $year_array = json_decode($txt, TRUE);
                $month_array = json_decode($year_array[$month_]);
                array_push($month_array, $slot);
                $mon = json_encode($month_array);
                $year_array[$month_] = $mon;
                $year_txt = json_encode($year_array);
                $file = fopen($path, "w");
                        fwrite($file, $year_txt);
                        fclose($file);
                        header('LOCATION: Admin.php');
           }
    }
?>








<?
    if(isset($_POST['update'])){
        $start_hour =$_POST['start_hour'];
        $start_min = $_POST['start_min'];
        $s_day = $_POST['s_day'];
        $end_hour =$_POST['end_hour'];
        $end_min = $_POST['end_min'];
        $e_day = $_POST['e_day'];
        $entry = $_POST['entry'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $index = $_POST['index'];
        $array = array(
           "day" => $day,
          "Start_hour"=>$start_hour,
          "Start_min" =>$start_min,
          "S_day" => $s_day,
          "End_hour" => $end_hour,
          "End_min" => $end_min,
          "E_day" => $e_day,
          "Entry" => $entry
        );
        $slot = json_encode($array);
        $dt = $year.'-'.$month.'-'.$day;
        $date_ = date_create($dt);
        $month_ = date_format($date_, "M");
        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Calender.txt';
        if(file_exists($path)){
            $month_array = json_decode(file_get_contents($path), TRUE);
            $mon = json_decode($month_array[$month_]);
            array_splice($mon,$index-1,1,$slot);
            $json = json_encode($mon);
            $month_array[$month] = $json;
            $js = json_encode($month_array);
            $file = fopen($path, "w");
                        fwrite($file, $js);
                        fclose($file);
                        header('LOCATION: Admin.php');
            
        }
    }
?>

<?
    if(isset($_POST['delete'])){
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $index = $_POST['index'];
        $dt = $year.'-'.$month.'-'.$day;
        $date_ = date_create($dt);
        $month_ = date_format($date_, "M");
        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Calender.txt';
        if(file_exists($path)){
            $month_array = json_decode(file_get_contents($path), TRUE);
            $mon = json_decode($month_array[$month_]);
            array_splice($mon,$index-1,1,"");
            $json = json_encode($mon);
            $month_array[$month] = $json;
            $js = json_encode($month_array);
            $file = fopen($path, "w");
                        fwrite($file, $js);
                        fclose($file);
                        header('LOCATION: Admin.php');
            
        }
    }
?>
