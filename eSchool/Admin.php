<?php
session_start();
require_once('includes/Admin_control.php');
$tmpl = new Admin_control();
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>School Management System</title>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="css/Admin.css">
                    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        </head>
        
        <body>
            <div id="main">
                <header>
                    <nav class="navbar navbar navbar-fixed-top" style="background-color:#2E9AFE;">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home">Grace-High</span></a>
                            </div>
                                <ul class="nav navbar-nav">
                                    <li style="padding-top: 15px;">
                                    </li>
                                </ul>
                                
                        </div>
                    </nav>
                </header>
                <div id="side_navbar" style="background-color:#D8D8D8;">
                    <table >
                        <tr id="academics">
                            <th>
                                <a href="Admin.php" style="list-style: none; text-decoration:none">
                                    <div id="academics" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
                                        <span style="padding-left: 50px;"> <span class="glyphicon glyphicon-home"> Home</span></span>
                                    </div>
                                </a>
                            </th>
                        </tr>
                        <tr id="staff">
                            <th>
                                <a href="Admin.php?task=Staff&app=index" style="list-style: none; text-decoration:none">
                                    <div id="staff" style=" width: 200px; height: 100px; border-radius: 5px; padding-top: 35px;">
                                        <span style="padding-left: 50px;"><span class="glyphicon glyphicon-user"> Staffs</span></span>
                                    </div>
                                </a>
                            </th>
                        </tr>
                        <tr id="finance">
                            <th>
                                <a href="Admin.php?task=finance&app=index" style="list-style: none; text-decoration:none">
                                    <div id="finance" style="margin-left: 0px;  width: 200px; height: 100px; padding-top: 35px;">
                                        <span style="padding-left: 50px;"> <span class="glyphicon glyphicon-piggy-bank"> Finance</span></span>
                                    </div>
                                </a>
                            </th>
                        </tr>
                        <tr id="student">
                            <th>
                                <a href="Admin.php?task=Student&app=index" style="list-style: none; text-decoration:none">
                                    <div id="student" style=" width: 200px; height: 100px; border-radius: 5px; padding-top: 35px;">
                                        <span style="padding-left: 50px;"><span class="glyphicon glyphicon-education"> Students</span></span>
                                    </div>
                                </a>
                            </th>
                        </tr>
                        <tr id="hostel">
                            <th>
                                <a href="Admin.php?task=Hostel&app=index" style="list-style: none; text-decoration:none">
                                    <div id="hostel" style=" width: 200px; height: 100px; border-radius: 5px; padding-top: 35px;">
                                        <span style="padding-left: 50px;"><span class="glyphicon glyphicon-bed"> Hostels</span></span>
                                    </div>
                                </a>
                            </th>
                        </tr>
                        <tr id="bus">
                            <th>
                                <a href="Admin.php?task=Bus&app=index" style="list-style: none; text-decoration:none">
                                    <div id="bus" style=" width: 200px; height: 100px; border-radius: 5px; padding-top: 35px;">
                                        <span style="padding-left: 50px;"><span class="glyphicon glyphicon-road"> Vehicle</span></span>
                                    </div>
                                </a>
                            </th>
                        </tr>
                        
                        
                        
                    </table>
                </div>
                <div id="mid_content" id="mid_content">
                    <?php $tmpl->Admin_method(); ?>
                </div>
                <div id="footer_bar">
                    The 
                </div>
                
            </div>
        </body>
    </html>
