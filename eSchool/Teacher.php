<?
session_start();
require_once('includes/Teacher_control.php');
$tmpl = new Teacher_control();
$tmpl->authorize();
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>School Management System</title>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" type="text/css" href="css/Teacher.css">
                    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
                    <script src="validateForm.js"></script>
        </head>
        <body>
            <div id="main">
                 <header>
                    <nav class="navbar navbar navbar-fixed-top" style="background-color:#084B8A; color:white;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="Teacher.php"><span style="font-size: 15px; color: white;"><span class="glyphicon glyphicon-user"></span> <? echo $_SESSION['Teacher_Name']; ?></span></a>
                            </div>
                                <ul class="nav navbar-nav">
                                    <li style="padding-top:12px; padding-left: 100px; ">
                                        <form name="search" method="POST" action="Teacher.php?task=Teacher_index&app=view_by_class">
                                            <select name="class" required >
                                                 <option value="">---Select---</option>
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
                                            <span style="color: black;"><input type="submit" name="submit" value="search"></span>
                                         </form>
                                    </li>
                                    <li style="padding-left: 500px;"><a href="login_teacher.php?logout=yes"><span class="glyphicon glyphicon-log-out">Logout</span></a></li>
                                </ul>
                        </div>
                    </nav>
                </header>
                
                <div id="side_navbar" style="margin-top: 40px;">
                    <table class="table table-hover">
                       <tr>
                            <td id="home">
                                <a href="Teacher.php?">
                                    <div id="home" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
                                            <span style="padding-left: 50px;"> <span class="glyphicon glyphicon-home"> Home</span></span>
                                    </div>
                                </a>
                            </td>
                       </tr>
                        <tr>
                            <td id="report">
                                <a href="Teacher.php?task=Teacher_index&app=manage_grade">
                                    <div id="report" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
                                            <span style="padding-left: 50px;"> <span class="glyphicon glyphicon-cog"> Report</span></span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                       <tr>
                            <td id="attendance">
                                <a href="Teacher.php?task=Teacher_index&app=manage_attendance">
                                    <div id="attendance" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
                                            <span style="padding-left: 50px;"> <span class="glyphicon glyphicon-calendar"> Attendance</span></span>
                                    </div>
                                    
                                </a>
                            </td>
                       </tr>
                       <tr>
                            <td id="lesson_note">
                                <a href="Teacher.php?task=lesson_note&app=index">
                                    <div id="attendance" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
                                            <span style="padding-left: 50px;"> <span class="glyphicon glyphicon-book"> Notes/Assignment</span></span>
                                    </div>
                                    
                                </a>
                            </td>
                       </tr>
                       
                       
                    </table>
                    
                </div>
                <div id="mid_content" style="background-color: WHITE; padding-left: 20px; padding-top:10px;">
                    <?php $tmpl->index(); ?>
                </div>
                <div id="footer_bar">
                    
                </div>
                
            </div>
        </body>
    </html>
    
