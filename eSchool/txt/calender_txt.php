<?
$path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Calender.txt';
if(file_exists($path)){
    $entry = json_encode(array());
    $year = array(
      "Jan" => $entry,
      "Feb" => $entry,
      "Mar" => $entry,
      "Apr" => $entry,
      "May" => $entry,
      "Jun" => $entry,
      "Jul" => $entry,
      "Aug" => $entry,
      "Sep" => $entry,
      "Oct" => $entry,
      "Nov" => $entry,
      "Dec" => $entry
    );
    $js = json_encode($year);
    
    $file = fopen($path, "w");
            fwrite($file, $js);
            fclose($file);
}
?>

