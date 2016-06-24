<?
require_once('includes/Admin_cmsFunction.php');
    class finance extends Admin_cmsFunction {
        public function index(){
            ?>
                <body onload="finance()">
                    <? include('html/finance.html');?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-file">Finance</span></div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>
                                        <form name="form" method="POST" action="">
                                            <select onchange="search(this.value)">
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
                                        </form>
                                    </td>
                                </tr>
                            </table>
                            <div id="search">
                                
                            </div>
                            <script>
                                function search(k) {
                                    if (window.XMLHttpRequest) {
                                        xmlhttp = new XMLHttpRequest();
                                        } else {
                                           xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                        }
                                        xmlhttp.onreadystatechange = function() {
                                           if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                              document.getElementById("search").innerHTML = xmlhttp.responseText;
                                           }
                                        };
                                        xmlhttp.open("GET","finance.php?class="+k, true);
                                        xmlhttp.send();
                                    
                                }
                            </script>
                        </div>
                    </div>
                </body>
            <?
        }
      
      public function student_finance(){
        $id = $_REQUEST['info'];
        require_once('db_connect.php');
        $sql = "SELECT * FROM Register WHERE Student_ID = '$id'";
        $result = $conn->query($sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $finance = json_decode($row['Finance'], TRUE);
            
            ?>
                <body onload="finance()">
                    <? include('html/finance.html');?>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><? echo $row['Name']; ?> Reciept Payment</div>
                        <div class="panel-body">
                            <?
                                if(count($finance)>0){
                                    ?>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>School Fees</th>
                                                <td><? echo $finance['School_fee']?></td>
                                            </tr>
                                            <tr>
                                                <th>Lesson Fees</th>
                                                <td><? echo $finance['Lesson_fee']?></td>
                                            </tr>
                                            <tr>
                                                <th>Boarding Fees</th>
                                                <td><? echo $finance['Boarding']?></td>
                                            </tr>
                                            <tr>
                                                <th>Other Fees</th>
                                                <td><? echo $finance['Other_Fee']?></td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>
                                                    <a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-edit">Edit</span></a>
                                                        <div class="container">
                                                            <div class="modal fade" id="myModal1" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="panel panel-primary">
                                                                                <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-plus"></span>Reciept</h4></div>
                                                                                <div class="panel-body">
                                                                                    <form method="POST" action="finance.php">
                                                                                        <table class="table table-hover">
                                                                                            <tr>
                                                                                                <th>School Fees</th>
                                                                                                <td><input type="text" name="school_fee" value="<? echo $finance['School_fee']; ?>"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Lesson Fees</th>
                                                                                                <td><input type="text" name="lesson_fee" value="<? echo $finance['Lesson_fee']; ?>"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Boarding Fees</th>
                                                                                                <td><input type="text" name="boarding_fee" value="<? echo $finance['Boarding']; ?>"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>Other Fees</th>
                                                                                                <td><input type="text" name="other_fee" value="<? echo $finance['Other_Fee']; ?>"></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th><input type="hidden" value="<? echo $id; ?>" name="id"></th>
                                                                                                <td><input type="submit" name="add" value="Create"></td>
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
                                                </td>
                                            </tr>
                                        </table>
                                    <?
                                }else{
                                    ?>
                                        <a role="button" class="btn btn btn-xs" data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-plus">Reciept</span></a>
                            
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
                                                                    <form method="POST" action="finance.php">
                                                                        <table class="table table-hover">
                                                                            <tr>
                                                                                <th>School Fees</th>
                                                                                <td><input type="text" name="school_fee"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Lesson Fees</th>
                                                                                <td><input type="text" name="lesson_fee"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Boarding Fees</th>
                                                                                <td><input type="text" name="boarding_fee"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Other Fees</th>
                                                                                <td><input type="text" name="other_fee"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th><input type="hidden" value="<? echo $id; ?>" name="id"></th>
                                                                                <td><input type="submit" name="add" value="Create"></td>
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
                </body>
            <?
        }
      }
      
      
      
        
 //ENd       
    }
?>

