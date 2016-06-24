<?
session_start();
require_once('includes/Student_control.php');
$tmpl = new Student_control();
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
                    <nav class="navbar navbar navbar-fixed-top" style="background-color:#8181F7; color:white;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="Student.php"><span style="font-size: 15px; color: white;"><span class="glyphicon glyphicon-user"></span></span><? echo $_SESSION['Student_Name']; ?></a>
                            </div>
                                <ul class="nav navbar-nav">
                                    <li style="padding-left: 800px;"><a href="login_student.php?logout=yes"><span class="glyphicon glyphicon-log-out">Logout</span></a></li>
                                </ul>
                        </div>
                    </nav>
                </header>
                
                <div id="side_navbar" style="margin-top: 40px;">
                    <table class="table table-hover">
                       <tr>
                            <td id="home">
                                <a href="Student.php?">
                                    <div id="home" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
                                            <span style="padding-left: 50px;"> <span class="glyphicon glyphicon-home"> Home</span></span>
                                    </div>
                                </a>
                            </td>
                       </tr>
                        <tr>
                            <td id="report">
                                <a href="Student.php?task=Student_Index&app=view_report">
                                    <div id="report" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
                                            <span style="padding-left: 50px;"> <span class="glyphicon glyphicon-cog"> Report Card</span></span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                       <tr>
                            <td id="account">
                                <a href="Student.php?task=Student_Index&app=account">
                                    <div id="attendance" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
                                            <span style="padding-left: 50px;"> <span class="glyphicon glyphicon-calendar"> Account</span></span>
                                    </div>
                                    
                                </a>
                            </td>
                       </tr>
                       <tr>
                            <td id="notes">
                                <a href="Student.php?task=Student_Index&app=notes">
                                    <div id="notes" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
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