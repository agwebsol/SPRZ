<?
require_once('includes/Admin_cmsFunction.php');
class Bus extends Admin_cmsFunction {
    public function index(){
        ?>
            <html>
                <body onload="bus()">
                    <? include('html/Bus.html'); ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> Vehicle Management</div>
                        <div class ="panel-body">
                            <table class="table table-hover" style="width: 400px;">
                                <tr>
                                    <td><a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-plus"></span>Vehicle</a></td>
                                    <td><a role="button" href="Admin.php?task=Bus&app=manage_bus"><span class="glyphicon glyphicon-cog">View/Manage</span></a></td>
                                    <td><a role="button"href="Admin.php?task=Bus&app=assign_student"><span class="glyphicon glyphicon-user">Student</span></a></td>
                                </tr>
                            </table>
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
                                                    <div class="panel-heading"><span class="glyphicon glyphicon-plus"></span></div>
                                                    <div class="panel-body">
                                                        <form method="POST" action="Admin.php?task=Bus&app=save_bus">
                                                            <table class="table table-hover" >
                                                               <tr>
                                                                    <th>Bus Plate No.</th><td><input type="text" name="plate_no" required></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Driver.</th><td><input type="text" name="driver" required></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Number Of Seaters.</th><td><input type="text" name="seaters" required ></td>
                                                                </tr>
                                                                <tr>
                                                                    <th></th><td><input type="submit" name="submit" value="submit" ></td>
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
    
    public function save_bus(){
        if(isset($_POST['submit'])){
                $plate_no = $_POST['plate_no'];
                $driver = $_POST['driver'];
                $seaters = $_POST['seaters'];
                require_once('db_connect.php');
                $sql= "SELECT * FROM School_bus WHERE Plate_No ='$plate_no'";
                $result=$conn->query($sql);
                $row = mysqli_fetch_assoc($result);
                if(!count($row)>0){
                    $sql1 = "INSERT INTO School_Bus (ID,Plate_No, Driver, No_Seaters) VALUES ('NULL', '$plate_no', '$driver', '$seaters')";
                    $result1=$conn->query($sql1);
                    if($result1){
                        ?>
                        <body onload="bus()">
                        <? include('html/Bus.html'); ?>
                            <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                                <div class="panel heading"><span class="glyphicon glyphicon-ok"></span></div>
                                <div class="panel-body">
                                    School Bus Added To Database
                                </div>
                            </div>
                        </body>
                    <?
                    }else{ echo 'Failed';}
                }else{
                    ?>
                        <body onload="bus()">
                        <? include('html/Bus.html'); ?>
                            <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                                <div class="panel heading"><span class="glyphicon glyphicon-ok"></span></div>
                                <div class="panel-body">
                                    School Bus Already Added To Database
                                </div>
                            </div>
                        </body>
                    <?
                    
                }
                
                
            }
    }
    
    public function assign_student(){
        require_once('db_connect.php');
            $sql ="SELECT Plate_No FROM School_Bus ";
            $result=$conn->query($sql);
            if($result){
                ?>
                    <body onload="bus()">
                        <? include('html/Bus.html'); ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading"><span class="glyphicon glyphicon-plus"></span></div>
                            <div class="panel-body">
                                <form method="POST" action="Admin.php?task=Bus&app=add_to_bus">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Select Bus</th><th>Select Student</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select name="bus" required>
                                                    <option value="">---Select---</option>
                                                    <?
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            foreach($row as $value){
                                                               ?>
                                                                    <option value="<? echo $value; ?>"><? echo $value; ?></option>
                                                               <? 
                                                            }
                                        
                                                        }
                                              
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="student" required>
                                                    <option value="">---Select---</option>
                                                    <?
                                                        $search = array(
                                                                      "class" => "search",
                                                                      "method" => "list_Student_Room",
                                                                      "params" => "DAY"
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
                                        <tr>
                                            <th></th><td><input type="submit" name="submit" value="submit"></td>
                                        </tr>
                                        
                                    </table>
                                </form>
                            </div>
                        </div>
                    </body>
                <?
                
            }
    }
    
        public function add_to_bus(){
            if(!$_POST['student']==""){
                $student_id = $_POST['student'];
                $plate_no = $_POST['bus'];
                $room_no = 'Bus';
                require_once('db_connect.php');
                $sql = "UPDATE Register SET Room_No='$room_no', Bus_Info ='$plate_no' WHERE Student_ID ='$student_id'";
                $result = $conn->query($sql);
                if($result){
                    ?>
                        <body onload="bus()">
                        <? include('html/Bus.html'); ?>
                            <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                                <div class="panel heading"><span class="glyphicon glyphicon-ok"></span></div>
                                <div class="panel-body">
                                   Student Added to Bus <? echo $plate_no; ?>
                                </div>
                            </div>
                        </body>
                    <?
                }
            }else{header('LOCATION: Admin.php');}
        }
        
        public function manage_bus(){
            ?>
                <body onload="bus()">
                    <? include('html/Bus.html'); ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-cog">Manage Vehicle</span></div>
                        <div class="panel-body">
                            <form method="POST" action ="Admin.php?task=Bus&app=manage_bus">
                                <table class ="table table-hover">
                                    <tr>
                                        <th>Select Bus To Manage</th>
                                        <td>
                                            <select name="plate_no" required>
                                                <option value="">---Select---</option>
                                                <?
                                                    require_once('db_connect.php');
                                                    $sql ="SELECT Plate_No FROM School_Bus ";
                                                    $result=$conn->query($sql);
                                                    while($row = mysqli_fetch_assoc($result)){
                                                            foreach($row as $value){
                                                               ?>
                                                                    <option value="<? echo $value; ?>"><? echo $value; ?></option>
                                                               <? 
                                                            }
                                        
                                                        }
                                                ?>
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
                </body>
            <?
            
            if(isset($_POST['submit'])){
                ?>
                    <body onload="bus()">
                        <? include('html/Bus.html'); ?>
                        <div class="panel panel-primary">
                            <div class="panel-heading"><span class="glyphicon glyphicon-scale"></span></div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Students Assigned To Bus <? echo $_POST['plate_no']; ?></th>
                                    </tr>
                                    <?
                                        $plate_no = $_POST['plate_no'];
                                        require_once('db_connect.php');
                                        $sql = "SELECT Name FROM Register WHERE Bus_Info ='$plate_no'";
                                        $result = $conn->query($sql);
                                        if($result){
                                            while($row=mysqli_fetch_assoc($result)){
                                                foreach($row as $value){
                                                    $delete = '<a href="Admin.php?task=Bus&app=manage_bus&name='.$value.'"><span class="glyphicon glyphicon-remove"></span></a>';
                                                   ?>
                                                        <tr>
                                                            <td><? echo $value; ?></td><td><? echo $delete; ?></td>
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
            
            if(isset($_REQUEST['name'])){
                $bus_info = " ";
                $name = $_REQUEST['name'];
                $room_no = 'Day';
                require_once('db_connect.php');
                $sql ="UPDATE Register SET Room_No='$room_no', Bus_Info = '$bus_info' WHERE Name='$name'";
                $result = $conn->query($sql);
                if($result){
                    ?>
                        <body onload="bus()">
                        <? include('html/Bus.html'); ?>
                            <div class="panel panel-primary" style="width:300px; margin-left: 200px; margin-top: 50px;">
                                <div class="panel heading"><span class="glyphicon glyphicon-ok"></span></div>
                                <div class="panel-body">
                                    Updated The Database
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