<?php
include("include/global.php");
/* print_r($_GET);
if(!empty($_GET['id']))
{

$student_id =escape_data($_GET['id']);
$stable = 'student_data as s';
$sfield = "s.username as username,s.address,s.type_id as type_id,s.gender as gender,s.gaurdian as gaurdian, s.blood_group as blood_group,
s.user_photo as image,t.type_name,sh.id as school_id,sh.school_name as school_name,sh.address as school_address,
sh.pincode as school_pincode,sh.district as school_district,sh.state as state";
$swhere="LEFT JOIN type as t ON s.type_id=t.id LEFT JOIN school_details as sh ON s.school_id=sh.id WHERE  s.id='".$student_id."' AND s.status=1";
$sdata = db_display_selected($stable,$sfield,$swhere); */
//print_r($sdata);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Ratings</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="<?php echo $siteurl;?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo $siteurl;?>css/jquery.raty.css" rel="stylesheet">
		<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.5.1.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo $siteurl;?>css/styles.css" rel="stylesheet">
	</head>
	<body>

<div class="container">
<h1></h1>
<p class="lead"></p>
<div id="bar-example"></div>



  <hr>

  <hr>
</div>
         
	 
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="<?php echo $siteurl;?>js/bootstrap.min.js"></script>
		<script src="<?php echo $siteurl;?>js/scripts.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.5.1.min.js"></script>
<script>
Morris.Bar({
  element: 'bar-example',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Series A', 'Series B']
});
</script>

		
	</body>
</html>
<?php
/* }
else
{
echo 'errot :(';
} */
?>