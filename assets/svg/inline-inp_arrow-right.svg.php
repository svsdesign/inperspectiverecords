<?php 
/*
 ICON : Arrow Right
*/
 $get_my_var = get_query_var('event_color'); // consider better variables - what if I want to sue this not only for even colourt?
if ($get_my_var) {
	$thiscolor = $get_my_var;
}else{
	$thiscolor ='#ffffff';
};?>

<svg style="fill:<?php echo $thiscolor;?>; stroke:<?php echo $thiscolor;?>;" class="svg-icon arrow-right-icon" width="27px" height="40px" viewBox="0 0 27 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<g stroke-width="3">
<polygon points="0.573,40 0,39.264 24.766,20 0,0.738 0.573,0 26.288,20"/>
</g>
</svg>

