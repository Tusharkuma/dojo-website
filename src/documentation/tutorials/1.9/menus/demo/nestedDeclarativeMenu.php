<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Demo: Dijit Menus</title>
	<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen">
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
		Utils::printClaroCss();
	?>
</head>
<body class="claro">
	<h3>Nested Menu Demo</h3>
	<div id="mainMenu" data-dojo-type="dijit/Menu">
		<div id="edit" data-dojo-type="dijit/MenuItem">Edit</div>
		<div id="view" data-dojo-type="dijit/MenuItem">View</div>
		<div id="task" data-dojo-type="dijit/PopupMenuItem">
			<span>Task</span>
			<div id="taskMenu" data-dojo-type="dijit/Menu">
				<div id="complete" data-dojo-type="dijit/MenuItem">Mark as Complete</div>
				<div id="cancel" data-dojo-type="dijit/MenuItem">Cancel</div>
				<div id="begin" data-dojo-type="dijit/MenuItem">Begin</div>
			</div>
		</div><!-- end of sub-menu -->
	</div>
	<p>Last selected: <span id="lastSelected">none</span></p>

	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
		Utils::printDojoScript("isDebug:1, async:1");
	?>
	<script>
        require([
            "dojo/dom",
            "dojo/parser",
            "dijit/registry",
            "dijit/WidgetSet", // for registry.byClass
            "dijit/Menu",
            "dijit/MenuItem", 
            "dijit/PopupMenuItem",
            "dojo/domReady!"
        ], function(dom, parser, registry){
			// a menu item selection handler
			var onItemSelect = function(event){
				// The event handler runs in the context of the widget
				dom.byId("lastSelected").innerHTML = this.get("label");
			};

			parser.parse();

			registry.byClass("dijit.MenuItem").forEach(function(item){
				item.on("click", onItemSelect);
			});
		});
	</script>
</body>
</html>
