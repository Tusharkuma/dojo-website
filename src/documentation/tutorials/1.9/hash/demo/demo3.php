<?php include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/',dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php') ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<ul id="menu">
			<li><a href="demo3.php">Home</a></li>
			<li><a href="about.php">About us</a></li>
		</ul>
		<div id="content">Welcome to the home page!</div>
		<textarea id="loadTimeTextBox" style="width: 26em; height: 7em; margin-top: 5em;"></textarea>

		<?php Utils::printDojoScript("") ?>
		<script>
			require([
				"dojo/dom",
				"dojo/dom-attr",
				"dojo/hash",
				"dojo/on",
				"dojo/request",
				"dojo/topic",
				"dojo/query" // for dojo/on event delegation
			], function(dom, domAttr, hash, on, request, topic){
				// find the content element and store a reference
				var contentNode = dom.byId("content"),
					// store the last requested page so we do not make multiple requests for the same content
					lastPage = (/([^\/]+).php$/.exec(location.pathname) || [])[1] || "index";

				on(dom.byId("menu"), "a:click", function(event){
					// prevent loading a new page - we're doing a single page app
					event.preventDefault();
					var page = domAttr.get(this, "href").replace(".php", "");
					loadPage(page);
				});

				topic.subscribe("/dojo/hashchange", function(newHash){
					loadPage(newHash);
				});

				hash(location.hash || lastPage, true); // set the default page hash

				function loadPage(page){
					hash(page);

					// get the page content using an Ajax GET
					request(page + ".json", {
						handleAs: "json"
					}).then(function (data) {
						// update the page title and content
						document.title = data.title;	
						contentNode.innerHTML = data.content;
					});
				}
			});
		</script>

		<script>
			document.getElementById("loadTimeTextBox").value = "Page loaded at " + new Date() +
				"\nNotice that this doesn't change as you click links - content is being loaded dynamically without reloading the page";
		</script>
	</body>
</html>