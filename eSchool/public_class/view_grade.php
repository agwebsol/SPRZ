<?
 class view_grade{
    var $params;
    public function __construct($_params){
        $this->params = $_params; 
        
    }
    
    public function grades(){
     $array =$this->params;
     $id = $array['id'];
     $term = $array['term'];
     $session = $array['session'];
     $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/'.$session.'/Grades/'.$id.'.txt';
     $path2= '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Student_Info/'.$id.'.txt';
     if(file_exists($path)){
        $file = file_get_contents($path);
        $info = file_get_contents($path2);
        $student = json_decode($info,TRUE);
        $json = json_decode($file, TRUE);
        $js_term = $json[$term];
        $subjects = json_decode($js_term, TRUE);
          ?>
             <body>
                 <div class="panel panel-primary">
                  <div class="panel-heading"><h4 style="color:BLACK;"><? echo $student['fname'].' '.$student['sname'].' '.$term; ?></h4></div>
                     <div class="panel-body">
                        <table class="table table-hover">
                          <?
                            foreach($subjects as $key => $value){
                               $v=json_decode($value, TRUE);
                               ?>
                                 <tr>
                                    <th><? echo $key; ?></th><td><? echo $v['Test1']; ?></td><td><? echo $v['Test2']; ?></td><td><? echo $v['Test3']; ?></td><td><? echo $v['Exam']; ?></td>
                                 </tr>
                               <?
                            }
                          ?>
                        </table>
                     </div>
                 </div>
             </body>
          <?
            
     }
     
    }
    //END
 }
?>