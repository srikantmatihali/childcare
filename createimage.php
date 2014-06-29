<?php
function createThumb($img1,$img2,$schoolname,$name,$rollno,$gender,$address,$image_name) {
		$save_dir = "./images/idcard/";
		$dummystring = '';

		//specified width and height
		$maxwidth = 400;
		$maxheight = 400;
		$maxheight1 = 420;
		list($width, $height, $type) = @getimagesize($img1);
		
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
		
		//create image based on input image type.
		switch($type) {
		  case 1: $image1 = imagecreatefromgif($img1); 
		          //$image2 = imagecreatefromgif($img2);   
				  break;
		  case 2: $image1 = imagecreatefromjpeg($img1); 
				  //$image2 = imagecreatefromjpeg($img2);  	
				  break;
		  case 3: $image1 = imagecreatefrompng($img1); 
				  //$image2 = imagecreatefrompng($img2); 	
				  break;
		  default: return "Tried to create thumbnail from $img: not a valid image";
		}
		
		
		list($width2, $height2, $type2) = @getimagesize($img2);
		
		//resize code to proportionately resize image width and height.
		if ($maxwidth < $width2 && $width2 >= $height2) {
		  $thumbwidth = $maxwidth;
		  $thumbheight = ($thumbwidth / $width2) * $height2;
		}
		elseif ($maxheight < $height2 && $height2 >= $width2) {
		  $thumbheight = $maxheight;
		  $thumbwidth = ($thumbheight /$height2) * $width2;
		}
		else {
		  $thumbheight = $height2;
		  $thumbwidth = $width2;
		}
		
		//create image based on input image type.
		switch($type2) {
		  case 1: //$image1 = imagecreatefromgif($img1); 
		          $image2 = imagecreatefromgif($img2);   
				  break;
		  case 2: //$image1 = imagecreatefromjpeg($img1); 
				  $image2 = imagecreatefromjpeg($img2);  	
				  break;
		  case 3: //$image1 = imagecreatefrompng($img1); 
				  $image2 = imagecreatefrompng($img2); 	
				  break;
		  default: return "Tried to create thumbnail from $img: not a valid image";
		}
		
		//create a blank image.
		$imgbuffer1 = imagecreatetruecolor($thumbwidth, $thumbheight);
		$imgbuffer2 = imagecreatetruecolor($thumbwidth, $thumbheight);
		
		
		if (!$image1) return "Image creation from $img failed for an unknown reason. Probably not a valid image.";
		else {
		  
		  
		  //resize action function
		  imagecopyresampled($imgbuffer1, $image1, 0, 0, 0, 0, $thumbwidth, $thumbheight, $width, $height);		  
		  imagecopyresampled($imgbuffer2, $image2, 0, 0, 0, 0, $thumbwidth, $thumbheight, $width2, $height2);
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
				$imgx = ($maxwidth - $thumbwidth)/12;
				$imgx1 = ($maxwidth - $thumbwidth)/1.1;
		   }
		   if($thumbheight < $maxheight){
				$imgy = ($maxheight - $thumbheight)/6;
		   }
			
		   //rectangle fill
		  imagefilledrectangle($im, 0, 0, 400, 30, $red); 		
		
		  //merge the uploaded image with the template.
		  imagecopymerge($im, $imgbuffer1, $imgx, $imgy, 0, 0, 400, 400, 100); //have to play with these numbers for it to work for you, etc.
		  imagecopymerge($im, $imgbuffer2, $imgx1, $imgy, 0, 0, 400, 400, 100); //have to play with these numbers for it to work for you, etc. 
		   //imagealphablending( $im, false );
		   //imagesavealpha( $im, true );		
			
		   //The text to draw
		   $lines = $schoolname;
		   // Replace path by your own font path  //$font = 'fonts/impact.ttf';
		   $font = 'fonts/arial.ttf';
		   $font_size = 15;
		   $font_color =  0x111111;

		   $fontwidth = 8;
		   $line_length = round($maxwidth / $fontwidth);
		   
		   imagettftext($im, $font_size, 0, $imgx, 220, $white, $font, 'Name: '.$name);	
		   imagettftext($im, $font_size, 0, $imgx, 250, $white, $font, 'Roll No: '.$rollno);	
		   imagettftext($im, $font_size, 0, $imgx, 280, $white, $font, 'Gender: '.$gender);	
		   
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

			
		  //imagettftext($im, $font_size, 0, $imgx, 270, $white, $font, '');	
		  
		  $lines = 'Address: '.$address;	
		  $wordscount = strlen($lines);
		  $maxLen = 55;
		  if($wordscount>$maxLen){
			$lines = substr($lines,0,$maxLen);
		  }
		  
		  $line_length = round(($maxwidth-100) / $fontwidth);//die;
		  
		  $lines = explode('|', wordwrap($lines, $line_length, '|'));
		  $y = 310;
		   //This is to add multiple lines .
		   foreach ($lines as $line)
		   {
				//$font_size++;
				$p = imagettfbbox($font_size,0,$font,$line);
		
				$txt_width=$p[2]-$p[0];				
				//		print_r($p);die;
				
				//Add text
				imagettftext($im, $font_size, 0, $imgx, $y, $white, $font, $line);		
				
				// Increment Y so the next line is below the previous line
				$y += 29;
			}
			
	
			//rectangle fill
			imagefilledrectangle($im, 0, 360, 400, $maxheight1, $red);

			//bottom text for happy friendship day
			$bottomtext1 = "TRADEMARK COPY";
			$font_size = 20;
			imagettftext($im, $font_size, 0, 10, 390, $white, $font, $bottomtext1);

			//tagged by data at bottom
			$bottomtext2 = "www.trackchild.com";
			if($_GET){ 	
					$bottomtext2 .= ' '.$_GET['u'];		
			}
			$font_size = 10;
			imagettftext($im, $font_size, 0, 10, 410, $black, $font, $bottomtext2);


			//imagealphablending($im, false);
			//imagesavealpha($im, true);
			$logoimg = imagecreatefromjpeg('images/logo-small.jpg');
			imagecopymerge($im, $logoimg, 340, 370, 0, 0, 40, 40, 100); //have to play with these numbers for it to work for you, etc.
			
			// Using imagepng() results in clearer text compared with imagejpeg()
			imagejpeg($im,$save_dir.$image_name);
			//imagejpeg($im); 
			//imagejpeg($im);
			//imagedestroy($im);
			//echo $name;
		}	
}  
?>