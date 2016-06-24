<?
session_start();
?>
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
            <div class="panel panel-info" style="width: 450px; margin-left: 350px; margin-top: 150px;">
                <div class="panel-heading"><span class="glyphicon glyphicon-user">Teacher</span></div>
                <div class="panel-body">
                    <form method="POST" action="login_teacher.php">
                        <table class="table table-hover" style="width:400px;">
                            <tr>
                                <th>Username</th><td><input type="text" name="username" required></td>
                            </tr>
                            <tr>
                                <th>Password</th><td><input type="password" name="password" required></td>
                            </tr>
                            <tr>
                                <th><? if(isset($_REQUEST['login'])){ echo '<h6>Incorrect Username and Password</h6>'; }?></th><td><input type="submit" name="submit" value="LOGIN"></td>
                            </tr>
                            <tr>
                                <th><a href="index.php">Back</a></th>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </body>
    </html>
<?


    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash= base64_encode($username.$password);
        require_once('db_connect.php');
        $sql = "SELECT * FROM Teacher_Table WHERE User_Login = '$hash' ";
        $result = $conn->query($sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['teacher_id'] = $row['User_ID'];
            $_SESSION['Teacher_Name'] = $row['Name'];
            $_SESSION['Class_Admin'] = $row['Class_Admin'];
            $_SESSION['Permission'] = $row['Permission'];
            $_SESSION['Subject_Admin'] = $row['Subject_Admin'];
            header('LOCATION: Teacher.php');
            }

    }
    
    if(isset($_REQUEST['logout'])){
        session_destroy();
        header('LOCATION:Teacher.php');
    }
?>

                        
                        