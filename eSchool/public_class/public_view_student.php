<?
 class public_view_student{
    var $params;
    public function __construct($_params){
        $this->params = $_params; 
        
    }
    
    public function student_profile(){
     $path ='/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Student_Info/'.$this->params.'.txt';
     $info = file_get_contents($path);
     $json = json_decode($info, TRUE);
     

     ?>
        <!DOCTYPE html>
         <html>
          <head>
           
          </head>
          <body>
               <div class="panel panel-primary">
                   <div class="panel-heading">
                    <span class="glyphicon glyphicon-search"></span>
                    
                   </div>
                   <div class ="panel-body">
                       <div style="float:left;" class="panel panel-primary">
                           <? echo '<img height="150" width="150" src=db/Images/'.$json['image'].'>';?>
                       </div>
                       <div style="float: left;">
                             <table class="table " style="width:350px; font-family: sans-serif; margin-left: 40px;">
                               <tr>
                                  <th>Student Names</th><td><? echo $json["fname"].'  '.$json["sname"]; ?></td>
                               </tr>
                               <tr>
                                  <th>Date Of Birth</th><td><? echo $json['dob']; ?></td>
                               </tr>
                               <tr>
                                <th>Gender</th><td><? echo $json['gender']; ?></td>
                               </tr>
                               <tr>
                                <th>Student</th><td><? echo $json['add_no'] ?></td>
                               </tr>
                               <tr>
                                <th>Class</th><td><? echo $json['class'].$json['subclass']; ?></td>
                               </tr>
                             </table>
                             <span role="button"  data-toggle="modal" data-target="#myModal1"><span class="glyphicon glyphicon-folder-open">  Personal-Info</span></span>
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
                                               <div class="panel-heading"><h4 class="modal-title"><span class="glyphicon glyphicon-folder-open"></span> Student Personal Information</h4></div>
                                               <div class="panel-body">
                                                   <table class="table table-hover" style="width:500px;">
                                                      <tr>
                                                       <th>Address</th><td><? echo $json['address']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>State Of Origin</th><td><? echo $json['state']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Local Goverment</th><td><? echo $json['lga']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Nationality</th><td><? echo $json['nation']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Religion</th><td><? echo $json['rel']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Admission Term</th><td><? echo $json['term']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Admission Session</th><td><? echo $json['session']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Accomodation</th><td><? echo $json['accom']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Present Status</th><td><? echo $json['status']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Parent's Name</th><td><? echo $json['pname']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Parent's Address</th><td><? echo $json['padd']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Parent's Phone</th><td><? echo $json['parent_phone']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Parent's Email</th><td><? echo $json['pemial']; ?></td>
                                                      </tr>
                                                      <tr>
                                                       <th>Emergency contact </th><td><? echo $json['emrcontact']; ?></td>
                                                      </tr>
                                                     </table>
                                                   
                                       
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
               </div>
          </body>
         </html>
     <?
    }
    //END
 }
?>