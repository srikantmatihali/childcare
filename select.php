<?php include("include/global.php");

//finds school related details.
$query3 = 'SELECT * FROM school_details';
$result3 = basic_display($query3);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Datepicker - Default functionality</title>
<link rel="stylesheet" href="<?php echo $siteurl;?>css/jquery-ui.css">
<script src="<?php echo $siteurl;?>js/jquery.min.js"></script>
<script src="<?php echo $siteurl;?>js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $siteurl?>css/style.css">
<script>
  $(function() {
    //$( "#datepicker" ).datepicker();
	$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
</script>
</head>
<body>
 
<p>Date: between <input class="as" type="text" value="" id="datepicker"></p>
<br>
<p>And</p>
 <input class="sd" type="text" value="" id="datepicker2"></p>
 
<select name="school" data-type="0"  id="school" class=" list-group-item rate">
	<option data-id="0" value="0">Select Type</option>
	<?php foreach($result3 as $res):?>
	<option data-id="<?php echo $res['id'];?>" value="<?php echo $res['id']?>"><?php echo $res['school_name']?></option>				
	<?php endforeach;?>
</select>		
 
 
 <br />
 <button class="go">Go</button>
</body>
<script>
$( ".go" ).on( "click", function(e) {
var date1=$('.as').val();
var date2=$('.sd').val();
var school=$('#school').attr('data-type');
//alert(school);
	e.preventDefault();
  //alert( $( this ).text() );
  window.location="<?php echo $siteurl;?>between.php?date1="+date1+"&date2="+date2+"&school="+school;
});

$("#school").on('change', function(){
		 zx = $(this).val();
		 $(this).attr('data-type',zx);
			//alert(zx);
});  
</script>
</html>