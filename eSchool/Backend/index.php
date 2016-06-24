<?php


try{


$class = $_REQUEST['class'];
$method = $_REQUEST['method'];




require_once('classes/'.$class.'.php');

$object = new $class($_REQUEST['params']);
 $result = $object->$method();

}catch( Exception $e ) {
	//catch any exceptions and report the proble
$error=$e->getMessage();
	 echo $error;
}


exit();

?>