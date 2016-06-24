<?
require_once('includes/Admin_cmsFunction.php');
class Hostel extends Admin_cmsFunction {
    public function index(){
        ?>
            <html>
                <body onload="hostel()">
                    <? include('html/Hostel.html'); ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-th-large">Hostels Management</span></div>
                        <div class="panel-body">
                            <table class="table table-hover" style="width:400px;">
                                <tr>
                                    <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-plus"></span>Room</a></td>
                                    <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-wrench"></span>Manage</a></td>
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
                                                    <div class="panel-heading"><span class="glyphicon glyphicon-plus"></span></div>
                                                    <div class ="panel-body">
                                                        <form method="POST" action="Admin.php?task=Hostel&app=save_hostel">
                                                            <table class="table table-hover">
                                                                <tr>
                                                                    <th>Room Number #</th><td><input type="text" name="room_no" required></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Select Building</th>
                                                                    <td>
                                                                        <select name="building">
                                                                            <option value="Block A">Block A</option>
                                                                            <option value="Block B">Block B</option>
                                                                            <option value="Block C">Block C</option>
                                                                            <option value="Block D">Block D</option>
                                                                            <option value="Block E">Block E</option>
                                                                            <option value="Block F">Block F</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Number of Space</th><td><input type="text" name="no_space" required></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Available Space</th><td><input type="text" name="avail_space" required></td>
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
                    
                    <div class="container">
                                <div class="modal fade" id="myModal2" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading"><span class="glyphicon glyphicon-wrench">Rooms</span></div>
                                                    <div class="panel-body">
                                                        <form method="POST" action="Admin.php?task=Hostel&app=manage_rooms">
                                                            <table class="table table-hover" >
                                                                <tr>
                                                                    <th>Select Building</th>
                                                                    <td>
                                                                        <select name="building" required>
                                                                            <option value="">---Select---</option>
                                                                            <option value="Block A">Block A</option>
                                                                            <option value="Block B">Block B</option>
                                                                            <option value="Block C">Block C</option>
                                                                            <option value="Block D">Block D</option>
                                                                            <option value="Block E">Block E</option>
                                                                            <option value="Block F">Block F</option>
                                                                        </select>
                                                                    </td>
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
    
    public function save_hostel(){
        if(isset($_POST['submit'])){
            $room_no = $_POST['room_no'];
            $block = $_POST['building'];
            $no_space = $_POST['no_space'];
            $avail_space = $_POST['avail_space'];
            $roomates = "";
            
            require_once('db_connect.php');
            $sql = "SELECT * FROM Hostels WHERE Block_Name = '$block' AND Room_No ='$room_no'";
            $check = $conn->query($sql);
            $row = mysqli_fetch_assoc($check);
            if(count($row)>0){
                echo 'Room Exist Please add Another';
            }else{
                $sql1 = "INSERT INTO Hostels (ID, Room_No, Block_Name, Space, Avail_Space, Students) VALUES
                ('Null', '$room_no', '$block', '$no_space', '$avail_space', '$roomates')";
                $result = $conn->query($sql1);
                if($result){
                    ?>
                        <body onload="hostel()">
                        <? include('html/Hostel.html'); ?>
                            <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                                <div class="panel heading"><span class="glyphicon glyphicon-ok"></span></div>
                                <div class="panel-body">
                                    Room Added
                                </div>
                            </div>
                        </body>
                    <?
                 }
            }
        }
    }
    
    public function select_room(){
        if(isset($_POST['submit'])){
            $student_id = $_POST['id'];
            $building  = $_POST['building'];
            ?>
                <body onload="hostel()">
                    <? include('html/Hostel.html'); ?>
                    <div class="panel panel-heading">
                        <div class="panel-heading"><span class="glyphicon glyphicon-th">Room</span></div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tr>
                                    <th>Select A Room From Building <? echo $building; ?></th>
                                    <td>
                                        <select>
                                            <?
                                                $search = array(
                                                      "class" => "search",
                                                      "method" => "list_rooms",
                                                      "params" => $building
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
                                                            $room_no = explode('*', $key['Room_No']);
                                                            $block_name = explode('*', $key['Block_Name']);
                                                            $space = explode('*', $key['Space']);
                                                            $students = explode('*', $key['Students']);
                                                            $avail_space = explode('*', $key['Avail_Space']); 
                                                            $k = count($id);
                                                            for($i=0; $i<=$k-1; $i++){
                                                            ?><option value="<? echo $id[$i]; ?>"><? echo $room_no[$i]; ?></option><?    
                                                            
                                                            }
                                                        }
                                                    }
                                             ?>
                                            
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                </body>
            <?
        }
    }
    
    public function manage_rooms(){
        if(isset($_POST['submit'])||isset($_REQUEST['building'])){
            $building = $_REQUEST['building']
            ?>
                <body onload="hostel()">
                    <? include('html/Hostel.html'); ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-th">Room</span></div>
                        <div class="panel-body">
                            <h4><? echo $building; ?></h4>
                            <table class="table table-hover">
                                <tr>
                                    <th>Room No.</th> <th>No of Space</th> <th>Available Space</th> <th>Occupants</th>
                                </tr>
                                <?
                                    $search = array(
                                          "class" => "search",
                                          "method" => "list_rooms",
                                          "params" => $building
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
                                        if(!$array==""){
                                            foreach($array as $key){
                                                error_reporting(E_ALL ^ E_NOTICE);
                                                $id = explode('*', $key['ID']);
                                                $room_no = explode('*', $key['Room_No']);
                                                $block_name = explode('*', $key['Block_Name']);
                                                $space = explode('*', $key['Space']);
                                                $students = explode('*', $key['Students']);
                                                $avail_space = explode('*', $key['Avail_Space']); 
                                                $k = count($id);
                                                for($i=0; $i<=$k-2; $i++){
                                                
                                                    $manage_room = '<a href="Admin.php?task=Hostel&app=manage_room&id='.$id[$i].'"><span class="glyphicon glyphicon-wrench"></span></a>';
                                                    $room = $block_name[$i].'-'.$room_no[$i];
                                                    ?>
                                                    <tr>
                                                        <td><? echo $room_no[$i]; ?></td><td><? echo $space[$i]; ?></td><td><? echo $avail_space[$i]; ?></td>
                                                        
                                                        <td>
                                                            <?
                                                            $delete_room='<a href="Admin.php?task=Hostel&app=delete_room&room='.$room.'&id='.$id[$i].'"><span class="glyphicon glyphicon-remove"></span></a>';
                                                            $roomates = array();
                                                            $room= $block_name[$i].'-'.$room_no[$i];
                                                            require_once('db_connect.php');
                                                            $sql = "SELECT Name FROM Register WHERE Room_No ='$room'";
                                                            $result =$conn->query($sql);
                                                            if($result){   
                                                                while($row=mysqli_fetch_assoc($result)){
                                                                    foreach($row as $key => $value){
                                                                        //$roomates[$key] .=$value.'*';
                                                                        ?><span style="color: red; "><? echo $value; ?></span><br><?
                                                                    }
                                                                }
                                                                
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                        <? echo $manage_room; ?>
                                                        </td>
                                                        <td>
                                                        <? echo $delete_room; ?>
                                                        </td>
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
            <?
            
        }
    }
    public function delete_room(){
        if(isset($_REQUEST['id'])){
            $room_id = $_REQUEST['id'];
            $room = $_REQUEST['room'];
            require_once('db_connect.php');
            $sql = "DELETE FROM Hostels WHERE ID = '$room_id' ";
            $sql2 = "UPDATE Register SET Room_No = 'Boarding' WHERE Room_No = '$room'";
            $result =$conn->query($sql);
            $result2 = $conn ->query($sql2);
            if($result){
                if($result2){
                    ?>
                        <body onload="hostel()">
                        <? include('html/Hostel.html'); ?>
                            <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                                <div class="panel heading"><span class="glyphicon glyphicon-ok"></span></div>
                                <div class="panel-body">
                                    Delete Room <? echo $room; ?>
                                </div>
                            </div>
                        </body>
                    <?
                }
            }
        }
    }
    
    public function assign_room(){
        if(isset($_REQUEST['id'])){
             $room_id = $_REQUEST['id'];
            require_once('db_connect.php');
            $sql = "SELECT * FROM Hostels WHERE ID = '$room_id' ";
            $result =$conn->query($sql);
            if($result){
                $row =mysqli_fetch_assoc($result);
                $k = $row['Space'];
                $no_student= $row['Students'];
                $avail_space = $row['Avail_Space'];
                if($avail_space > 0){
                    ?>
                        <body onload="hostel()">
                            <? include('html/Hostel.html'); ?>
                            <div class="panel panel-primary">
                                <div class="panel-heading">Assign Room</div>
                                <div class="panel-body">
                                    <form method="POST" action="Admin.php?task=Hostel&app=assign_student_hostel">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Block Name</th> <td><? echo $row['Block_Name'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Room No.</th> <td><? echo $row['Room_No'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Space</th> <td><? echo $row['Space'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Available Space</th> <td><? echo $row['Avail_Space'];?></td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Choose Student To Add To Room
                                                </th>
                                                <td>
                                                    <select name="student" required>
                                                        <option value="">---Select Student---</option>
                                                            <?
                                                                $search = array(
                                                                      "class" => "search",
                                                                      "method" => "list_Student_Room",
                                                                      "params" => "Boarding"
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
                                                                    if(!$array==""){
                                                                        foreach($array as $key){
                                                                            error_reporting(E_ALL ^ E_NOTICE);
                                                                            $id = explode('*', $key['ID']);
                                                                            $name= explode('*', $key['Name']);
                                                                            $student_id = explode('*', $key['Student_ID']);
                                                                            echo $kt = count($id);
                                                                            for($j=0; $j<=$kt-1; $j++){
                                                                                ?><option value="<? echo $student_id[$j]; ?>"><? echo $name[$j]; ?></option><?
                                                                            }
                                                                            
                                                                        }
                                                                    }
                                                            ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr><th><input type="hidden" name="id" value="<? echo $room_id; ?>"><input type="hidden" name="space" value="<? echo $k; ?>"></th><td><input type="submit" name="submit" value="submit"></td></tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </body>
                    <?
                }else{
                    ?>
                        <body onload="hostel()">
                        <? include('html/Hostel.html'); ?>
                            <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                                <div class="panel heading"><span class="glyphicon glyphicon-remove"></span></div>
                                <div class="panel-body">
                                    Out of Capacity
                                </div>
                            </div>
                        </body>
                    <?
                    }
            }
            
        }
        
    }
    public function assign_student_hostel(){
        if(!$_POST['student']==""){
            $id = $_POST['id'];
            $student = $_POST['student'];
            require_once('db_connect.php');
            $sql = "SELECT * FROM Hostels WHERE ID = '$id' ";
            $result =$conn->query($sql);
            if($row=mysqli_fetch_assoc($result)){
                $avail_space = $row['Avail_Space'];
                $room= $row['Block_Name'].'-'.$row['Room_No'];
                $no_space = $avail_space-1;
                $sql="UPDATE Register SET Room_No ='$room' WHERE Student_ID ='$student' ";
                $sql1 = "UPDATE Hostels SET Avail_Space ='$no_space' WHERE ID='$id'";
                $result = $conn->query($sql);
                $result1 = $conn->query($sql1);
                if($result && $result1){
                    ?><a href="Admin.php?task=Hostel&app=manage_rooms&building=<? echo $row['Block_Name']; ?>">Return Back</a><?
                }else{
                    echo 'Failed';
                }
            }else{ echo 'Failed' ;}
        
        }
    }
    
    public function manage_room(){
        if(isset($_REQUEST['id'])){
            $room_id = $_REQUEST['id'];
            require_once('db_connect.php');
            $sql = "SELECT * FROM Hostels WHERE ID = '$room_id' ";
            $result =$conn->query($sql);
            if($row=mysqli_fetch_array($result)){
                $roomates = $row['Students'];
                $room = $row['Block_Name'].'-'.$row['Room_No'];
                ?>
                    <body onload="hostel()">
                        <? require_once('html/Hostel.html'); ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading"> Manage Room</div>
                            <div class="panel-body">
                                <? echo $assign_room='<a href="Admin.php?task=Hostel&app=assign_room&id='.$row['ID'].'"><span class="glyphicon glyphicon-plus">Student</span></a>';?>
                                <table class="table table-hover">
                                    <tr>
                                        <th>Block Name</th> <td><? echo $row['Block_Name'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Room No.</th> <td><? echo $row['Room_No'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Space</th> <td><? echo $row['Space'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Available Space</th> <td><? echo $row['Avail_Space'];?></td>
                                    </tr>
                                    <?
                                        $search = array(
                                                        "class" => "search",
                                                        "method" => "list_Student_Room",
                                                        "params" => $room
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
                                        if(!$array==""){
                                            foreach($array as $key){
                                                error_reporting(E_ALL ^ E_NOTICE);
                                                $id = explode('*', $key['ID']);
                                                $name= explode('*', $key['Name']);
                                                $student_id = explode('*', $key['Student_ID']);
                                                $kt = count($id);
                                                $k=0;
                                                for($j=0; $j<=$kt-2; $j++){
                                                    $k++;
                                                    $delete ='<a href="Admin.php?task=Hostel&app=delete_roomate&student_id='.$id[$j].'&room_id='.$room_id.'"><span class="glyphicon glyphicon-remove"></span></a>';
                                                    ?>
                                                        <tr>
                                                            <th> Roomate <? echo $k;?></th> <td><? echo $name[$j]; ?></td><td><? echo $delete; ?></td>
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
                <?
            }
            
        }
    }
    
    public function delete_roomate(){
        if(isset($_REQUEST['room_id'])){
            $room_id = $_REQUEST['room_id'];
            $student_id = $_REQUEST['student_id'];
            require_once('db_connect.php');
            $sql = "SELECT * FROM Hostels WHERE ID = '$room_id' ";
            $result =$conn->query($sql);
            if($row=mysqli_fetch_assoc($result)){
                $avail_space = $row['Avail_Space'];
                $room="Boarding";
                $no_space = $avail_space+1;
                $sql="UPDATE Register SET Room_No ='$room' WHERE ID ='$student_id' ";
                $sql1 = "UPDATE Hostels SET Avail_Space ='$no_space' WHERE ID='$room_id'";
                $result = $conn->query($sql);
                $result1 = $conn->query($sql1);
                if($result && $result1){
                    ?><a href="Admin.php?task=Hostel&app=manage_rooms&building=<? echo $row['Block_Name']; ?>">Return Back</a><?
                }else{
                    echo 'Failed';
                }
            }else{ echo 'Failed' ;}
            
        }
        
    }
    
//End    
}
?>