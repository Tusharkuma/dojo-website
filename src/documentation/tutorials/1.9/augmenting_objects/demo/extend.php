<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			Demo: lang.extend
		</title>
		<link rel="stylesheet" href="style.css" media="screen" type="text/css">
		<link rel="stylesheet" href="../../../resources/style/demo.css" media="screen" type="text/css">
		<?php
			include_once($_SERVER['DOCUMENT_ROOT'] . implode('/', array_slice(explode('/', dirname($_SERVER['PHP_SELF'])), 0, 4)) . '/Utils.php');
			Utils::printDojoScript("async: true");
			Utils::printClaroCss();
		?>

	</head>
	<body class="claro">
		<h1>Demo: lang.extend</h1>
		<p>View source. The result is in the console.</p>

		<button id="btn" data-dojo-type="dijit/form/Button">Swing</button>

		<script>
			require([
				"dojo/parser",
				"dojo/_base/lang",
				"dijit/registry",
				"dijit/form/Button"
				], function(parser, lang, registry){

				parser.parse();

				var defaultSettings = {
					useTheForce: true,
					isEvil: false,
					length: 75,
					color: 'blue'
				};

				function Lightsaber(settings){
					// `defaultSettings` is first mixed into the blank object,
					// then `settings` is mixed into the blank object, overriding
					// any properties from `defaultSettings` without altering
					// the `defaultSettings` object
					this.settings = lang.mixin({}, defaultSettings, settings);
				}

				var darthsaber = new Lightsaber({
					isEvil: true,
					color: 'red'
				});

				var weaponMixin = {
					hp: 5,
					maxHp: 10,
					repair: function() {
						if(this.hp >= this.maxHp) {
							console.log("Can't repair!");
							return;
						}

						this.hp++;
					},
					swing: function() {
						if(!this.hp) {
							console.log("Weapon is broken!");
							return;
						}

						this.hp--;
						console.log(Math.random() >= 0.5 ? "hit!" : "miss!");
					}
				};

				lang.extend(Lightsaber, weaponMixin);

				// Now we can call swing() on our Lightsaber instance,
				// even though we augmented the prototype after creating the instance.
				darthsaber.swing(); // "hit!" (or "miss!" if you are unlucky)

				registry.byId('btn').on('click', lang.hitch(darthsaber, 'swing'));
			});
		</script>
	</body>
</html>
