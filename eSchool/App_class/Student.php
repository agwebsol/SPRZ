<?
require_once('includes/Admin_cmsFunction.php');
class Student extends Admin_cmsFunction {
    public function index(){
        ?>
            <html>
                <body onload="student()">
                    <? require_once('html/Student.html'); ?>
                    <div style="margin-top:1px; ">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><span class="glyphicon glyphicon-education"></span> Student Management</div>
                            <div class="panel-body">
                                <table class="table table-hover" style="color:BLACK; width: 400px;">
                                    <tr>
                                        <td><a role="button"  data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-plus">Student</span></a></td>
                                        <td><a role="button"  data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-th-list">List</span></a></td>
                                        <td><a role="button"  data-toggle="modal" data-target="#myModal3"><span class="glyphicon glyphicon-wrench">Grades </span></a></td>
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
                                                        <div class="panel-heading"><span class="glyphicon glyphicon-plus"></span>New Registration</div>
                                                        <div class="panel-body">
                                                            <form enctype="multipart/form-data" method="POST" action="Admin.php?task=register_exe&app=register">
                                                            <table class="table table-hover"  style="width:100%; margin-left:0px;">
                                                                <tr><th>Student Firstname<span style="color: red;">*</span></th><td><input type="text" name="fname" required></td></tr>
                                                                <tr><th>Student Surname <span style="color: red;">*</span></th><td><input type="text" name="sname" required></td></tr>
                                                                <tr><th>Date Of Birth<span style="color: red;">*</span></th><td><input type="date" name="dob" required></td></tr>
                                                                <tr><th>Address</th><td><textarea name="address"></textarea></td></tr>
                                                                <tr><th>State Of Origin</th><td><input type="text" name="state"></td></tr>
                                                                <tr><th>Nationality</th><td><input type="text" name="nation"></td></tr>
                                                                <tr><th>L.G.A</th><td><input type="text" name="lga"></td></tr>
                                                                <tr><th>Religion</th><td><input type="text" name="rel"></td></tr>
                                                                <tr><th>Student ID <span style="color: red;">*</span></th><td><input type="hidden" name="add_no" required></td></tr>
                                                                <tr>
                                                                    <th>Gender <span style="color: red;">*</span></th>
                                                                    <td>
                                                                        <select name="gender" required>
                                                                            <option value="">---Select---</option>
                                                                            <option value="Male">Male</option>
                                                                            <option value="Female">Female</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Class <span style="color: red;">*</span></th>
                                                                    <td>
                                                                        <select name="class" required >
                                                                            <option value="">---Select---</option>
                                                                            <option value="kG 1">KG 1</option>
                                                                            <option value="kG 2">KG 2</option>
                                                                            <option value="kG 3">KG 3</option>
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
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Subclass <span style="color: red;">*</span></th>
                                                                    <td>
                                                                        <select name="subclass" required>
                                                                            <option value="">---Select---</option>
                                                                            <option value="A">A</option>
                                                                            <option value="B">B</option>
                                                                            <option value="C">C</option>
                                                                            <option value="D">D</option>
                                                                            <option value="E">E</option>
                                                                            <option value="F">F</option>
                                                                            <option value="G">G</option>
                                                                            <option value="H">H</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Term <span style="color: red;">*</span></th>
                                                                        <td>
                                                                            <select name="term">
                                                                                <option value="">---Select---</option>
                                                                                <option value="Term1">1st Term</option>
                                                                                <option value="Term2">2nd Term</option>
                                                                                <option value="Term3">3rd Term</option>
                                                                            </select>
                                                                        </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Section <span style="color: red;">*</span></th>
                                                                        <td>
                                                                            <select name="session" required>
                                                                                <option value="">---Select---</option>
                                                                                <option value="14-15">2014/2015</option>
                                                                                <option value="15-16">2015/2016</option>
                                                                                <option value="16-17">2016/2017</option>
                                                                            </select>
                                                                        </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Accomodation <span style="color: red;">*</span></th>
                                                                    <td>
                                                                        <select name="accom">
                                                                            <option value="">---Select---</option>
                                                                            <option value="Day">DAY</option>
                                                                            <option value="Boarding">BOARDING</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Student Picture</th><td><input type="file" name="image"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Status</th>
                                                                    <td>
                                                                        <select name="status">
                                                                            
                                                                            <option value="Active">Active</option>
                                                                            <option value="In-active">In-active</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr><th>Parent Name</th><td><input type="text" name="pname"></td></tr>
                                                                <tr><th>Parent Address</th><td><input type="text" name="padd"></td></tr>
                                                                <tr><th>Phone No.</th><td><input type="text" name="parent_phone"></td></tr>
                                                                <tr><th>Email</th><td><input type="text" name="pemail"></td></tr>
                                                                <tr><th>Emergency Contact</th><td><input type="text" name="emrcontact"></td></tr>
                                                                <tr>
                                                                <th><input type="submit" name="submit" value="Register"></th>
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
                                                    <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-list"></span> List Student</h4></div>
                                                    <div class="panel-body">
                                                    <form method="POST" action="Admin.php?task=view_student&app=student">
                                                        <table class="table table-hover" >
                                                        <tr>
                                                                <th>Class <span style="color: red;">*</span></th>
                                                                <td>
                                                                    <select name="class" required >
                                                                        <option value="">---Select---</option>
                                                                        <option value="kG 1">KG 1</option>
                                                                        <option value="kG 2">KG 2</option>
                                                                        <option value="kG 3">KG 3</option>
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
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Subclass <span style="color: red;">*</span></th>
                                                                <td>
                                                                    <select name="subclass" required>
                                                                        <option value="">---Select---</option>
                                                                        <option value="A">A</option>
                                                                        <option value="B">B</option>
                                                                        <option value="C ">C</option>
                                                                        <option value="D">D</option>
                                                                        <option value="E">E</option>
                                                                        <option value="F">F</option>
                                                                        <option value="G">G</option>
                                                                        <option value="H">H</option>
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
                            
                            
                            <div class="container">
                                <div class="modal fade" id="myModal3" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                               <div class="panel panel-primary">
                                                    <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-wrench"></span> Student Report Card</h4></div>
                                                    <div class="panel-body">
                                                        <form method ="POST" action ="Admin.php?task=manage_grade&app=grade">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>Class <span style="color: red;">*</span></th>
                                                            <td>
                                                                <select name="class" required >
                                                                    <option value="">---Select---</option>
                                                                    <option value="kG 1">KG 1</option>
                                                                    <option value="kG 2">KG 2</option>
                                                                    <option value="kG 3">KG 3</option>
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
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Term <span style="color: red;">*</span></th>
                                                                <td>
                                                                    <select name="term">
                                                                        <option value="">---Select---</option>
                                                                        <option value="Term1">1st Term</option>
                                                                        <option value="Term2">2nd Term</option>
                                                                        <option value="Term3">3rd Term</option>
                                                                    </select>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Section <span style="color:red;">*</span></th>
                                                                <td>
                                                                    <select name="session" required>
                                                                        <option value="">---Select---</option>
                                                                        <option value="15-16">2015/2016</option>
                                                                        <option value="16-17">2016/2017</option>
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
                            
                            
                            
                            
                    </div>
                </body>
            </html>
        <?
    }
    
//End    
}
?>
