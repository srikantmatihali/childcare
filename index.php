<?php include("include/global.php");

//get current date.
$date = date("Y-m-d");
$query="SELECT COUNT( rating ) as count , rating FROM  `ratings` WHERE DATE(`date`) = '".$date."' GROUP BY rating ";
$pdata = basic_display($query);


//get overall ratings
$query2 = "SELECT * FROM ratings WHERE DATE(`date`) = '".$date."'";
$resultdata = basic_display($query2);
$overallcount = count($resultdata);

//get school data
$query3 = 'SELECT * FROM school_details';
$result3 = basic_display($query3);

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
<h1 style="text-align:center;" >CHILD CARE</h1>
<hr/>
<p class="lead"></p>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div>TOTAL STUDENTS WHO TOOK MEALS TODAY: <?php echo $overallcount;?></div>
<hr>

<div class="col-lg-4 userdata">
      <ul class="list-group">      
		<?php foreach($result3 as $res):?>
			<li class="list-group-item"><a href="<?php echo $siteurl.'dailyreport/'.$date.'/'.$res['id'];?>" ><?php echo $res['school_name'];?></a></li>
		<?php endforeach;?>        
      </ul>
</div>
</div>         
	 
<!-- script references -->
<script src="<?php echo $siteurl;?>js/jquery.min.js"></script>
<script src="<?php echo $siteurl;?>js/bootstrap.min.js"></script>
<script src="<?php echo $siteurl;?>js/scripts.js"></script>		
<script src="<?php echo $siteurl;?>js/highcharts.js"></script>
<script src="<?php echo $siteurl;?>js/exporting.js"></script>
<script>
$(function () {
    	
    	// Radialize the colors
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		
		// Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Combined ratings of All Schools'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        },
                        connectorColor: 'silver'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Ratings',
                data: [
				<?php  foreach($pdata as $p){?>
                    ['Rating <?php echo $p['rating'];?>',   <?php echo $p['count'];?>],

					<?php }?>
                ]
            }]
        });
    });
</script>		
</body>
</html>