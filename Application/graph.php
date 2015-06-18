<?php
    global $base_url;
    define('safeGuard', TRUE);
    define('dbConnected', TRUE);
    define('__ROOT__', dirname(__FILE__));
    require_once(__ROOT__ . '/assets/classes/class.connect.php');
	$connection = new Connect;
    if (!isset($_SESSION['mail']) && ($_SESSION['mail'] == "")):
        header('Location: index.php', 401);
    else:
		require_once(__ROOT__ . '/assets/include/header.php');
		$data = $connection -> graph_data(-1);
?>

<canvas id="myChart" width="900" height="600" ></canvas>
<?php require_once (__ROOT__ . '/assets/include/footer-tags.php');?>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
<script>
	var options= {
		scaleShowGridLines : false,
		bezierCurve : true,
		bezierCurveTension : 0.2,
		pointDot : false,
		scaleShowLabels: true,
		showTooltips: false,
		pointHitDetectionRadius : 10
};

var data = {
	labels: <?php echo json_encode($data['time']); ?>,
	datasets: [{
		label: "My First dataset",
		fillColor: "rgba(220,220,220,0.2)",
		strokeColor: "rgba(220,220,220,1)",
		pointColor: "rgba(220,220,220,1)",
		pointStrokeColor: "#fff",
		pointHighlightFill: "#fff",
		pointHighlightStroke: "rgba(220,220,220,1)",
		data: <?php echo json_encode($data['bpm']); ?>
	}]
};
var ctx = document.getElementById("myChart").getContext("2d");
var myLineChart = new Chart(ctx).Line(data, options);

</script>
                
 <?php
require_once (__ROOT__ . '/assets/include/end-tags.php');
endif;
?>