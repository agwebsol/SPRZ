<?
 if(isset($_POST['submit'])){
    $topic = $_POST['topic'];
    $txt = $_POST['txt'];
    $name= $_POST['name'];
    $subclass = $_POST['sub-class'];
    $entry1 = array(
        "Subclass" => $subclass,
        "Topic" => $topic,
        "Note" =>$txt,
        "Name" => $name
    );
    $entry = json_encode($entry1);
    $folder =array();
    $folder[]=$entry;
    $js =json_encode($folder);
    $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/'.$subclass.'.txt';
    if(file_exists($path)){
        $arry = json_decode(file_get_contents($path));
        $arry[]=$entry;
        $json = json_encode($arry);
        $file = fopen($path, "w");
                fwrite($file, $json);
                fclose($file);
                header('LOCATION: Teacher.php?task=lesson_note&app=index');
    }else{
        $file = fopen($path, "w");
                fwrite($file, $js);
                fclose($file);
                header('LOCATION: Teacher.php?task=lesson_note&app=index');
        
    }
    
 }
?>

<?
    if(isset($_REQUEST['update'])){
        $topic = $_POST['topic'];
        $txt = $_POST['txt'];
        $name= $_POST['name'];
        $subclass = $_POST['sub-class'];
        $index = $_POST['index'];
        $entry1 = array(
            "Subclass" => $subclass,
            "Topic" => $topic,
            "Note" =>$txt,
            "Name" => $name
        );
        $entry = json_encode($entry1);
        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/'.$subclass.'.txt';
        if(file_exists($path)){
            $arry = json_decode(file_get_contents($path));
            array_splice($arry, $index-1, 1, $entry);
            $json = json_encode($arry);
            $file = fopen($path, "w");
                    fwrite($file, $json);
                    fclose($file);
             header('LOCATION: Teacher.php?task=lesson_note&app=view_note&index='.$index);
        }
            
    }
?>



<?
  if(isset($_REQUEST['delete'])){
        $index = $_REQUEST['index'];
        $subclass = $_REQUEST['subclass'];
        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Lesson_Notes/'.$subclass.'.txt';
        if(file_exists($path)){
            $arry = json_decode(file_get_contents($path));
            array_splice($arry, $index-1, 1);
            $json = json_encode($arry);
            $file = fopen($path, "w");
                    fwrite($file, $json);
                    fclose($file);
             header('LOCATION: Teacher.php?task=lesson_note&app=index');
        }
   
  }
?>

<?
 if(isset($_POST['grade_exe'])){
  $index = $_POST['index'];
  $path = $_POST['path'];
  $grade = $_POST['grade'];
  $comment = $_POST['comment'];
  $ary = array(
    "grade" => $grade,
    "comment" => $comment
  );
  $js_ary = json_encode($ary);
  if(file_exists($path)){
   $array = json_decode(file_get_contents($path));
    $answer =json_decode($array[$index-1], TRUE);
    $answer_ = array(
                "Name" =>$answer['Name'],
                "Answer" => $answer['Answer'],
                "Grade" =>$js_ary
                );
    $js_answer = json_encode($answer_);
    array_splice($array, $index-1, 1, $js_answer);
            $json = json_encode($array);
            $file = fopen($path, "w");
                    fwrite($file, $json);
                    fclose($file);
            header('LOCATION: Teacher.php?task=lesson_note&app=show_answer&info='.$answer['Name']);
    
  }
 }
?>
