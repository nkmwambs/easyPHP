	<?php
	//print(implode(",",array_keys($data)));
	//echo "<br>";
	//print_r($data);
	?>
	<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100);};

	var barChartData = {
		labels : [<?php echo implode(",",array_keys($data)); ?>],
		datasets : [
			{
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [<?php echo implode(",",array_values($data)); ?>]
			}
			//,
			//{
				//fillColor : "rgba(151,187,205,0.5)",
				//strokeColor : "rgba(151,187,205,0.8)",
				//highlightFill : "rgba(151,187,205,0.75)",
				//highlightStroke : "rgba(151,187,205,1)",
				//data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			//}
		]

	};
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		new Chart(ctx).Bar(barChartData, {
			responsive : true,
			barDatasetSpacing : 1
		});
	};

	</script>
<canvas id="canvas" height="" width=""></canvas>