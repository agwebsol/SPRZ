<?
$path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/Time_Table/Time_Table.txt';
$week1 = array(
                  "Monday" => json_encode(array()),
                  "Tuesday" => json_encode(array()),
                  "Wednesday" => json_encode(array()),
                  "Thursday" => json_encode(array()),
                  "Friday" => json_encode(array()),
                  "Saturday"=> json_encode(array()),
                  "Sunday"=> json_encode(array())
                );
                $week = json_encode($week1);
                $time_table = array(
                   "KG 1"=>$week,
                   "KG 2"=>$week,
                   "KG 3"=>$week,
                   "Primary 1" => $week,
                   "Primary 2" => $week,
                   "Primary 3" => $week,
                   "Primary 4" => $week,
                   "Primary 5" => $week,
                   "Primary 6" => $week,
                   "JSS 1" => $week,
                   "JSS 2" => $week,
                   "JSS 3" => $week,
                   "SSS 1" => $week,
                   "SSS 2" => $week,
                   "SSS 3" => $week
                );
                $school_time_table = json_encode($time_table);
                $fill = fopen($path, "w");
                        fwrite($fill, $school_time_table);
                        fclose($fill);
?>

