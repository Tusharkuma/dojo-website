<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Demo: Fixing context with Function.prototype.call</title>
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
		<style type="text/css">
			#nodeContainer {
				margin: 1em;
			}
			.myNode {
				border: 1px solid #999;
				margin: 1em;
				padding: 0.5em;
				background-color: #ccc;
				float: left;
			}

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
		<h1>Demo: Fixing context with Function.prototype.call</h1>
		<p>
		The following demonstrates what happens when the value of the "this" variable in a script
		is set with Function.prototype.call.  Click on any of the fake button nodes below to see,
		and view the source to see what we are doing.
		</p>
		<div id="nodeContainer"></div>
		<div style="clear: both;"></div>
		<?php Utils::printDojoScript("isDebug: true, async: true") ?>
		<script>
			
			// Retrieve the dependencies
			require(["dojo/_base/lang", "dojo/query", "dojo/dom-construct", "dojo/domReady!"],
				function(lang, query, domConstruct) {

					function log(msg){
						var c = document.getElementById("console");
						if(!c){
							c = domConstruct.create("div", {
								id: "console"
							}, document.body);
						}
						c.innerHTML += "<div>" + msg + "</div>";
					}
	
					var myObject = {
						foo: "bar",
						myHandler: function(evt){
							//	still contrived!
							log("The value of foo is " + this.foo + ", from " + (evt && evt.target ? evt.target.id : window.event.srcElement.id));
						}
					};
					
					var container = document.getElementById("nodeContainer");
					for(var i=0; i<10; i++){
						domConstruct.create("div", {
							id: "node-" + i,
							className: "myNode",
							innerHTML: "Fake button " + (i+1)
						}, container);
					}
	
					query(".myNode").forEach(function(node){
						node.onclick = function(evt){
							return myObject.myHandler.call(myObject, evt);
						};
					});

			});
			
		</script>
	</body>
</html>
