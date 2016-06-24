<?
  class view_attendance{
      var $params;
      public function __construct($_params){
         $this->params = $_params;
      }
      
      public function attendance(){
         $js = json_decode($this->params, TRUE);
         $student_id = $js['id'];
         $term = $js['term'];
         $session =$js['session'];
         $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Attendance/'.$term.'/'.$student_id.'.txt';
         $path2= '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Student_Info/'.$student_id.'.txt';
         if(file_exists($path)){
            $file = file_get_contents($path);
            $info = file_get_contents($path2);
            $student = json_decode($info,TRUE);
            $attd = json_decode($file);
             ?>
              <div class="panel panel-primary">
                <div class="panel-heading"><h5 style="color:BLACK;"><? echo $student['fname'].' '.$student['sname']; ?></h5></div>
                <div class="panel-body" style="margin-top:30px; color:white;">
                    <table class="table table-hover" style="width: 30%; font-size: small;">
                         <tr>                       
                           <?
                             $k=0;
                             foreach($attd as $value){
                              $k++;
                              $v = json_decode($value, TRUE);
                              $color="";
                              $status ="";
                              if($v['status']=='Present'){
                               $this->color = 'GREEN';
                               $this->status ='P';
                              }
                              if($v['status']=='Absent'){
                               $this->color = 'RED';
                               $this->status ='Ab';
                              }
                              $dt = date_create($v['date']);
                              $day = date_format($dt, "D");
                              $no = date_format($dt, "d");
                              
                              ?><td style="background-color:<? echo $this->color; ?>;"><? echo $no.' '.$day.'<br>'.$this->status; ?></td><?
                              if($k % 5 == 0){
                              ?></tr><tr><?
                              }
                             }
                           ?>
                        
                    </table>
                </div>
              </div>
             <?
         }else{ echo 'No Record For This Year';}
      }
  }
?>