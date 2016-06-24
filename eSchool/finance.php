<?
if(isset($_REQUEST['class'])){
   $class = $_REQUEST['class'];
   ?>
        <body>
            <div class="panel panel-primary">
                <div class="panel-heading"><span class="glyphicon glyphicon-check"></span>Select Student</div>
                <div class="panel-body">
                    <form method="POST" action="finance.php">
                        <table>
                            <tr>
                                <td>
                                    <select name="student_id" required>
                                        <option value="">---Select---</option>
                                        <?
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
                                                    ?><option value="<? echo $id[$i]; ?>"><? echo $fname[$i]; ?></option><?    
                                                    
                                                    }
                                                }
                                            }
                                                                        
                                        ?>
                                    </select>
                                </td>
                                <td><input type="submit" value="submit" name="submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </body>
   <?
}
?>



<?
if(isset($_POST['submit'])){
    header('LOCATION: Admin.php?task=finance&app=student_finance&info='.$_POST['student_id']);
}
?>


<?
if(isset($_POST['add'])){
    $school_fee = $_POST['school_fee'];
    $lesson_fee = $_POST['lesson_fee'];
    $boarding_fee = $_POST['boarding_fee'];
    $other_fee = $_POST['other_fee'];
    $id = $_POST['id'];
    $array = array(
        "School_fee" => $school_fee,
        "Lesson_fee" => $lesson_fee,
        "Boarding" => $boarding_fee,
        "Other_Fee" => $other_fee
    );
    $finance = json_encode($array);
    
    require_once('db_connect.php');
    $sql = "UPDATE Register SET Finance ='$finance' WHERE Student_ID = '$id'";
    $result = $conn->query($sql);
    if($result){
        header('LOCATION: Admin.php?task=finance&app=student_finance&info='.$id);
    }
}
?>

