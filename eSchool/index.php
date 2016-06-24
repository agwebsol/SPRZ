<?
   if(isset($_REQUEST['user'])){
      $user = $_REQUEST['user'];
      header('LOCATION:login_'.$user.'.php');
   }
      
?>
   <html>
      <head>
         <title>School Management System By ArriGold Group </title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="css/Teacher.css">
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="validateForm.js"></script>
      </head>
      <body>
         <div>
            <div class="panel panel-primary" style="width:450px; margin-left:400px; margin-top: 200px;">
               <div class="panel-heading"><span class="glyphicon glyphicon-log-in"></span> School Management System By ArriGold Group </div>
               <div class="panel-body">
                  <table class="table table-hover" style="width: 400px;">
                     <tr>
                        <th><a role="button" href="Admin.php"><span class="glyphicon glyphicon-cog">Administrator</span></a></th>
                     </tr>
                     <tr>
                        <th><a role="button" href="login_teacher.php"><span class="glyphicon glyphicon-user">Teacher</span></a></th>
                     </tr>
                     <tr>
                        <th><a role="button" href="login_student.php"><span class="glyphicon glyphicon-education">Student</span></a></th>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
      </body>
   </html>



   
