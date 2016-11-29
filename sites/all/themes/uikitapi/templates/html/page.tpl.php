
 
 
 
  
 <header id="header" class="uk-clearfix">
 	<div class="uk-container uk-container-center">
		 <nav class="uk-navbar">
             
             
    <?php if ($main_menu || $secondary_menu || !empty($page['navigation'])): ?>
          <?php if (empty($page['navigation'])): ?>
        <?php print theme('links__system_main_menu', array(
              'links' => $main_menu,
              'attributes' => array(
                'id' => 'main-menu',
                'class' => array('uk-navbar-nav', 'uk-hidden-small', 'uk-contrast', 'uk-clearfix'),
              ),
              'heading' => array(
                'text' => t('Main menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
              ),
            )); ?>
          
        <?php print theme('links__system_secondary_menu', array(
              'links' => $secondary_menu,
              'attributes' => array(
                'id' => 'secondary-menu',
                'class' => array('uk-navbar-nav', 'uk-hidden-small', 'uk-contrast'),
              ),
              'heading' => array(
                'text' => t('Secondary menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
              ),
            )); ?>
          <?php endif; ?>
    
      <?php endif; ?>

		
             
             
             
             
             
             
		     	<?php if($page['header']): ?>
			 		<div id="top" class="uk-width-medium-3-5">
				 		<?php print render($page['header']); ?>
				 		</div>
				 		<?php endif; ?> 
				<div class="uk-navbar-content currentlyplaying uk-hidden">
					<a href="" class="current">
						<h3>
						Currently Playing:
						</h3>
						<b>Isaac's Playlist</b>
					</a>
				</div>
		
			  <div class="uk-navbar-flip">
			  	 <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" id="logo-large" class="uk-navbar-brand uk-hidden-small" title="<?php print t('Home'); ?>" rel="home">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
      </a>
    <?php endif; ?>
                      <?php if ($site_name): ?>
      <a href="<?php print $front_page; ?>" id="site-name" class="uk-navbar-brand uk-hidden-small uk-text-contrast" title="<?php print t('Home'); ?>" rel="home">
        <span><?php print $site_name; ?></span>
      </a>
    <?php endif; ?>
			    <a href="#offcanvasnav" class="uk-navbar-toggle uk-text-contrast uk-visible-small" data-uk-offcanvas></a>
			  </div>
		</nav>
 	</div>
 </header>
 
 
<div class="uk-clearfix"></div>


<div id="container" class="uk-container uk-container-center uk-clearfix">
	<div class="uk-grid uk-grid-collapse">
		<div class="uk-width-large-2-10">
			<div id="sidenav" class="uk-nav">
				<form accept-charset="UTF-8" method="post" class="uk-search" action="/node" data-uk-search>
			   		 <input class="uk-search-field form-text" type="search" name="search_block_form" title="Enter the terms you wish to search for.">
				</form>
				



				
				
				
				
				
				<?php if($page['top']): ?>
					
						<?php print render($page['top']); ?>
					
		  		<?php endif; ?>  
		      
		
		
		
		
		    <?php if ($page['sidebar_first']): ?>
   
        <?php print render($page['sidebar_first']); ?>
  
    <?php endif; ?>
    
    
    
			</div>
		</div>
		<div class="uk-width-large-8-10 maincontentarea">
		  <div id="skip-link">
		    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
		    <?php if ($main_menu): ?>
		      <a href="#navigation" class="element-invisible element-focusable"><?php print t('Skip to navigation'); ?></a>
		    <?php endif; ?>
		  </div>
  
  <div class="container-inner">
     
    <section id="main" role="main" class="clearfix">
      <a id="main-content"></a>
       <?php print $messages; ?> 
             <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div><?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?><ul class="action-links clearfix"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
     
	      <?php print render($title_prefix); ?>
	      <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
	      <?php print render($title_suffix); ?>
	      <?php print render($page['content']); ?>
    
    </section> <!-- /#main -->
    

  
    <?php if ($page['sidebar_second']): ?>
      <aside id="sidebar-second" role="complementary" class="sidebar clearfix">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>
  
  
  
  
  
  
		    <footer id="footer" role="contentinfo" class="clearfix">
		      
		      <?php print $feed_icons ?>
		      <?php if (!empty($pushtape_icons)): ?><?php print $pushtape_icons ?><?php endif; ?>
		    </footer> <!-- /#footer -->
  </div> <!-- /#container-inner -->
   </div> <!-- /.maincontentarea -->
   </div> <!-- /.uk-grid -->
</div> <!-- /#container -->


<?php if ($page['footer']): ?>
<div class="trfooter footerinsy footback">
<div class="uk-container uk-container-center">
   
<?php print render($page['footer']); ?>
  
  </div>
  </div> 
	<!-- Footer -->
<?php endif; ?>


<div id="offcanvasnav" class="uk-offcanvas">
    <div class="uk-offcanvas-bar">
      
        
         <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" id="logo-large" class="uk-navbar-brand uk-hidden-small" title="<?php print t('Home'); ?>" rel="home">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
      </a>
    <?php endif; ?>
                      <?php if ($site_name): ?>
      <a href="<?php print $front_page; ?>" id="site-name" class="uk-navbar-brand uk-hidden-small uk-text-contrast" title="<?php print t('Home'); ?>" rel="home">
        <span><?php print $site_name; ?></span>
      </a>
    <?php endif; ?>
	        
	        <?php print theme('links__system_main_menu', array(
              'links' => $main_menu,
              'attributes' => array(
                'id' => 'main-menu',
                'class' => array('uk-nav', 'uk-nav-offcanvas', 'clearfix'),
              ),
              'heading' => array(
                'text' => t('Main menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
              ),
            )); ?>
          
        <?php print theme('links__system_secondary_menu', array(
              'links' => $secondary_menu,
              'attributes' => array(
                'id' => 'secondary-menu',
                'class' => array('uk-nav', 'uk-nav-offcanvas', 'clearfix'),
              ),
              'heading' => array(
                'text' => t('Secondary menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
              ),
            )); ?>
               
	        
   
    </div>
</div>
