<html>
<head>
	<title>ColourFinder</title>

	<link rel="stylesheet/less" type="text/css" href="less/base.less" />
	
	<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1/prototype.js"></script>
	<script src="lib/ColourFinder/ColourFinder.js"></script>

	<script src="lib/less/dist/less-1.5.0.min.js" type="text/javascript"></script>

	<script src="//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
	<script>
	  WebFont.load({
	    google: {
	      families: ['Roboto']
	    }
	  });
	</script>
</head>
<body>
	<div class="page">
		<div class="hero">
			<div>
				<h1>ColourFinder</h1>
				<p>Lightweight library to extract the dominant colour palette from an image. Uses Javascript and Canvas.</p>
				<a href="https://raw.github.com/craigymunro/ColourFinder/master/ColourFinder.js" class="button">Download ColourFinder.js</a>
				<a href="https://github.com/craigymunro/ColourFinder" class="button">View on Github</a>
			</div>
		</div>

		<section class="what">
			<div>
				<h2>What is ColourFinder?</h2>
				<p>
					ColourFinder allows you to extract the dominant colours from an image.
				</p>
				
				<p>
					It works by identifying the colour of each individual pixel that makes up an image, and
					returns a list of the colours most seen in the image.
				</p>
			</div>
		</section>

		
		<section class="examples">
			<div>
				<h2>Examples</h2>
				<? foreach(explode(",", "monet,dali,great-wave,test,testcard,grass") as $key => $image) { ?>
					<div class="example" id="canvas-<?=$key?>">
						<div class="frame">
							<div class="canvas">
								<a href="javascript:findColour(<?=$key?>);"><img src="images/<?=$image?>.jpg" id="example-<?=$key?>"/></a>
							</div>
							<div>
								<a href="javascript:findColour(<?=$key?>);" class="button">Extract palette</a>
								<div class="blocks"></div>
								<div class="details"></div>
							</div>
						</div>
					</div>			
				<? } ?>
			</div>
		</section>
		
		<section class="usage">
<?
$usage = <<<USE
<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1/prototype.js"></script>
<script src="ColourFinder.js"></script>

<script>
// The image we'll be finding the palette for
var image = $("demo");

// Create a new instance of ColourFinder
var finder = new ColourFinder();

// Find the dominant colour in the image. Returns a single hex code, i.e: "0069ff".
dominant = finder.getDominant(image);

// Find the colour palette of the image. Returns an array of
// hex codes. Returns 10 colours by default.
// ["0069ff", "0069aa", "20ba20", etc]
palette = finder.getPalette(image, 10);

// Find the average colour of the image. Returns a single hex code, i.e. "00fa30".
average = finder.getAverage(image);
</script>
USE;
?>			
			<div>
				<h2>Usage</h2>
								
				<ol>
					<li>Include Prototype.js and ColourFinder.</li>
					<li>
						Call one of getDominant(), getPalette, or getAverage().
					</li>
				</ol>
				<pre><?=nl2br(htmlentities($usage));?></pre>
			</div>
		</section>
	</div>
	<script>
		function findColour(key)
		{
			var image = $("example-" + key);
			var example = $("canvas-" + key);
			var frame = example.select(".frame").shift();
			var button = example.select(".button").shift();
			var blocks = example.select(".blocks").shift();
			var details = example.select(".details").shift();
			
			var finder = new ColourFinder();
			var average = finder.getAverage(image);
			var palette = finder.getPalette(image);

			image.setStyle(
				{
					backgroundColor: "#" + palette[0]
				}
			);

			frame.setStyle(
				{
					backgroundColor: "#" + average
				}
			);

			button.remove();
						
			for(i = 0; i < palette.length; i++)
			{
				new Insertion.Bottom(blocks, new Element("div", { style: "background-color: #" + palette[i] }));
			}
			
			new Insertion.Bottom(details, "<strong>Average colour:</strong> #" + average + "<br/>");
			new Insertion.Bottom(details, "<strong>Dominant colour:</strong> #" + palette[0] + "<br/>");
			new Insertion.Bottom(details, "<strong>Palette:</strong> #" + palette.join(", #") + ".");
		}
	</script>
</body>
</html>
