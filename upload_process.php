<?php if(!isset($_SESSION)) {session_start();}
include("include/global.php");
date_default_timezone_set('Asia/Kolkata');
$t=date('Y-m-d H:i:s');
if($_POST){
	//post data
	$username=escape_data($_POST['username']);
	$address=escape_data($_POST['address']);
	$gender=escape_data($_POST['gender']);
	$blood_group=escape_data($_POST['blood_group']);
	$school=escape_data($_POST['school']);
	$gaurdian=escape_data($_POST['gaurdian']);
	$class_details=escape_data($_POST['class_details']);

	$uploaddir =  $uploadloaddirectory."images/students/";
	$image_name = 'dummy.jpg';//print_r($_FILES);die;

	//image upload
	$filename_big = 'default.jpg';
	$filter = "images";
	if($_FILES['my_file']['size'] > 0){				
		$filename_big= array(@$_FILES['my_file']);
		$image_name = upload_simple_files($filename_big,$uploaddir,$filter);		//echo 'mama';die;
	}

	$table="student_data";
	$info2 = array("username" => $username,"address" => $address,"gender" => $gender,"class_details" => $class_details,"blood_group" => $blood_group,"school_id" => $school,"gaurdian" => $gaurdian,"class_details" => $class_details,"user_photo"=>$image_name);
	$rollno = insert($info2, $table); //echo $data;
	$newurl = $siteurl.'rate/'.$rollno;

	$sql = 'select * from school_details where id='.$school;
	$result = basic_display($sql);
	$schoolname = '';
	foreach($result as $res){
		$schoolname = $res['school_name'];
	}
	
	
	//qr code generator starts
	require_once('phpqrcode.php');
	$errorCorrectionLevel = 'M';
	$matrixPointSize = 5;

	$image_name2 = str_replace(".jpg",".png",$image_name);
	$filename =  'images/qrcode/'.$image_name2;	
	QRcode::png($newurl, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
	//qr code generator ends

	//student card generation starts
	require_once('createimage.php');
	$imagefile1 = $siteurl.'images/students/'.$image_name;
	$imagefile2 = $siteurl.'images/qrcode/'.$image_name2;	
	createThumb($imagefile1,$imagefile2,$schoolname,$username,$rollno,$gender,$address,$image_name);
	//student card generation ends	
	
	
	echo 'THANK YOU<br/><img src="'.$siteurl.'images/idcard/'.$image_name.'" alt="'.$image_name.'" >';
	
	//header('Location: thanks.php');
}
?>