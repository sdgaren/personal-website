<?php 
function background_image()
{
	$returnString = '
		url(\'data:image/svg+xml,<%3Fxml version="1.0" encoding="UTF-8" standalone="no"%3F><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
	<svg width="100%" height="100%" viewBox="0 0 4000 4000" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
	<rect x="0" y="0" width="5000" height="5000" style="fill:rgb(16,0,32);"/>
	';
	
	for ($i = 0; $i <= 2000; $i++) {
		$x = rand(0, 4000); # x position
		$y = rand(0, 4000); # y position
		$s = 4 - floor(log(rand(1, 80), 3)); #size variable, weighted distribution
			
		# set transparency for smallest radius
		if ($s == 1) {
			$a = rand(50, 100) / 100;
		} else {
			$a = 1;
		}
		
		# set color
		$r = min(255, rand(170, 400));
		$g = $r;
		$b = 255;
		
		
		$returnString = $returnString.'<circle cx="'.$x.'" cy="'.$y.'" r="'.$s.'" fill="rgb('.$r.', '.$g.', '.$b.')" fill-opacity="'.$a.'"/>';
	}
	
	$returnString = $returnString.'</svg>\')';
	
	$returnString = str_replace(PHP_EOL, '', $returnString);

	return $returnString;
}



function location_map($latitude,$longitude)
{
	$xTranslate = -$longitude / 8;
	$yTranslate = max(min($latitude / 8, 5.25), -5.25);
	
	$returnString = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<svg width="14" height="14" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
	<rect id="BG" x="0" y="0" width="14" height="14" style="fill:white;"/>
	<path id="Map" transform="translate('.$xTranslate.','.$yTranslate.')" d="M-22.5,15.25L-20.5,15.25L-20.25,15.5L-18.75,15.5L-18.5,15.75L-17,15.75L-16.75,16L-17,16.25L-17.25,16.25L-17.5,16.5L-17.5,16.75L-13,16.75L-12.75,16.5L-11.5,16.5L-11.25,16.25L-9,16.25L-8.75,16L-8.5,16.25L-6.25,16.25L-6,16.5L-5.75,16.25L-6,16L-4.25,16L-4,16.25L-3.25,16.25L-3,16L-2.5,16L-2.5,15.75L-2.25,15.75L-2,15.5L-1.5,15.5L-0.75,14.75L0.25,14.75L0,15L-0.25,15L-0.5,15.25L-0.5,16.25L-0.25,16.5L0.25,16.5L0.5,16.75L2.75,16.75L4.75,16.5L3.5,16.5L3.75,16.25L4.25,16.25L4.5,16L5.5,16L5.75,15.75L10.5,15.75L10.75,15.5L11.5,15.5L11.5,15.75L12,15.75L12.25,15.5L12.75,15.5L13,15.25L14,15.25L14.25,15.5L15.75,15.5L16,15.75L16.5,15.75L16.75,15.5L17,15.5L17.25,15.25L18.75,15.25L19,15L19.25,15.25L21.25,15.25L21.5,15.5L22.25,15.5L22.5,15.25L24.5,15.25L24.75,15.5L26.25,15.5L26.5,15.75L28,15.75L28.25,16L28,16.25L27.75,16.25L27.5,16.5L27.5,16.75L32,16.75L32.25,16.5L33.5,16.5L33.75,16.25L36,16.25L36.25,16L36.5,16.25L36.5,18.25L-22.5,18.25L-22.5,15.25ZM-3.25,6L-4,5.25L-4.5,5.25L-4.75,5L-5.5,5L-5.75,4.75L-6,4.75L-6.25,4.5L-6.25,4.25L-7,3.5L-7,3.75L-6.75,4L-6.75,4.25L-7.25,3.75L-7.25,3.5L-7.75,3L-7.75,2.75L-8,2.75L-8.5,2.25L-8.5,1.25L-9,0.75L-9,0.5L-9.25,0.25L-9.5,0.25L-10,-0.25L-10.25,-0.25L-10.5,-0.5L-12.25,-0.5L-12.25,-0.25L-12.5,-0.25L-13,0.25L-13,0L-12.75,-0.25L-13.25,-0.25L-13.75,-0.75L-13.5,-1L-13.75,-1L-14,-1.25L-13.5,-1.75L-13,-1.75L-12.75,-2L-12.25,-2L-12,-1.75L-10.5,-1.75L-10.25,-1.5L-10,-1.75L-8,-1.75L-7.75,-1.5L-7.25,-1.5L-7.75,-2L-8.75,-2L-8.5,-2.25L-7.5,-2.25L-7.75,-2.5L-8.25,-2.5L-8,-2.75L-6.75,-2.75L-7,-2.5L-6.75,-2.5L-6.5,-2.75L-6.5,-2.5L-6.25,-2.5L-6.5,-2.25L-7.25,-2.25L-7,-2L-6.75,-2L-6.5,-2.25L-6,-2.25L-6,-2L-5.5,-1.5L-5.25,-1.75L-5,-1.75L-5,-2L-5.5,-2L-5.75,-2.25L-5.5,-2.25L-5.75,-2.5L-6.25,-2.5L-6.25,-3L-5.75,-3L-5.5,-2.75L-5,-3.25L-3.5,-3.25L-3.25,-3.5L-1.5,-3.5L-1.25,-3.25L0.5,-3.25L0.75,-3.5L3.75,-3.5L4,-3.25L5.5,-3.25L5.25,-3L4.75,-3L4.75,-2.25L4.25,-2.25L4.25,-1.75L4,-1.5L3,-1.5L2.75,-1.25L2.25,-1.25L1.5,-0.5L1,-0.5L0.25,-1.25L0.25,-1.5L0,-1.75L0,-2L-0.5,-2.5L-1.75,-2.5L-2,-2.75L-1.75,-3L-2,-3L-2.25,-2.75L-2.75,-2.75L-2.75,-2.5L-3,-2.5L-3,-2.25L-2.75,-2.25L-2.5,-2L-2,-2L-1.75,-1.75L-1.5,-1.75L-1.25,-1.5L-1,-1.5L-0.75,-1.25L-1.5,-1.25L-1.25,-1L-1,-1L-1,-0.75L-1.75,-0.75L-2,-1L-2.75,-1L-2.5,-1.25L-2.25,-1.25L-2,-1.5L-2.75,-1.5L-3,-1.75L-3.25,-1.75L-3.25,-1.5L-3.5,-1.25L-3.25,-1L-3.75,-1L-3.75,-1.25L-4,-1L-4.25,-1L-4.75,-0.5L-4.5,-0.25L-4.25,-0.25L-4,0L-3.25,0L-3.25,0.25L-3,0.5L-2.75,0.5L-3,0.25L-2.75,0L-2.75,-0.75L-2,-0.75L-1.5,-0.25L-1.25,-0.5L-1,-0.5L-0.25,0.25L0,0.25L0,0.75L0.25,0.75L0.5,1L0.25,1.25L0.25,1L-0.5,1L-0.25,0.75L-1.25,0.75L-1,1L-1,1.25L-0.5,1.25L-0.75,1.5L-1.25,1.5L-1.25,1.25L-1.5,1.5L-1.75,1.5L-1.75,1.75L-2,2L-2.25,2L-2.5,2.25L-2.5,2.5L-3,3L-3,3.75L-3.25,3.75L-3.5,3.5L-3.5,3.25L-4,3.25L-4.25,3.5L-4.5,3.5L-4.75,3.25L-5.25,3.75L-5.25,4.25L-4.75,4.75L-4.5,4.75L-4.25,4.5L-4.25,4.25L-3.75,4.25L-4,4.5L-4,5L-3.5,5L-3.5,5.5L-3.25,5.75L-3,5.75L-2.75,6L-2.25,5.5L-2,5.5L-2,5.75L-1.75,5.5L-1.5,5.5L-1.5,5.75L-0.5,5.75L0,6.25L0.25,6.25L1,7L1.25,7L1.5,7.25L2,7.25L2.5,7.75L2.75,7.75L2.75,8L2.25,8.5L2.25,9.25L2,9.5L2,9.75L1.75,10L1.25,10L1,10.25L1,10.5L-0.5,12L-0.75,12L-0.75,12.25L-1,12.25L-1,12.5L-1.25,12.75L-1.5,12.75L-1.25,13L-1.5,13.25L-1.5,13.75L-1.25,13.75L-1,14L-2,14L-2.5,13.5L-2.5,12.75L-2.25,12.5L-2.25,11.5L-2,11.25L-2,10.5L-1.75,10.25L-1.75,9.25L-2,9.25L-2.75,8.5L-2.75,8.25L-3.25,7.75L-3.25,7.5L-3,7.25L-3,6.75L-2.75,6.5L-2.75,6L-3.25,6ZM-0.25,13.25L-0.5,13.25L-0.75,13.5L-0.5,13.5L-0.25,13.25ZM-16.5,11.25L-16.25,11.25L-16,11.5L-16,11.75L-15.75,11.75L-16.75,12.75L-17.25,12.75L-16.5,12L-16.25,12L-16.25,11.5L-16.5,11.25ZM28.5,11.25L28.75,11.25L29,11.5L29,11.75L29.25,11.75L28.25,12.75L27.75,12.75L28.5,12L28.75,12L28.75,11.5L28.5,11.25ZM-20,12L-20,12.25L-19.75,12.5L-19.5,12.5L-19.5,12L-19.75,12.25L-20,12ZM25,12L25,12.25L25.25,12.5L25.5,12.5L25.5,12L25.25,12.25L25,12ZM-22.5,9L-22.5,11.25L-22.25,11L-21.25,11L-21,11.25L-20.75,11.25L-20.75,11.5L-20.5,11.75L-19.25,11.75L-19.25,11.5L-18.75,11L-18.75,10.25L-19.75,9.25L-19.75,8.75L-20,8.75L-20,8.5L-20.25,8.25L-20.25,9L-20.5,9.25L-21,8.75L-21,8.5L-21.75,8.5L-22,8.75L-22.25,8.75L-22.5,9ZM24.75,8.25L24.75,9L24.5,9.25L24,8.75L24,8.5L23.25,8.5L23,8.75L22.75,8.75L22,9.5L21.5,9.5L21.25,9.75L21.25,10.5L21.5,10.75L21.5,11.25L22.5,11.25L22.75,11L23.75,11L24,11.25L24.25,11.25L24.25,11.5L24.5,11.75L25.75,11.75L25.75,11.5L26.25,11L26.25,10.25L25.25,9.25L25.25,8.75L25,8.75L25,8.5L24.75,8.25ZM19.25,-3L19.5,-3L19.5,-2.75L19.75,-3L20,-2.75L20.5,-2.75L20.75,-2.5L21.25,-2.5L21,-2.25L22,-2.25L22.25,-2L22.5,-2.25L23.25,-2.25L23.25,-2L23.5,-1.75L23.75,-2L24.25,-2L24.5,-2.25L24.25,-2.25L24,-2.5L25.25,-2.5L25,-2.25L25,-2L25.75,-2L26,-1.75L26.25,-1.75L26.5,-2L27,-2L27,-1.75L29.25,-1.75L29.5,-2L29.75,-2L29.5,-1.75L29.75,-1.5L30.5,-1.5L30.75,-1.25L30.5,-1.25L30.5,-1L30.25,-1L30,-1.25L29.5,-1.25L29.25,-1L29.5,-0.75L28.75,-0.75L28.5,-0.5L27.5,-0.5L27.25,-0.25L27.5,-0.25L27.5,0L27.25,0L27.25,0.25L27,0.25L26.5,0.75L26.5,0L27,-0.5L27,-0.75L26.5,-0.75L26.25,-0.5L24.75,-0.5L24.25,0L24,0L24.25,0.25L25,0.25L25,0.75L24.75,1L25,1.25L24.75,1.25L24.75,0.5L24.5,0.5L24.5,1L24,1.5L23.5,1.5L23,2L23.25,2.25L23.25,2.5L23,2.75L22.75,2.75L22.75,2.25L22.5,2L22,2L21.75,2.25L22.25,2.25L22,2.5L22,2.75L22.25,3L22.25,3.5L21.5,4.25L21,4.25L21,4.5L20.75,4.75L20.5,4.75L20.75,4.5L20.75,4.25L20.5,4.25L20.25,4.5L20.25,4.75L20.75,5.25L20.75,5.5L20.25,6L20,6L20,5.75L19.5,5.25L19.5,6L20,6.5L20,7L20.25,7.25L20.5,7.25L20.25,7.5L20.25,7.75L21.25,7.75L21.5,8L20.25,8L20.25,7.75L20,7.75L19.5,7.25L19.5,7L19,6.5L19,6.25L19.25,6.25L19.5,6.5L19.5,6.25L19.25,6L19.25,5L18.75,5L18.75,4.5L18.5,4.25L18,4.25L17.25,5L17,5L17,5.75L17.25,6L17.25,6.25L17,6.25L17,5.75L16.75,6L16.25,5.5L16.25,5L16,4.75L16,4.5L15.25,3.75L13.75,3.75L13.25,3.25L13,3.25L13,3.5L13.5,4L13.75,4L14,3.75L14,4L14.25,4L14.5,4.25L14.25,4.5L14.25,4.75L14,4.75L13.75,5L13.5,5L13.25,5.25L12.75,5.25L12.5,5.5L12.5,5L12,4.5L12,4.25L11.25,3.5L11.25,3.75L11.75,4.25L11.75,4.75L12.5,5.5L12.5,5.75L12.75,5.5L13.5,5.5L13.5,6L12,7.5L12,9L11.5,9.5L11.5,10L11.25,10.25L11,10.25L11,10.75L10.5,11.25L9.25,11.25L9.25,11L8.75,10.5L8.75,9.75L8.5,9.5L8.5,8.75L8.75,8.5L8.75,8.25L8.5,8L8.5,7.75L8,7.25L8,7L8.25,6.75L8.25,6.5L7.75,6.5L7.5,6.25L7,6.25L6.75,6.5L5.75,6.5L4.75,5.5L4.75,5.25L5,5L5,4.75L4.75,4.5L4.75,4.25L5.25,3.75L5.25,3.5L5.5,3.5L5.75,3.25L5.75,3L6.25,2.5L5.75,2.5L5.75,1.75L6,1.5L6.75,1.5L6.75,1.25L6.5,1L6.75,1L6.75,0.75L6.25,0.75L6.5,0.5L6.25,0.5L6.5,0.25L6.25,0L6.25,0.5L5.75,0.5L5.75,0.25L6,0L6.25,0L6,-0.25L6.25,-0.25L6.5,-0.5L6.5,-0.25L6.75,-0.25L6.5,0L6.75,0L7.25,0.5L7,0.75L7.25,0.75L7.5,0.5L7.5,0.25L8,0.25L8,0L8.25,-0.25L8.25,0L8.5,0L8.5,-0.25L8.25,-0.5L8,-0.25L7.75,-0.25L7.75,-0.75L8,-1L8.25,-1L8.75,-1.5L9,-1.5L9.25,-1.75L9.75,-1.75L10,-2L10.5,-2L10.75,-1.75L11.75,-1.75L12,-1.5L12.25,-1.5L12,-1.25L12.5,-1.25L12.5,-1.5L14.5,-1.5L14.25,-1.75L15,-1.75L15.25,-1.5L15.5,-1.5L15.25,-1.75L15.25,-2L15.5,-2L15.75,-2.25L16,-2.25L16.25,-2L17,-2L17,-2.25L17.75,-2.25L18,-2.5L19.5,-2.5L19.75,-2.75L19,-2.75L18.75,-3L18.25,-3L18.75,-3.25L19,-3.25L19.25,-3ZM13.25,8.5L13.25,9.5L13,9.75L13,10L12.75,10.25L12.5,10.25L12.5,9L12.75,9L13,8.75L13,8.5L13.25,8.5ZM23.25,7L23.5,7.25L23.5,7.5L24,7.5L24.25,7.75L24.25,8L24.5,8L24.75,8.25L25,8.25L25,8L25.25,8L25.5,8.25L25.75,8.25L25.5,8L25.5,7.75L25.25,7.5L25,7.5L24.75,7.25L23.75,7.25L23.75,7L23.25,7ZM-21.75,7L-21.5,7.25L-21.5,7.5L-21,7.5L-20.75,7.75L-20.75,8L-20.5,8L-20.25,8.25L-20,8.25L-20,8L-19.75,8L-19.5,8.25L-19.25,8.25L-19.5,8L-19.5,7.75L-19.75,7.5L-20,7.5L-20.25,7.25L-21.25,7.25L-21.25,7L-21.75,7ZM22.75,6.75L22.5,7L22.25,7L22.25,7.25L22.5,7.5L22.5,7.75L22,7.25L22,7.75L21.75,7.75L21.75,7.25L22.25,6.75L22.75,6.75ZM21.75,6L21.75,7L21.5,7.25L21.5,7.5L20.75,7.5L20.75,7.25L20.5,7L20.5,6.75L21,6.75L21.75,6ZM-22.5,6.75L-22.25,6.75L-22.5,7L-22.5,6.75ZM22.25,4.75L22,4.75L22,5.25L22.25,5.5L22.25,5.75L22.5,6L22.25,6L22.25,6.25L22.5,6L22.5,6.25L22.75,6.25L22.75,5.75L22.5,6L22.5,5.75L22.75,5.75L22.75,5.5L22.5,5.25L22.25,5.25L22.25,4.75ZM-22.5,6L-22.5,6.25L-22.25,6.25L-22.25,5.75L-22.5,6ZM-22.25,5.5L-22.5,5.25L-22.5,5.75L-22.25,5.75L-22.25,5.5ZM-1.5,4.75L-2.25,4.75L-2,4.5L-1.75,4.5L-1.5,4.75ZM-2.25,4.5L-2.75,4.5L-3,4.25L-3.5,4.25L-3.25,4L-3,4L-2.75,4.25L-2.5,4.25L-2.25,4.5ZM22.25,3.75L22,4L22,4.25L22.25,4L22.25,3.75ZM-20.25,1.25L-20.25,1.5L-20.5,1.75L-20.5,2L-21,2.5L-21.5,2.5L-21.75,2.75L-21.75,3.25L-21.5,3L-21.25,3L-21,2.75L-20.75,2.75L-20.25,2.25L-20.25,1.75L-20,1.75L-19.75,1.5L-20,1.5L-20.25,1.25ZM11.25,3L11.5,2.75L11.5,2.5L11.25,2.5L11.25,2.75L11,2.75L11.25,2.5L10.5,2.5L10.25,2.25L10.25,2L9.75,2L10,2.25L9.75,2.5L9.5,2.25L9.5,1.75L9.25,1.75L8.75,1.25L8.5,1.25L8.5,1.5L8.75,1.5L9.25,2L9,2L9.25,2.25L9,2.25L9,2.5L8.75,2.5L8.5,2.25L9,2.25L9,2L8.75,2L8.25,1.5L7.5,1.5L7.5,1.75L7.25,1.75L7,2L7,2.25L6.75,2.5L7,2.5L7.25,2.25L8.25,2.25L8.25,2.75L8.5,3L9,3L9.25,3.25L9.5,3.25L9.5,3L10.25,3L10.5,3.25L10.75,3L11.25,3ZM24.75,1.25L24.75,1.5L24.5,1.75L24.5,2L24,2.5L23.5,2.5L23.25,2.75L23.25,3.25L23.5,3L23.75,3L24,2.75L24.25,2.75L24.75,2.25L24.75,1.75L25,1.75L25.25,1.5L25,1.5L24.75,1.25ZM-22.5,-2.25L-21.75,-2.25L-21.75,-2L-21.5,-1.75L-21.25,-2L-20.75,-2L-20.5,-2.25L-20.75,-2.25L-21,-2.5L-19.75,-2.5L-20,-2.25L-20,-2L-19.25,-2L-19,-1.75L-18.75,-1.75L-18.5,-2L-18,-2L-18,-1.75L-15.75,-1.75L-15.5,-2L-15.25,-2L-15.5,-1.75L-15.25,-1.5L-14.5,-1.5L-14.25,-1.25L-14.5,-1.25L-14.5,-1L-14.75,-1L-15,-1.25L-15.5,-1.25L-15.75,-1L-15.5,-0.75L-16.25,-0.75L-16.5,-0.5L-17.5,-0.5L-17.75,-0.25L-17.5,-0.25L-17.5,0L-17.75,0L-17.75,0.25L-18,0.25L-18.5,0.75L-18.5,0L-18,-0.5L-18,-0.75L-18.5,-0.75L-18.75,-0.5L-20.25,-0.5L-20.75,0L-21,0L-20.75,0.25L-20,0.25L-20,0.75L-20.25,1L-20,1.25L-20.25,1.25L-20.25,0.5L-20.5,0.5L-20.5,1L-21,1.5L-21.5,1.5L-22,2L-21.75,2.25L-21.75,2.5L-22,2.75L-22.25,2.75L-22.25,2.25L-22.5,2L-22.5,-2.25ZM13,1.25L13,1.75L13.25,2L13.25,2.25L13.5,2.5L13.75,2.5L13.75,2L13.25,1.5L13.5,1.25L13,1.25ZM12.25,1.75L11.75,1.25L11.25,1.25L11.5,1.5L11,1.5L11.25,1.25L10.75,1.25L10.5,1.5L10.5,1.75L11.75,1.75L12,2L12.25,1.75ZM8,1.75L8,2L8.25,2L8.25,1.75L8,1.75ZM-4.5,1.25L-3.75,1.25L-4,1.5L-4,1.75L-3.75,1.75L-3.75,1.5L-3.5,1.25L-3.25,1.5L-3,1.5L-3.25,1.25L-3.5,1.25L-3.5,1L-4.25,1L-4.5,1.25ZM-2.5,1.5L-2.75,1.75L-3.25,1.75L-3,1.5L-2.5,1.5ZM36.5,1.25L36,0.75L36,0.5L35.75,0.25L35.5,0.25L35,-0.25L34.75,-0.25L34.5,-0.5L32.75,-0.5L32.75,-0.25L32.5,-0.25L32,0.25L32,0L32.25,-0.25L31.75,-0.25L31.25,-0.75L31.5,-1L31.25,-1L31,-1.25L31.5,-1.75L32,-1.75L32.25,-2L32.75,-2L33,-1.75L34.5,-1.75L34.75,-1.5L35,-1.75L36.5,-1.75L36.5,1.25ZM10.25,-1.25L9.75,-1.25L9.25,-0.75L9.25,-0.5L9,-0.25L9,0L8.75,0L8.5,0.25L9.5,0.25L9.75,0L9.75,-0.25L10,0L10,-0.25L9.75,-0.5L9.75,-1L10,-1L10.25,-1.25ZM33,-0.25L32.75,0L32.75,-0.25L33,-0.25ZM-12,-0.25L-12.25,0L-12.25,-0.25L-12,-0.25ZM11,-0.75L10.75,-0.75L10.75,-0.5L11,-0.5L11,-0.75ZM4,-1.25L5.25,-1.25L5,-1L4.25,-1L4,-1.25ZM-4.5,-2L-4.25,-2.25L-4,-2.25L-4.25,-2L-4,-1.75L-3.75,-1.75L-3.75,-1.5L-4.25,-1.5L-4.5,-1.75L-4.5,-2ZM15.5,-2.75L14.5,-2.75L13.75,-2L14,-1.75L14.25,-1.75L14,-2L14.5,-2.5L15.25,-2.5L15.5,-2.75ZM36.25,-2L36.5,-2.25L36.5,-2L36.25,-2ZM8.25,-3L8.75,-2.5L9,-2.5L9.25,-2.75L9.5,-2.75L9.75,-2.5L10.25,-3L8.25,-3ZM15.25,-3L15,-3.25L14.25,-3.25L13.5,-3L15.25,-3ZM13.5,-3L13.25,-3.25L13,-3L13.5,-3Z"/>
	<path id="Ring" d="M7,0C10.863,0 14,3.137 14,7C14,10.863 10.863,14 7,14C3.137,14 0,10.863 0,7C0,3.137 3.137,0 7,0ZM7,1C10.311,1 13,3.689 13,7C13,10.311 10.311,13 7,13C3.689,13 1,10.311 1,7C1,3.689 3.689,1 7,1Z"/>
	<path id="Mask" d="M7,14L0,14L0,0L14,0L14,14L7,14C10.863,14 14,10.863 14,7C14,3.137 10.863,0 7,0C3.137,0 0,3.137 0,7C0,10.863 3.137,14 7,14Z" style="fill:white;"/>
</svg>';
	
	return $returnString;	
}



function date_range_string($beginDateString, $endDateString)
{
	$beginDate = date_create($beginDateString);
	
	if ($endDateString == 'Present') {
		$endDate = date_create(date());
	} else {
		$endDate = date_create($endDateString);
	}
	
	$diff = date_diff($beginDate, $endDate, true);
	$years = $diff->format('%y');
	$months = $diff->format('%m');
	$days = $diff->format('%d');
	
	if ($days >= 15) {
		if ($months == 11) {
			$months = 0;
			$years = $years + 1;
		} else {
			$months = $months + 1;
		}
	}
	
	if ($months == 0 and $years == 0) {
		$months = 1;
	}
	
	$returnString = '<p class="locationdaterange">'.date_format($beginDate, 'F Y').'&ndash;';
		
	if ($endDateString == 'Present') {
		$returnString = $returnString.'Present';
	} else {
		$returnString = $returnString.date_format($endDate, 'F Y');
	}
	
	$returnString = $returnString.' <span class="grey">(';
	
	if ($years > 0) {
		$returnString = $returnString.$years.'Y';
	}
	
	if (($months > 0) and ($years > 0)) {
		$returnString = $returnString.'&nbsp;';
	}
	
	if (($months > 0) or ($years = 0)) {
		$returnString = $returnString.$months.'M';
	}
	
	$returnString = $returnString.')</span></p>';
	
	return $returnString;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta name="author" content="Samuel Garen">
	<meta name="description" content="Professional biography of Samuel Garen - technical team director and data analyst">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>
		Samuel Garen&ensp;&#8226;&ensp;Data Solutions
	</title>
	
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
	<link rel="apple-touch-icon" type="image/png" href="apple-touch-icon.png">
	<link rel="mask-icon" href="safari-pinned-tab.svg" color="#000000"> <!-- Safari pinned tab icon and color -->
	<meta name="msapplication-TileColor" content="#000000"> <!-- Windows 10 icon and tile color -->
	<meta name="theme-color" content="#000000"> <!-- Android task bar switcher color -->
	<link rel="manifest" href="site.webmanifest">
	
	<link rel="stylesheet" type="text/css" href="style.css" />	
	
	<style>
		body {
			background-image: <?php echo background_image(); ?>;
			margin: 0;
			background-repeat: repeat;
			background-position: center top;
			background-attachment: fixed;
			background-size: 2000px 2000px;
			background-color: rgba(16, 0, 32, 1);
		}
	</style>
</head>

<body>
	<div class="header">
		<img class="logopersonal" src="logo_sg_with_name.svg" alt="Samuel Garen"/>
		<div class="containerheadercontactbutton">
			<a href="mailto:sdgaren@gmail.com"><img class="buttoncontactheader" src="contact_email_address_color_small.svg" alt="E-mail sdgaren@gmail.com" /></a>
			<a href="http://www.linkedin.com/in/sdgaren"><img class="buttoncontactheader" src="contact_linkedin_address_color_small.svg" alt="LinkedIn - linkedin.com/in/sdgaren"></a>
		</div>
	</div>

	<div class="bodybackground">
		<div class="containerbodycontent">

			<h1>About Me</h1>

			<p>
				<img class="selfie" src="sam.jpg" alt="Photograph of Samuel Garen"/>
				<span class="smallcaps">Name:</span> Samuel Garen<br/>
				<span class="smallcaps">Pronouns:</span> He / Him<br/>
				<span class="smallcaps">Location:</span> Portland, Oregon, USA
			</p>
			<p>I am an award-winning data analyst, project manager, and leader of data science and analytics teams, based out of beautiful Portland, Oregon. I make complex information understandable, actionable, and beautiful. Currently I help Grafana Labs execute analytics and engineering projects to glean insights from large data sets and make better decisions through reporting, visualization, modeling, and predictive analysis in support of the GTM organization.</p>
			<p>I believe in stripping problems to their foundations and building from there, focusing first upon simplicity, ease of use, usefulness, quality, and understandability. The best designs are essential, intuitive, and effortless to use, and it is only through close communication, careful research, dismantling of preconceptions, and meticulous attention to detail that this may be achieved.</p>

			<br/>

			<div class="containernavigation">
				<p class="headernavigation">Navigation</p>
				<div class="containernavigationbutton">
					<a href="#experience"><img class="buttonnavigation" src="navbutton_experience_color.svg" alt="Experience" /></a>
					<a href="#education"><img class="buttonnavigation" src="navbutton_education_color.svg" alt="Education" /></a>
					<a href="#keyskills"><img class="buttonnavigation" src="navbutton_keyskills_color.svg" alt="Key Skills" /></a>
					<a href="#samplework"><img class="buttonnavigation" src="navbutton_samplework_color.svg" alt="Sample Work" /></a>
					<a href="#awards"><img class="buttonnavigation" src="navbutton_awards_color.svg" alt="Awards" /></a>
					<a href="#contact"><img class="buttonnavigation" src="navbutton_contactinfo_color.svg" alt="Contact Info" /></a>
				</div>
			</div>



			<div class="spacer" id="experience"></div>



			<h1>Experience</h1>

			<a href="https://grafana.com"><img class="logo buttonlogo" src="logo_grafana.svg" alt="Adidas Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="https://grafana.com">Grafana Labs</a></p>
				<p class="locationdaterange">
					<?php echo location_map(59.32,18.07); ?>
					Stockholm, Sweden</p>
				<br/>
				<ul>
					<li><p class="role">Senior Manager, RevOps Analytics</p>
						<?php echo date_range_string('2022-10-10','Present'); ?></li>
				</ul>
				<p>At Grafana Labs, I lead the company's analytical capabilities within the Revenue Operations / GTM / Sales organization, partnering closely with Finance and other cross-functional organizations to drive insights, ensure reliable access to critical operational data and metrics, and forecast and predict business performance and trends.</p>
			</div>

			<div class="spacer"></div>

			<a href="http://www.adidas-group.com"><img class="logo buttonlogo" src="logo_adidas.svg" alt="Adidas Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.adidas-group.com">Adidas AG</a></p>
				<p class="locationdaterange">
					<?php echo location_map(49.58,10.92); ?>
					Herzogenaurach, Germany</p>
				<br/>
				<ul>
					<li><p class="role">Senior Manager of Data Solutions</p>
						<?php echo date_range_string('2021-05-16','2022-09-14'); ?></li>
					<li><p class="role">Manager of Data Solutions</p>
						<?php echo date_range_string('2020-12-20','2021-05-15'); ?></li>
					<li><p class="role">Manager, Business Performance Analytics</p>
						<?php echo date_range_string('2019-12-16','2020-12-19'); ?></li>
					<li><p class="role">Assistant Manager, Business Performance Analytics</p>
						<?php echo date_range_string('2019-01-02','2019-12-15'); ?></li>
				</ul>
				<p>At Adidas, after successful roles taking over the eCommerce division's Business Performance Analytics team, I founded a back-of-house data science and development studio called Data Solutions, delivering end-to-end support for our business partners in the eCommerce and Retail divisions, Omnichannel Analytics, various business units, and our executive suite. Our work spanned from construction of data sets and development of our data foundation, through automated reporting, dashboarding, and construction of tools, to advanced analytics, modeling, forecasting, and other data science projects. My team ensured our internal clients and external business partners have immediate and reliable access to key infomation, worked to elevate, contextualize, and prioritize key data from massive datasets for our partners, and provided critical insight into operational data to assist our partners in making data-driven decisions to steer the business.</p>
				<h2>Key Achievements</h2>
				<ul>
					<li>Management of a team of four analysts and developers focusing on in-market development of new tools and data capabilities, with special focus upon delivery of queryable data in domains previously inaccessable to end users. Successful data foundation deliveries include:
						<ul>
							<li>Sales order data for eCommerce</li>
							<li>Invoice (net sales) data for eCommerce</li>
							<li>Supply chain and inventory data for all commercial channels</li>
							<li>Geolocated sales data for eCommerce</li>
							<li>Aggregated clickstream and app experience data from Adobe and Amplitude raw data</li>
							<li>Product metadata</li>
							<li>Data from credit card and other payments processors</li>
							<li>Customer contact and call center data</li>
						</ul>
					</li>
					<li>Ground-up design, development, and support for the eCommerce division's core financial and operational forecasting engine, providing detailed daily and real-time projections of daily sales and other metrics used to set targets and monitor business performance, plan and execute commercial events like promotions, staff distribution and call centers, and identify financial risks. Actions taken based on recommendations from this engine generated an additional $10 million USD in sales in 48 hours over Cyber Monday 2020 and an additional $12 million USD in sales over Black Friday and Cyber Monday 2021.</li>
					<li>Development of an automated predictive financial waterfall engine, producing daily projections of consumer demand, shipment backlogs, consumer and supply chain cancellations, returns, net sales, margin, and profitability at fine grain. Previously exceptionally labor-intensive, this approach both fully automates this task allowing for daily, rather than occasional on-demand projections, but produces these projections with average error 70% lower than manual methods and at individual product level, rather than just a total business view.</li>
					<li>Development of the eCommerce division's product sales and inventory reporting systems, blending financial, inventory, web clickstream, marketing, and social media data with product metadata in various capacities into Tableau and Excel, providing business partners daily visibility into key performance metrics, geolocated financial and web data, forecasts, and automated predictive analyses.</li>
					<li>Training of other analysts and operational teams on successful use of SQL, Python, advanced techniques in Excel, and visualization techniques in Tableau with particular concentration on visualization and reporting techniques accommodating of disabilities such as dyslexia and color blindness.</li>
				</ul>
			</div>

			<div class="spacer"></div>

			<a href="http://www.portlandgeneral.com"><img class="logo buttonlogo" src="logo_pge.svg" alt="Portland General Electric Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.portlandgeneral.com">Portland General Electric</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.52,-122.68); ?>
					Portland, Oregon, USA</p>
				<br/>
				<ul>
					<li><p class="role">Independent Consultant, Operations and Analytics</p>
						<?php echo date_range_string('2014-04-01','2022-02-28'); ?></li>
				</ul>
				<p>Portland General Electric retained me as a consultant to assist with software solutions and data analysis for needs that could not be satisfied immediately by internal teams. Key projects included development of software tools to collect and parse arcane network performance data and aggregate this into readable reports, reducing labor for this reporting by 95%. Other projects included SQL training for internal business analysts, advisement on methodologies for producing actionable reporting based on available data, recommendations on best practices for research of non-communicative system nodes based on analysis of successful repair rates, and rapid-turnaround repair and support for preexisting scripts and other software tools.</p>
				<h2>Key Achievements</h2>
				<ul>
					<li>Development of software packages and scripts in VBa, Python, and SQL for statistical analysis of systems performance and reliability data to meet immediate needs that could not be accommodated by internal development and data teams.</li>
					<li>Designed and implemented process improvements in support of major database and software system transition, decreasing labor on reporting tasks by 95% and reducing errors by 75%.</li>
					<li>Facilitated development of a library of technical documentation of above analytics tools and methodologies.</li>
					<li>Trained network data analysts on SQL language / Oracle SQL dialect, core concepts, and best practices as well as efficient use of Oracle SQL Developer.</li>
				</ul>
			</div>

			<div class="spacer"></div>

			<a href="http://www.epiqglobal.com"><img class="logo buttonlogo" src="logo_epiq.svg" alt="Epiq Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.epiqglobal.com">Epiq Global</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.48,-122.78); ?>
					Beaverton, Oregon, USA</p>
				<br/>
				<ul>
					<li><p class="role">Senior Project Coordinator / Senior Project Lead</p>
						<?php echo date_range_string('2018-03-16','2018-12-27'); ?></li>
					<li><p class="role">Project Coordinator / Project Lead</p>
						<?php echo date_range_string('2016-09-16','2018-03-15'); ?></li>
					<li><p class="role">Project Coordinator</p>
						<?php echo date_range_string('2015-10-05','2016-09-15'); ?></li>
				</ul>
				<p>At Epiq, I led multiple simultaneous projects to assist with recovery of damages related to large-scale, systematic banking fraud and other regulatory matters. Operating under intense regulatory and media scrutiny, these programs have successfully helped more than two&nbsp;million individuals and businesses recover over $2&nbsp;billion&nbsp;USD, while assisting auditors with identifying patterns of fraud and potential additional areas of investigation. To support these projects, I also acted as client liasion and project advisor to technical teams on a SaaS legal claim database management tool for client and regulator use, heavily customized for each settlement project. These projects were among the most sophisticated the company handled, each with revenues between $1&nbsp;million and $10&nbsp;million annually.</p>
				<h2>Key Achievements</h2>
				<ul>
					<li>Served as key liaison and project lead to Fortune 500 clients and Big Four banks on four of the company’s largest projects, each exceeding $1 million in monthly revenue and together earning over one quarter of division revenue.</li>
					<li>Collaborated with Agile development team on bi-weekly sprints, attended daily scrums, provided business, functional, and technical requirements, approved wireframes and demos, and performed UAT for software updates to SaaS database management web application.</li>
					<li>Created series of process improvements and supporting software for a series of high-labor, error-prone mailings processes, reducing labor on these tasks by 88% to 97%.</li>
					<li>Developed software tools used by project team to administrate settlement projects, providing unique visibility, flexibility, and reportability, as well as forecasting four times more accurate than possible with previous tools.</li>
				</ul>
			</div>

			<div class="spacer"></div>

			<a href="http://www.pdx.edu"><img class="logo buttonlogo" src="logo_psu.svg" alt="Portland State University Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.pdx.edu">Portland State University</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.51,-122.69); ?>
					Portland, Oregon, USA</p>
				<br/>
				<ul>
					<li><p class="role">Graduate Teaching Assistant</p>
						<?php echo date_range_string('2012-09-27','2014-03-14'); ?></li>
				</ul>
				<p>At Portland State University, I acted as an assistant instructor in a series of undergraduate history courses, mostly concentrating on World History and the history of the Middle East. I received the honor from the professors I worked with to offer frequent presentations on the history of the Middle East to students, where I developed a presentation style characterized by bold, graphic typography, meaningful use of animation, and rich, rapid-fire imagery. I also polished skills in providing positive, constructive feedback and critique of ideas, which continues to serve me well.</p>
				<h2>Key Achievements</h2>
				<ul>
					<li>Presented weekly lectures for undergraduate classes of 60 to 80 students in world history, classical history, and the history of the Middle East. Polished skills in public speaking, instruction, and clear presentation of complex information.</li>
					<li>Held regular discussion and mentoring sessions among students, including constructive critique of writing and analysis skills and techniques.</li>
					<li>Graded assignments, papers, and essays and provided constructive feedback to students.</li>
					<li>Twice-recipient of Portland State University's "Rockstar Graduate Teaching Assistant" award, for spring term 2013 and winter term 2013.</li>
				</ul>
			</div>



			<div class="spacer" id="education"></div>



			<h1>Education</h1>

			<a href="http://www.pdx.edu"><img class="logo buttonlogo" src="logo_psu.svg" alt="Portland State University Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.pdx.edu">Portland State University</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.51,-122.69); ?>
					Portland, Oregon, USA</p>
				<br/>
				<ul>
					<li><p class="role">Master's of Arts, History, Architectural History Focus (Unfinished)</p></li>
				</ul>
				<p>For graduate school, I elected to continue my work in architectural history, focusing upon the use of visual symbol and motif to communicate across linguistic and religio-cultural lines in the medieval Middle East, with additional focus upon the network of logistics and trade established that provided inspiration and materials which have profoundly influenced the architecture and material culture of the Middle East. Unfortunately, the intensification of the Syrian civil war and resultant destruction of the structure that was to be a focus of my thesis has forced me to place further work on hold.</p>
			</div>

			<div class="spacer"></div>

			<a href="http://www.pdx.edu"><img class="logo buttonlogo" src="logo_psu.svg" alt="Portland State University Logo"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.pdx.edu">Portland State University</a></p>
				<p class="locationdaterange">
					<?php echo location_map(45.51,-122.69); ?>
					Portland, Oregon, USA</p>
				<br/>
				<ul>
					<li><p class="role">Bachelor's of Science, History, Architectural History Focus</p></li>
					<li><p class="role">Minor, Architecture</p></li>
					<li><p class="role">Additional Study, Civil Engineering</p></li>
				</ul>
				<p>For my bachelor's degree, I knew I was excited about design, but did not immediately have a clear direction. I decided to build my own course of study by approaching design from three angles: civil engineering, architecture, and architectural history. I was honored to have work I produced in all three disciplines preserved in Portland State's archive as future teaching materials, as well as a number of designs presented by the School of Architecture to the National Architectural Accrediting Board in their successful arguments for accreditation.</p>
			</div>



			<div class="spacer" id="keyskills"></div>



			<h1>Key Skills</h1>

			<h2>Interpersonal</h2>
			<div class="columns">
				<ul>
					<li>Project management</li>
					<li>Development and management of diverse teams</li>
					<li>Communication and public speaking</li>
					<li>Confident decision-making</li>
					<li>Building partnerships with clients and vendors</li>
					<li>Collaborative leadership</li>
					<li>Mentoring and employee development</li>
					<li>Strategic analysis and planning</li>
					<li>Problem resolution</li>
					<li>Product development</li>
					<li>Procedure design and implementation</li>
					<li>Risk assessment and mitigation</li>
					<li>Milestone tracking and reporting</li>
					<li>Quality assurance</li>
					<li>Operational efficiencies and process improvements</li>
					<li>Development and use of corporate brand identities</li>
				</ul>
			</div>

			<h2>Technical</h2>
			<div class="columns">
				<ul>
					<li>Adobe Analytics</li>
					<li>Adobe Creative Suite</li>
					<li>Agile, Kanban, Scrum, and Waterfall methodologies</li>
					<li>Alteryx Designer, Server, and Analytic Apps</li>
					<li>Amazon S3</li>
					<li>Azure DevOps Server</li>
					<li>Clari</li>
					<li>Excel / VBa</li>
					<li>Financial modeling & analysis</li>
					<li>Google Analytics</li>
					<li>Google BigQuery</li>
					<li>Google Docs / Sheets / Slides</li>
					<li>Grafana</li>
					<li>Hadoop / HUE / Hive / Impala</li>
					<li>HTML / CSS</li>
					<li>Jira</li>
					<li>Microstrategy</li>
					<li>Predictive modeling & classification</li>
					<li>Python</li>
					<li>SAP HANA</li>
					<li>Salesforce</li>
					<li>Selenium</li>
					<li>SketchUp</li>
					<li>SQL (ANSI, Exasol, Oracle, and Microsoft SQL Server dialects)</li>
					<li>Tableau</li>
					<li>Technical documentation</li>
				</ul>
			</div>



			<div class="spacer" id="samplework"></div>



			<h1>Sample Work</h1>

			<a href="https://public.tableau.com/app/profile/samuel.garen/viz/ProductSalesDashboard_16465010297070/ProductSalesDashboard">
				<img class="logo buttonlogo" src="samplework_productsalesdashboard.svg" alt="Product Dashboard Thumbnail"/>
			</a>
			<div class="textbox">
				<p class="employer"><a href="https://public.tableau.com/app/profile/samuel.garen/viz/ProductSalesDashboard_16465010297070/ProductSalesDashboard">Product Sales Dashboard</a></p>
				<p class="locationdaterange"><img class="iconinline" src="icon_tableau.svg" alt="Tableau logo" />Tableau</p>
				<p>This report provides detailed product sales metrics, enabling easy comparison to forecast, along with other derived metrics such as margin, discount rate, and average sales price. Metrics are displayed at top level for easy consumption, visualized by a number of key product and sales channel attributes, and broken further into the top products contributing to overall sales. Selectors at left allow visualizations to be easily changed among modes to help the user understand where over&shy;performance and under&shy;performance to forecast are coming from and filters allow the user to quickly drill down into key products. Histograms at lower right inform how sales are distributed by price and margin to ensure sales are generated profitably. Product color data is incorporated to assist in identifying trends.</p>
			</div>

			<div class="spacer"></div>

			<a href="https://github.com/sdgaren/personal-website">
				<img class="logo buttonlogo" src="samplework_website.svg" alt="Representative icon for this website"/>
			</a>
			<div class="textbox">
				<p class="employer"><a href="https://github.com/sdgaren/personal-website">Source Code for This Website</a></p>
				<p class="locationdaterange"><img class="iconinline" src="icon_html.svg" alt="HTML icon" />HTML / PHP</p>
				<p>This Github repository contains the source code for this website, allowing review of the embedded PHP. The PHP within this page performs some silly trickery, such as dynamically generating the date range and duration for each job title shown above and sets the globe icon next to each employer or university's city and state above to a map centered on the actual location. I used construction of this portfolio site as an excuse to learn a bit more PHP, such as working with geodata and dynamic manipulation of SVGs.</p>
			</div>



			<div class="spacer" id="awards"></div>



			<h1>Awards</h1>

			<a href="http://www.adidas-group.com"><img class="logo buttonlogo buttonlogoround" src="award_adidas_star.svg" alt="Adidas Award"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.adidas-group.com">Adidas AG</a></p>
				<ul>
					<li><p class="role">eCommerce Division Peer Recognition Award</p>
						<p class="locationdaterange">Q2 2022</p></li>
					<li><p class="role">eCommerce Division Peer Recognition Award</p>
						<p class="locationdaterange">Q4 2021</p></li>
					<li><p class="role">Special Recognition for Exceptional Performance</p>
						<p class="locationdaterange">Q4 2020</p></li>
					<li><p class="role">3-Cs "Confidence" Award for Outstanding Leadership</p>
						<p class="locationdaterange">Q3 2019</p></li>
				</ul>
			</div>

			<div class="spacer"></div>

			<a href="http://www.pdx.edu"><img class="logo buttonlogo buttonlogoround" src="award_psu_star.svg" alt="Portland State University Award"/></a>
			<div class="textbox">
				<p class="employer"><a href="http://www.pdx.edu">Portland State University</a></p>
				<ul>
					<li><p class="role">Rockstar Graduate Teaching Assistant</p>
						<p class="locationdaterange">Winter Term 2013</p></li>
					<li><p class="role">Rockstar Graduate Teaching Assistant</p>
						<p class="locationdaterange">Spring Term 2013</p></li>
				</ul>
			</div>

			<div class="spacerbottom"></div>

		</div>
	</div>



	<div class="footer">
		<h1 class="headercontact">Contact Info</h1>

		<a href="mailto:sdgaren@gmail.com"><img class="buttoncontactfooter" src="contact_email_address_color.svg" alt="E-mail sdgaren@gmail.com" /></a>
		<a href="http://www.linkedin.com/in/sdgaren"><img class="buttoncontactfooter" src="contact_linkedin_address_color.svg" alt="LinkedIn - linkedin.com/in/sdgaren"></a>
	</div>

</body>
</html>
