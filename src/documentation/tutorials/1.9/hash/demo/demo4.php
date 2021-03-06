<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" href="style.css">
		<style>
			#console {
				margin-top: 2em;
				border-top: 1px solid #333;
			}
			
			#console div {
				background: #eee; 
				padding:5px 10px;
				margin-top: 2px;
			}
		</style>
	</head>
	<body>
		<ul>
			<li><a href="#/user/1">User 1</a></li>
			<li><a href="#/user/2">User 2</a></li>
			<li><a href="#/user/3">User 3</a></li>
			<li><a href="#/user/4">User 4</a></li>
			<li><a href="#/norouter/match">No Router Match</a></li>
		</ul>

		<?php Utils::printDojoScript("") ?>
		<script>
			require([
				"dojo/router",
				"dojo/dom-construct"
			], function(router, domConstruct){
				router.register("/user/:id", function(event){
					log("Router matched hash: " + event.params.id);
				});

				router.startup();

				function log(msg){
					var c = document.getElementById("console");
					if(!c){
						c = domConstruct.create("div", {
							id: "console"
						}, document.body);
					}
					c.innerHTML += "<div>" + msg + "</div>";
				}
			});
		</script>
	</body>
</html>