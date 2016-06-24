<?
class message_board {
    var $params;
    public function __construct($params_){
       $this->params = $params_; 
    }
    
    public function show_board(){
        $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Message_board/message_board.txt';
        if(file_exists($path)){
            $entry = json_decode(file_get_contents($path));
            ?>
                <body>
                    <div class="panel panel-info">
                        <div class="panel-heading"><span class="glyphicon glyphicon-comment"> <? echo date('D').' '.date('j').'-'.date('M').'-'.date('Y'); ?></span></div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                
                                <?
                                    $k=0;  
                                    foreach($entry as $value){
                                        $v = json_decode($value, TRUE);
                                        $k++;
                                        
                                        ?>
                                            <tr>
                                                <td style="background-color:#F5A9BC;"><span class="glyphicon glyphicon-paperclip"></span></td>
                                                <td><? echo $v['message']?></td>
                                                <td>
                                                <?
                                                    if($this->params=="Admin"){
                                                        $delete = '<a href="message_board.php?delete=yes&index='.$k.'"><span class="glyphicon glyphicon-remove"></span></>';
                                                        echo $delete;
                                                    }
                                                ?>
                                                </td>
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
}
?>

<?
if(isset($_REQUEST['add'])){
    $date = $_REQUEST['date'];
    $message = $_REQUEST['message'];
    $array = array(
        "Date"=>$date,
        "message"=>$message
    );
    $msg = json_encode($array);
    $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Message_board/message_board.txt';
    $txt = json_decode(file_get_contents($path));
    array_push($txt, $msg);
    $js = json_encode($txt);
    $fill = fopen($path, "w");
            fwrite($fill, $js);
            fclose($fill);
    header('LOCATION: Admin.php');
}
?>


<?
if(isset($_REQUEST['delete'])){
    $index = $_REQUEST['index'];
    $path = '/Applications/XAMPP/xamppfiles/htdocs/eSchool/db/15-16/Message_board/message_board.txt';
    $txt = json_decode(file_get_contents($path));
    array_splice($txt,$index-1, 1);
    $js = json_encode($txt);
    $fill = fopen($path, "w");
            fwrite($fill, $js);
            fclose($fill);
    header('LOCATION: Admin.php');
}
?>


