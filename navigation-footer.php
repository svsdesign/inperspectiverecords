<?php
/**
 *  Inperspective Records
 *  
 *  Developed by Simon van Stipriaan 
 * 	http://svs.design
 *
 * 
 *
 *
 */?>

<div id="foot-nav" class="">

	<div class="grid">

		<div id="nav-footer-grid" class="grid-item outer-grid-item-xs-6 outer-grid-item-sm-6">

			<div class="menu-wrap grid">

				<?php wp_nav_menu( array(
			    'menu' => 'Footer Navigation',
			    'container_class' =>'menu-footer grid-item grid-item-xs-6 grid-item-sm-6 grid-item-md-4 grid-item-lg-3',
			    ) );?>

				 <?php wp_nav_menu( array(
			    'menu' => 'Social Navigation',
			    'container_class' =>'menu-footer social-menu grid-item grid-item-xs-5 grid-item-sm-4 grid-item-md-2 grid-item-lg-1 push-item-left-lg-2',
				 ) );?>

				  <?php wp_nav_menu( array(
			    'menu' => 'Footer Second Navigation',
			    'container_class' =>'menu-footer second-menu grid-item grid-item-xs-6 grid-item-md-4 grid-item-lg-5',
				  ) );?>
	 		
			 	<div class="svs-design grid-item grid-item-xs-6 grid-item-md-2 grid-item-lg-1">

				 	<a target="_blank" href="http://svs.design/inperspective-records">
				
	 					<div class="title">
						  	<span class="text svs-gold">design +</span>
							<span class="text svs-gold">&nbsp development
							</span>
						</div><!-- title -->
	 				
	 					<div class="name">

						 	<span class="text svs-white">
						  	svs.design
				 			</span>

						</div><!-- name -->

		 			</a>

			 	</div><!--.svs-design -->

		 	</div>

 		</div>

	</div>
	
</div><!-- #foot-nav .navigation-wrapper --> 