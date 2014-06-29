<?php
if(!isset($_SESSION)) {session_start();}
include("include/global.php");
date_default_timezone_set('Asia/Kolkata');
$t=date('Y-m-d H:i:s');
$rate=escape_data($_POST['score']);
$type=escape_data($_POST['type_id']);
$student_id=escape_data($_POST['pid']);
$school_id=escape_data($_POST['school_id']);


$table="ratings";
  $info2 = array("school_id" => $school_id,"student_id" => $student_id,"type_id" => $type,"rating" => $rate,"date" => $t);
    $data = insert($info2, $table);
	
    //echo $data;
//header('Location: thanks.php');
?>
