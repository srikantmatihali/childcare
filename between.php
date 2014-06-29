<?php include("include/global.php");
$date2=$_GET['date2'];
$date1=$_GET['date1'];
$extra='';
if(!empty($_GET['school']))
{
	$extra='AND school_id='.$_GET['school'];	 	
}
$query="SELECT COUNT( rating ) as count , rating FROM  `ratings` where date between '".$date1."' AND '".$date2."' ".$extra."   GROUP BY rating ";
$pdata = basic_display($query);
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
		<link rel="stylesheet" href="<?php echo $siteurl;?>css/morris-0.5.1.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo $siteurl;?>css/styles.css" rel="stylesheet">
	</head>
	<body>

<div class="container">
<h1></h1>
<p class="lead"></p>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</hr>
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
                text: 'Datewise Ratings of Mid-day Meals by Students'
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
                    ['<?php echo $p['count'];?>',   <?php echo $p['rating'];?>],

					<?php }?>
                ]
            }]
        });
    });
</script>		
</body>
</html>