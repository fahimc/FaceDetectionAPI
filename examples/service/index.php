<?php
require_once ('../../cascades/haarcascade_frontalface_alt.php');
require_once ('../../cascades/smiled_01.php');
require_once ('../../cascades/smiled_02.php');
require_once ('../../cascades/smiled_03.php');
require_once ('../../cascades/smiled_04.php');
require_once ('../../cascades/smiled_05.php');
require_once ('../../cascades/haarcascade_mcs_mouth.php');
require_once ('../../cascades/haarcascade_eye.php');
require_once ('../../cascades/haarcascade_mcs_eyepair_small.php');
require_once ('../../cascades/haarcascade_mcs_eyepair_big.php');
require_once ('../../cascades/haarcascade_mcs_nose.php');
require_once ('../../src/haar-detector.class.php');
require_once ('SimpleImage.php');
function random_color_part() {
	return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color() {
	return random_color_part() . random_color_part() . random_color_part();
}
$imgPath = "../imgs/s.jpg";
?>
<html>
	<link type="text/css" rel="stylesheet" href="style.css" />
	<body>
		<ul class="wrapper">
			<li class="leftHolder">
		<img src="<?php echo $imgPath; ?>" style="width:400px;" />
		
		<?php
		 $simpleImage = new SimpleImage();
		$img = $imgPath;
		$smiles = array();
		$eyes = array();
		$noses = array();
		$mouths = array();
		$faces = array();
		$smileColor= "#E01B6A";
		$eyeColor= "#00f";
		$noseColor= "#0f0";
		$mouthColor= "yellow";
		$faceColor="#f00";
		
		$simpleImage->load($imgPath);
		$simpleImage->resizeToWidth(400);
		$source_img=$simpleImage->image;
		// $source_img = imagecreatefromjpeg($img);
		
		$facedetector = new HAARDetector($smiled_01);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$smiles = array_merge($smiles, $facedetector -> objects);
		
		$facedetector = new HAARDetector($smiled_02);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$smiles = array_merge($smiles, $facedetector -> objects);
		
		$facedetector = new HAARDetector($smiled_03);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$smiles = array_merge($smiles, $facedetector -> objects);
		
		$facedetector = new HAARDetector($smiled_04);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$smiles = array_merge($smiles, $facedetector -> objects);
		
		$facedetector = new HAARDetector($smiled_05);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$smiles = array_merge($smiles, $facedetector -> objects);
		
		$facedetector = new HAARDetector($haarcascade_mcs_mouth);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$mouths = array_merge($mouths, $facedetector -> objects);
		
		$facedetector = new HAARDetector($haarcascade_eye);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$eyes = array_merge($eyes, $facedetector -> objects);
		
		$facedetector = new HAARDetector($haarcascade_mcs_eyepair_small);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$eyes = array_merge($eyes, $facedetector -> objects);
		
		$facedetector = new HAARDetector($haarcascade_mcs_eyepair_big);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$eyes = array_merge($eyes, $facedetector -> objects);
		
		$facedetector = new HAARDetector($haarcascade_mcs_nose);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$noses = array_merge($noses, $facedetector -> objects);

		$facedetector = new HAARDetector($haarcascade_frontalface_alt);
		$facedetector -> setImage($source_img, 0.25);
		$foundsth = $facedetector -> detect(1, 1.25, 0.1, 1, false);
		$faces = array_merge($faces, $facedetector -> objects);
		
		if (sizeof($smiles)>0) {
			
			createDiv($smiles,$smileColor);

		}
		if (sizeof($faces)>0) {
			createDiv($faces,$faceColor);

		}
		if (sizeof($eyes)>0) {
			createDiv($eyes,$eyeColor);

		}
		if (sizeof($noses)>0) {
			createDiv($noses,$noseColor);

		}
		if (sizeof($mouths)>0) {
			createDiv($mouths,$mouthColor);

		}
		function createDiv($objectsArray,$color)
		{
			foreach ($objectsArray as $obj) {
				$x = $obj['x'];
				$y = $obj['y'];
				$w = $obj['width'];
				$h = $obj['height'];
				$c =$color;
				$div = '<div style="position: absolute;top: [y];left: [x]; width: [w];height: [h]; border:3px solid [c];" ></div>';
				$div = str_replace('[x]', $x, $div);
				$div = str_replace('[y]', $y, $div);
				$div = str_replace('[w]', $w, $div);
				$div = str_replace('[h]', $h, $div);
				$div = str_replace('[c]', $c, $div);
				echo $div;
			}
		}
	?>
	</li>
	<li class="rightHolder">
		<ul>
			<li>
				<div style="width:50px;height:50px;background-color: <?php echo $faceColor; ?>"></div>
			</li>
			<li>
				Face
			</li>
			<li class="clearBoth"></li>
		</ul>
		<ul>
			<li>
				<div style="width:50px;height:50px;background-color: <?php echo $mouthColor; ?>"></div>
			</li>
			<li>
				Mouth
			</li>
			<li class="clearBoth"></li>
		</ul>
		<ul>
			<li>
				<div style="width:50px;height:50px;background-color: <?php echo $smileColor; ?>"></div>
			</li>
			<li>
				Smiles
			</li>
			<li class="clearBoth"></li>
		</ul>
		<ul>
			<li>
				<div style="width:50px;height:50px;background-color: <?php echo $eyeColor; ?>"></div>
			</li>
			<li>
				Eyes
			</li>
			<li class="clearBoth"></li>
		</ul><ul>
			<li>
				<div style="width:50px;height:50px;background-color: <?php echo $noseColor; ?>"></div>
			</li>
			<li>
				Nose
			</li>
			<li class="clearBoth"></li>
		</ul>
	</li>
	<li class="clearBoth"></li>
	</ul>
	</body>
</html>