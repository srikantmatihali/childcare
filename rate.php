<?php include("include/global.php");
$imgurl = '';
//print_r($_GET);
if(!empty($_GET['id']))
{

$student_id =escape_data($_GET['id']);
$stable = 'student_data as s';
$sfield = "s.username as username,s.address,s.type_id as type_id,s.gender as gender,s.gaurdian as gaurdian, s.blood_group as blood_group,
s.user_photo as image,t.type_name,sh.id as school_id,sh.school_name as school_name,sh.address as school_address,
sh.pincode as school_pincode,sh.district as school_district,sh.state as state";
$swhere="LEFT JOIN type as t ON s.type_id=t.id LEFT JOIN school_details as sh ON s.school_id=sh.id WHERE  s.id='".$student_id."' AND s.status=1";
$sdata = db_display_selected($stable,$sfield,$swhere);
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
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo $siteurl;?>css/styles.css" rel="stylesheet">
		<style>.userdata{ display:none; }</style>
	</head>
	<body>

<div class="container">
<h1 style="text-align:center;">CHILD CARE</h1>
<p class="lead"></p>




<!-- ListGroups
================================================== -->
<hr>

  <h2 id="panels">Welcome <?php echo $sdata['username'];?></h2>
  
  <div>
	<?php $sdata['image'];
		if(!empty($sdata['image'])){ ?>
				<img src="<?php echo $siteurl.'images/students/'.$sdata['image']; ?>" alt="<?php echo $sdata['username']; ?>" />
	<?php }?>
	<p>&nbsp;</p>
	<div class="showdetails btn btn-default" onclick="showdata()"  >Show userdata</div>
  </div>
  <hr/>
  <div class="row">
    <div class="col-lg-4 userdata">
      <ul class="list-group">
        <li class="list-group-item"><strong>Student Details</strong></li>
        <li class="list-group-item">name : <strong><?php echo $sdata['username'];?></strong></li>
        <li class="list-group-item">Address : <strong><?php echo $sdata['address'];?></strong></li>
        <li class="list-group-item">Gaurdian : <strong><?php echo $sdata['gaurdian'];?></strong></li>
         <li class="list-group-item">Blood Group : <strong><?php echo $sdata['blood_group'];?></strong></li>
      </ul>
    </div>
    <div class="col-lg-4 userdata">
      <ul class="list-group">

        <li class="list-group-item"> <strong>School</strong></li>
        <li class="list-group-item"> <?php echo $sdata['school_name'];?></li>
        <li class="list-group-item"> <?php echo $sdata['school_address'];?></li>
		<li class="list-group-item"> <?php echo $sdata['school_district'];?></li>
		<li class="list-group-item"> <?php echo $sdata['state'];?></li>
       <li class="list-group-item"> <?php echo $sdata['school_pincode'];?></li>
      </ul>
    </div>
    <div class="col-lg-4 ratingDiv">
	  <h3>RATE</h3>	
      <div class="list-group">
        <!--<div href="#" class="list-group-item active "></div>-->
								<select name="school"  data-type="<?php echo $sdata['type_id'];?>" school-id="<?php echo $sdata['school_id'];?>" id="select01" class=" list-group-item rate">
									<option data-id="0" value="0">Select Type</option>
									<option data-id="1" value="1">Mid-day Meals</option>
									<option data-id="2" value="2">Uniform</option>				
									<option data-id="3" value="3">BiCycle</option>
									
								</select>		
        <div href="#"id="20" data-score="3" data-number="3" class="list-group-item rate">
          
        </div>
      </div>
    </div>
  </div>
  
  


  
</section>
  <hr>
</div>
         
	 
	<!-- script references -->
		<script>
		var siteurl = '<?php echo $siteurl; ?>';
		</script>
		<script src="<?php echo $siteurl;?>js/jquery.min.js"></script>
		<script src="<?php echo $siteurl;?>js/bootstrap.min.js"></script>
		<script src="<?php echo $siteurl;?>js/scripts.js"></script>
		<script src="<?php echo $siteurl;?>js/jquery.raty.js"></script>
<script>
function showdata(){
	$('.userdata').show();
	$('.showdetails').hide();
}
$(function() {
//Below is a path to img folder.
      //$.fn.raty.defaults.path = 'js/img';  
//Below will activate Raty on div where class is star.	
var zx;
var school_id=$('#select01').attr('school-id');
var type_id=$('#select01').attr('data-type');
	$("#select01").on('change', function(){
		 zx = $(this).val();
		 $(this).attr('data-type',zx);
			//alert(zx);
		
	});  
      $('.rate').raty({
	half  : true,
        number: 5,
        score : 0,
        click: function(score, evt) {
//Below will get id value and store in variable pid				
		var pid=$(this).prop('id');
//Below will post score and id value to raty1.php page behind the scenes.	
		    $.post('<?php echo $siteurl;?>rate_submit.php',{score:score, pid:pid,zx:zx,school_id:school_id,type_id:type_id},
                    function(data){
                    $('.ratingDiv').html('Thanks for your feedback');   
            });
          }
     });
});
		</script>
		
	</body>
</html>
<?php
}
else
{
echo 'errot :(';
}
?>