<?php header('Content-Type: image/jpeg');

function createThumb($img,$name,$dummystring) {
		$save_dir = "./images/"; 	

		//specified width and height
		$maxwidth = 500;
		$maxheight = 500;
		$maxheight1 = 562;
		list($width, $height, $type) = @getimagesize($img);
		
		//resize code to proportionately resize image width and height.
		if ($maxwidth < $width && $width >= $height) {
		  $thumbwidth = $maxwidth;
		  $thumbheight = ($thumbwidth / $width) * $height;
		}
		elseif ($maxheight < $height && $height >= $width) {
		  $thumbheight = $maxheight;
		  $thumbwidth = ($thumbheight /$height) * $width;
		}
		else {
		  $thumbheight = $height;
		  $thumbwidth = $width;
		}
		
		//create a blank image.
		$imgbuffer = imagecreatetruecolor($thumbwidth, $thumbheight);
		
		//create image based on input image type.
		switch($type) {
		  case 1: $image = imagecreatefromgif($img); break;
		  case 2: $image = imagecreatefromjpeg($img); break;
		  case 3: $image = imagecreatefrompng($img); break;
		  default: return "Tried to create thumbnail from $img: not a valid image";
		}
		if (!$image) return "Image creation from $img failed for an unknown reason. Probably not a valid image.";
		else {
		  
		  //resize action function
		  imagecopyresampled($imgbuffer, $image, 0, 0, 0, 0, $thumbwidth, $thumbheight, $width, $height);
		  //imageinterlace($imgbuffer); // imagejpeg($imgbuffer); //  imagedestroy($imgbuffer);	  
		 		  
			//Create the image
			$im = imagecreatetruecolor($maxwidth, $maxheight1);	
			// Create some colors
			$green = imagecolorallocate($im, 500, 500, 28);
			$white = imagecolorallocate($im, 255, 255, 255);
			$grey = imagecolorallocate($im, 128, 128, 128);
			$black = imagecolorallocate($im, 0, 0, 0);
			$red = imagecolorallocate($im, 140, 8, 45);	

		  /*$filename = 'images/1.jpg';
		    $centerimg = imagecreatefromjpeg($filename);
			list($width, $height) = getimagesize($filename);*/

		   //center the image according to the uploaded image size.	
		   $imgx = 0;
		   $imgy = 0;
		   if($thumbwidth < $maxwidth){
				$imgx = ($maxwidth - $thumbwidth)/2;
		   }
		   if($thumbheight < $maxheight){
				$imgy = ($maxheight - $thumbheight)/2;
		   }
		   //merge the uploaded image with the template.
		   imagecopymerge($im, $imgbuffer, $imgx, $imgy, 0, 0, 500, 500, 100); //have to play with these numbers for it to work for you, etc.
		   //imagecopymerge($im, $logoimg, 430, 510, 0, 0, 60, 38, 100); //have to play with these numbers for it to work for you, etc.
		   //imagealphablending( $im, false );
		   //imagesavealpha( $im, true );		
			
		   //The text to draw
		   $lines = 'sri vani high school';
		   // Replace path by your own font path
		   $font = 'fonts/impact.ttf';
		   $font_size = 15;
		   $font_color =  0x111111;

		   $fontwidth = 8;
		   $line_length = round($maxwidth / $fontwidth);
		   
			// find font-size for $txt_width = 80% of $img_width...
			//$font_size = 1; 
			$txt_max_width = intval(0.8 * $maxwidth);
		   $line_length = 60;
			
		   $lines = explode('|', wordwrap($lines, $line_length, '|'));
		   $y = 20;
		   //This is to add multiple lines .
		   foreach ($lines as $line)
		   {
				//$font_size = 1;
				//do {

					//$font_size++;
					$p = imagettfbbox($font_size,0,$font,$line);
					$txt_width=$p[2]-$p[0];				
				//} while ($txt_width <= $txt_max_width);
				$tempX = ($maxwidth - $txt_width) / 2;								
				
				// Add some shadow to the text
				imagettftext($im, $font_size, 0, ($tempX+2), ($y+2), $grey, $font, $line);
				
				//Add text
				imagettftext($im, $font_size, 0, $tempX, $y, $white, $font, $line);		
				
				// Increment Y so the next line is below the previous line
				$y += 29;
			}

			//second message addition
			$dummystring = 'Tested and Tried';
			$dummystring = 'Loremipsumdolorsitamet, consectetur adipiscing elit. Integer non nunc lectus.Curabiturhendrerit bibendum enim dignissim';	
			$dummystring = explode('|', wordwrap($dummystring, $line_length, '|')); 
			$y = 450;	
			foreach ($dummystring as $line)
		     {
				//$font_size = 1;
				//do {

					//$font_size++;
					$p = imagettfbbox($font_size,0,$font,$line);
					$txt_width=$p[2]-$p[0];				
				//} while ($txt_width <= $txt_max_width);
				$tempX = ($maxwidth - $txt_width) / 2;								
				
				// Add some shadow to the text
				//imagettftext($im, $font_size, 0, ($tempX+2), ($y+2), $grey, $font, $line);
				
				//Add text
				imagettftext($im, $font_size, 0, $tempX, $y, $white, $font, $line);		
				
				// Increment Y so the next line is below the previous line
				$y += 29;
			 }
			
			
			//imagettftext($im, $font_size, 0, 14, 452, $grey, $font, $dummystring);
			//imagettftext($im, $font_size, 0, 12, 450, $white, $font, $dummystring);

			//rectangle fill
			imagefilledrectangle($im, 0, 500, 500, $maxheight1, $red);

			//bottom text for happy friendship day
			$bottomtext1 = "HAPPY FRIENDSHIP DAY";
			$font_size = 28;
			imagettftext($im, $font_size, 0, 10, 540, $white, $font, $bottomtext1);

			//tagged by data at bottom
			$bottomtext2 = "www.cafecoffeeday.com";
			if($_GET){ 	
					$bottomtext2 .= ' '.$_GET['u'];		
			}
			$font_size = 10;
			imagettftext($im, $font_size, 0, 10, 555, $black, $font, $bottomtext2);


			//imagealphablending($im, false);
			//imagesavealpha($im, true);
			$logoimg = imagecreatefromjpeg('images/logo-small.jpg');
			imagecopymerge($im, $logoimg, 430, 510, 0, 0, 60, 38, 100); //have to play with these numbers for it to work for you, etc.
			
			// Using imagepng() results in clearer text compared with imagejpeg()
			//imagejpeg($im,$save_dir.$name);
			//imagejpeg($im); 
			imagejpeg($im);
			imagedestroy($im);
			echo $name;
		}	
}  

//print_r($_FILES); print_r($_POST); die();
if($_POST){ //print_r($_POST); die();
	$dummystring = 'Loremipsumdolorsitamet, consectetur adipiscing elit. Integer non nunc lectus.Curabiturhendrerit bibendum enim dignissim';	
	//echo $dummystring = $_POST['dummystring']; die();
	if(isset($_FILES['file']) && !empty($_FILES['file']['name'])) 
	{ 
		$save_dir = "./images/"; 
		$img = $fn = $_FILES['file']['tmp_name'];
		$temp_name = $_FILES['file']['name'];
		$save_name = strtotime("now").$temp_name;		
		$size = getimagesize($fn);
		$ratio = $size[0]/$size[1]; // width/height
		$filesize = $_FILES['file']['size'];
		$dummystring = ''; 
		if(isset($_POST['dummystring'])){
			$dummystring = $_POST['dummystring']; 
		}
		
		//filesize check.
		if($filesize>3057152){
				echo 'Error'; die();
		}else{
			createThumb($img,$save_name,$dummystring);
		}
	}
}

$dummystring = 'Loremipsumdolorsitamet, consectetur adipiscing elit. Integer non nunc lectus.Curabiturhendrerit bibendum enim dignissim';	
$imagefile = 'http://localhost/trackchild/images/dummyuser.png';
$name = 'srikanthnew1.jpg';
//$filesize = filesize($imagefile);
createThumb($imagefile,$name,$dummystring);	
?>