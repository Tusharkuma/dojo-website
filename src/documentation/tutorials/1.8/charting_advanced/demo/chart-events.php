<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Charting Events</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<?php
    		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
    		Utils::printClaroCss();
    	?>
	</head>
	<body class="claro">
		<h1>Charting Events</h1>
		<p>Place your mouse over a pie piece to change its background color.  Click the piece to watch it spin.</p>
		<div id="chartNode" style="width:800px;height:400px;"></div>
		
		<!-- load dojo and provide config via data attribute -->
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript();
		?>
		<script>
			
			// Require the basic 2d chart resource: Chart
			// Retrieve the Tooltip class
			// Require the theme of our choosing
			require(["dojox/charting/Chart", "dojox/charting/action2d/Tooltip", "dojox/charting/themes/Claro", "dojox/gfx/fx", "dojox/charting/plot2d/Pie", "dojox/charting/axis2d/Default", "dojo/domReady!"], 
					function(Chart, Tooltip, Claro, gfxFx) {
				
				// Define the data
				var chartData = [10000,9200,11811,12000,7662,13887,14200,12222,12000,10009,11288,12099];
				
				// Create the chart within it's "holding" node
				var chart = new Chart("chartNode");

				// Set the theme
				chart.setTheme(Claro);

				// Add the only/default plot 
				chart.addPlot("default", {
					type: "Pie",
					markers: true
				});
				
				// Add axes
				chart.addAxis("x");
				chart.addAxis("y", { min: 5000, max: 30000, vertical: true, fixLower: "major", fixUpper: "major" });

				// Add the series of data
				chart.addSeries("Monthly Sales - 2010", chartData);
				
				// Create the tooltip
				var tip = new Tooltip(chart, "default");
				
				// Render the chart!
				chart.render();
				
				// Add a mouseover event to the plot
				chart.connectToPlot("default",function(evt) {
					// Output some debug information to the console
					console.warn(evt.type," on element ",evt.element," with shape ",evt.shape);
					// Get access to the shape and type
					var shape = evt.shape, type = evt.type;
					// React to mouseover event
					if(type == "onclick") {
						// Update its fill
						var rotateFx = new gfxFx.animateTransform({
							duration: 1200,
							shape: shape,
							transform: [
								{ name: 'rotategAt', start: [0,240,240], end: [360,240,240] }
							]
						}).play();
					}
					// If it's a mouseover event
					else if(type == "onmouseover") {
						// Store the original color
						if(!shape.originalFill) {
							shape.originalFill = shape.fillStyle;
						}
						// Set the fill color to pink
						shape.setFill("pink");
					}
					// If it's a mouseout event
					else if(type == "onmouseout") {
						// Set the fill the original fill
						shape.setFill(shape.originalFill);
					}
					
				});
				
			});
			
		</script>
	</body>
</html>
