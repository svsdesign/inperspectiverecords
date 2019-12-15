<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
*
* alt. option for IE? 
* 
* https://stackoverflow.com/questions/21904672/internet-explorer-and-clip-path
*   https://www.sarasoueidan.com/blog/svg-coordinate-systems/
*https://www.sarasoueidan.com/blog/css-svg-clipping/
*
*
 */?>

<div id="head-nav" class="navigation-wrapper">

	<div class="navigation grid">

		<div class="nav grid-item outer-grid-item-xs-6 outer-grid-item-sm-6">

			<div class="menu-wrap grid">

				<?php wp_nav_menu( array(
				    'menu' => 'Header Navigation',
				    'container_class' =>'menu-header grid-item grid-item-xs-6 grid-item-sm-6 grid-item-md-4',
				    ) );?>

				 <?php wp_nav_menu( array(
				    'menu' => 'Social Navigation',
				    'container_class' =>'menu-header social-menu grid-item grid-item-xs-6 grid-item-sm-6 grid-item-md-2 grid-item-lg-1 push-item-left-lg-1',
				  ) );?>

				  <?php wp_nav_menu( array(
				    'menu' => 'Header Second Navigation',
				    'container_class' =>'menu-header second-menu grid-item grid-item-xs-6 grid-item-md-6',
				  ) );?>
		 		
		 	</div>

 		</div>

		<div class="bg">

			<div class="inp-bg">

				<svg viewBox="0 0 1200 809.311" xmlns="http://www.w3.org/2000/svg">
	 			
	 				<path d="M1171.287,0H253.496c-20.508,0-41.779,16.107-47.366,35.838L1.241,773.527
					c-5.328,19.759,7.003,35.783,27.375,35.783h208.746c20.562,0,41.833-16.024,47.365-35.783l54.806-197.531
					c5.533-19.596,26.613-35.729,47.312-35.729h634.168c20.768,0,41.97-16.079,47.503-35.756l130.188-468.673
					C1204.181,16.107,1191.781,0,1171.287,0z" fill-rule="nonzero"/>

	 			</svg>

 	 			<div class="inp-bg-close test"></div>

 			</div><!--inp-bg-->

 		</div><!--.bg-->

	</div>

	<div class="navigation-toggle-wrap">

		<div class="navigation-toggle">

			<svg id="itoggle" class=""  width="100%" viewBox="0 0 1005.115 677.875" xmlns="http://www.w3.org/2000/svg">
				<path id="idot" d="M981.065,0H212.327c-17.178,0-34.994,13.491-39.674,30.018L1.039,647.903
				c-4.463,16.55,5.866,29.972,22.93,29.972h174.845c17.223,0,35.039-13.422,39.673-29.972l45.905-165.451
				c4.635-16.413,22.291-29.927,39.628-29.927h531.177c17.395,0,35.153-13.468,39.788-29.949l109.045-392.559
				C1008.617,13.491,998.231,0,981.065,0z" fill-rule="nonzero"/>
				
				<path opacity="0" id="minus" d="M901.569,280.438H132.831c-17.178,0-34.994,13.491-39.674,30.018l-15.801,58.011
				c-4.463,16.55,5.866,29.972,22.93,29.972h174.845c17.223,0,32.254,0,32.254,0l0,0h31.952h531.177
				c17.395,0,35.153-12.38,39.788-28.861l14.231-59.121C929.121,293.929,918.735,280.438,901.569,280.438z" fill-rule="nonzero"/>
			
				<path style="display:none;" id="idot-path" d="M981.065,0H212.327c-17.178,0-34.994,13.491-39.674,30.018L1.039,647.903
				c-4.463,16.55,5.866,29.972,22.93,29.972h174.845c17.223,0,35.039-13.422,39.673-29.972l45.905-165.451
				c4.635-16.413,22.291-29.927,39.628-29.927h531.177c17.395,0,35.153-13.468,39.788-29.949l109.045-392.559
				C1008.617,13.491,998.231,0,981.065,0z" fill-rule="nonzero"/>
			
			</svg>

		</div>

 	</div>
		
</div><!-- #head-nav .navigation-wrapper --> 



<?php /*<div id="side-nav" class="navigation-wrapper">

	<div class="side-navigation">

		<div class="container">
		  
		  <div class="page-title-position left">
		    <div class="page-title">
 		    </div> <!--.page-title -->
		  </div><!-- .page-title-position -->
		 
		</div>


		<div class="container">
		  
		  <div class="page-title-position right">
		    <div class="page-title">
 		    </div> <!--.page-title -->
		  </div><!-- .page-title-position -->
		 
		</div>
	
	</div><!-- class="side-navigation grid"-->


</div><!-- #side-nav .navigation-wrapper --> 
*/?>