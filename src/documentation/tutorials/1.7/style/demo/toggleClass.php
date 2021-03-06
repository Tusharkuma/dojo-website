<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tutorial: dIn Style with Dojo</title>
		<link rel="stylesheet" href="style.css" media="screen">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		
	</head>
	<body>
		<h1>Tutorial: In Style with Dojo</h1>
		
		<h3>Toaster Status</h3>
		<div id="toasterStatus" class="statusBox toasterIdle">Idle</div>

		<h3>dojo.hasClass</h3>
		
		<button id="logIsIdleButton">Is Toaster Idle?</button>

		<h3>dojo.toggleClass</h3>
		
		<button id="toggleToasterStatusButton">Toggle Toaster Status</button>
		
		<h3>Console</h3>
		<div id="console" class="console"></div>
	
		<?php Utils::printDojoScript("isDebug: true,parseOnLoad: true") ?>
		<script>
			dojo.require("dojo.behavior");
			
			// Wait for the DOM to be ready before working with it
			dojo.ready(function(){
				// we are defining these functions in dojo.ready so they are not in the global scope
				
				var writeToPageConsole = function(line){
					var pageConsole = dojo.byId("console");
					var currentConsoleValue = pageConsole.innerHTML;
					pageConsole.innerHTML = currentConsoleValue + "<br>" + line;
				};
				
				var logIsIdle = function(evt){
					var logText = "";
					if (toasterIdle) {
						logText = "The toaster is idle.  Quick, go make toast!";
					} else {
						logText = "Your stupid roommate is using the toaster again.  Try again later.";
					}
					writeToPageConsole(logText);
				}
				
				var toasterIdle = true;
				
				var toggleToasterStatus = function(){
					toasterIdle = !toasterIdle;
					var toasterStatusDiv = dojo.byId("toasterStatus"); 
					dojo.toggleClass(toasterStatusDiv, "toasterIdle");  // toggle the "toasterIdle" class
					var statusText = "Toasting..."
					if (toasterIdle) {
						statusText = "Idle";
					}
					dojo.attr(toasterStatusDiv, "innerHTML", statusText);
				};
				
				
				var buttonBehaviors = {
					"#logIsIdleButton" : {
						"onclick" : logIsIdle
					},
					"#toggleToasterStatusButton" : {
						"onclick" : toggleToasterStatus
					}				
				};
				
				dojo.behavior.add(buttonBehaviors);
				dojo.behavior.apply();

			});
		</script>
	</body>
</html>
