<html>
<head>
	<title>ColourFinder</title>

	<link rel="stylesheet/less" type="text/css" href="less/base.less" />
	
	<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1/prototype.js"></script>
	<script src="lib/ColourFinder/ColourFinder.js"></script>

	<script src="lib/less/dist/less-1.5.0.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="page">
		<div class="hero">
			<div>
				<h1>ColourFinder</h1>
				<p>Lightweight library to extract the dominant colour palette from an image. Uses Javascript and Canvas.</p>
				<a href="https://raw.github.com/craigymunro/ColourFinder/master/ColourFinder.js">Download ColourFinder.js</a>
				<a href="https://github.com/craigymunro/ColourFinder">View on Github</a>
			</div>
		</div>
		
		<? $image = $_GET["image"] ? $_GET["image"] : "http://www.craigmunro.net/ColourFinder/images/boston.gif"; ?>
	
		<form>
			<label>Enter an image URL:</label>
			<input name="image" placeholder="Select an image" value="<?=$image?>" style="width: 300px;"/>
			<button>Go</button>
		</form>
		
		<section>		
			<h2>Examples</h2>
			<? foreach(explode(",", "dali,great-wave,mona-lisa,test,Van-Gogh-Self-Portrait") as $key => $image) { ?>
				<div class="example" id="canvas-<?=$key?>">
					<div class="canvas">
						<img src="images/<?=$image?>.jpg" id="example-<?=$key?>"/>
					</div>
					<div>
						<a href="javascript:findColour(<?=$key?>);">Find palette</a>
						<div class="blocks"></div>
					</div>
				</div>			
			<? } ?>			
		</section>
		
		<section>
			<h2>Usage</h2>
<?
$usage = <<<USE
<script>
var image = $("demo");

// Create a new instance of ColourFinder
var finder = new ColourFinder();

// Find the dominant colour in the image. Returns a hex code, i.e: "0069ff".
dominant = finder.getDominant(image);

// Find the colour palette of the image. Returns an array of
// hex codes and instances, i.e:
// { "0069ff": 12, "0069aa": 14 }
palette = finder.getPalette(image, 8);

// Find the average colour of the image. Returns a hex code, i.e. "00fa30".
average = finder.getAverage(image);	
</script>
USE;
?>			
			<pre><?=htmlentities($usage);?></pre>			
		</section>
	</div>
	<script>
		function findColour(key)
		{
			var image = $("example-" + key);
			var example = $("canvas-" + key);
			var button = example.select("a").shift();
			button.update("Working&hellip;");
			var blocks = example.select(".blocks").shift();

			var finder = new ColourFinder();
			var palette = finder.getPalette(image, 8);

			image.setStyle(
				{
					backgroundColor: "#" + palette[0]
				}
			);

			example.setStyle(
				{
					backgroundColor: "#" + palette[0]
				}
			);
			
			for(i = 0; i < palette.length; i++)
			{
				new Insertion.Bottom(blocks, new Element("div", { style: "background-color: #" + palette[i] }).update("#" + palette[i]));
			}
			
			button.remove();
		}
	</script>
</body>
</html>
