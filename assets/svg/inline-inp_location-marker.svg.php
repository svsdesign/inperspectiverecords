<?php 

/*
 ICON : Location Marker
*/

$get_my_var = get_query_var('event_color'); // consider better variables - what if I want to sue this not only for even colourt?
if ($get_my_var) {
	$thiscolor = $get_my_var;
}else{
	$thiscolor ='#ffffff';
};?>


<svg class="svg-icon location-marker-icon" width="40px" height="40px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
 
    <g id="" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g fill="<?php echo $thiscolor;?>" fill-rule="nonzero">
            <path d="M20.3333333,40 C20.3333333,40 7,20.6918433 7,13.3299276 C7,5.96801187 12.9695367,0 20.3333333,0 C27.69713,0 33.6666667,5.96801187 33.6666667,13.3299276 C33.6666667,20.6918433 20.3333333,40 20.3333333,40 Z M20.3333333,21.3333333 C24.7516113,21.3333333 28.3333333,17.7516113 28.3333333,13.3333333 C28.3333333,8.91505533 24.7516113,5.33333333 20.3333333,5.33333333 C15.9150553,5.33333333 12.3333333,8.91505533 12.3333333,13.3333333 C12.3333333,17.7516113 15.9150553,21.3333333 20.3333333,21.3333333 Z" id="Combined-Shape"></path>
        </g>
    </g>
</svg>


 
