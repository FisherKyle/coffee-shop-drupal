<?php




/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function uikitapi_breadcrumb($variables) {
  // only want breadcrumbs for admin section.
  if (arg(0) != 'admin') {
    return;
  }
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $heading = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // Uncomment to add current page to breadcrumb
	// $breadcrumb[] = drupal_get_title();
    return '<nav class="breadcrumb">' . $heading . implode('', $breadcrumb) . '</nav>';
  }
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function uikitapi_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="uk-subnav uk-subnav-pill uk-clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="uk-subnav uk-clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

    
    
/**
 * Override or insert variables into the node template.
 */
function uikitapi_preprocess_node(&$variables) {

  $variables['date'] = format_date($variables['node']->created, 'custom', 'F j, Y');  
  $variables['submitted'] = t('!datetime &middot; !username', array('!username' => $variables['name'], '!datetime' => $variables['date']));
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
$variables['content']['links']['node']['#links']['node-readmore']['attributes']['class'][] = 'uk-button uk-button-primary';
$variables['content']['links']['comment']['#links']['comment-add']['attributes']['class'][] = 'uk-button';
}

/**
 * Preprocess variables for region.tpl.php
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
function uikitapi_preprocess_region(&$variables, $hook) {
  // Use a bare template for the content region.
  if ($variables['region'] == 'content') {
    $variables['theme_hook_suggestions'][] = 'region__bare';
  }
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function uikitapi_preprocess_block(&$variables, $hook) {
  // Use a bare template for the page's main content.
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'][] = 'block__bare';
  }
  $variables['title_attributes_array']['class'][] = 'block-title';
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function uikitapi_process_block(&$variables, $hook) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = $variables['block']->subject;
}


function uikitapi_preprocess_html(&$variables) {
  // If on an individual node page, add the node type to body classes.
  if ($node = menu_get_object()) {
    $variables['theme_hook_suggestions'][] = 'html__'. $node->type;
  }
}

     
/**
 * Implements hook_preprocess_page
 */
function uikitapi_preprocess_page(&$vars) {

        
  if (arg(0) == 'taxonomy' && arg(1) == 'term' )
  {
    $term = taxonomy_term_load(arg(2));
    $vocabulary = taxonomy_vocabulary_load($term->vid);
    $vars['theme_hook_suggestions'][] = 'page__taxonomy_vocabulary_' . $vocabulary->machine_name;
  }
      if (isset($vars['node'])) {
    $vars['theme_hook_suggestions'][] = 'page__node__' . $vars['node']->type;
  }  
  // Load genericons from library
  if (module_exists('libraries') && $genericons_path = libraries_get_path('genericons')) {
   drupal_add_css($genericons_path . '/genericons/genericons.css');
  }
}

function uikitapi_css_alter(&$css) {
  // Remove defaults.css file.
}

/**
 * Changes the search form to use the "search" input element of HTML5.
 */
function uikitapi_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
}


/**
 * Implements theme_field to get rid of colon on labels.
 */
function uikitapi_field($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;&nbsp;</div>';
  }

  // Render the items.
  $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
  foreach ($variables['items'] as $delta => $item) {
    $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
    $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
  }
  $output .= '</div>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}


/**
 * Clearfix added to inline field elements causing float problems...see http://drupal.org/node/622330#comment-5215864
 */
function uikitapi_preprocess_field(&$variables, $hook){
    $element = $variables['element'];
    if ($element['#label_display'] == 'inline') {
        $classes_arr = &$variables['classes_array'];
        for ($i = sizeof($classes_arr)-1; $i >= 0; $i--) {
            if( $classes_arr[$i]==='clearfix' ){
                unset($classes_arr[$i]);
                $i=-1;
            }       
    }
  }
}
/**
 * Override feed icons to include JSPF and embed links.
 */
function uikitapi_feed_icon($variables) {
  $text = t('Subscribe to !feed-title', array('!feed-title' => $variables['title']));
  $icon = '<span class="genericon genericon-feed"></span>';
  $rss = l($icon, $variables['url'], array('html' => TRUE, 'attributes' => array('class' => array('feed-icon'), 'title' => $text)));
  return $rss;
}


    /**
     *	Override theme_status_messages().
     **/
    function uikitapi_status_messages($variables)
    {
        $display = $variables['display'];
        $output = '';
        $status_heading = array(
            'status' => t('Status message'),
            'error' => t('Error message'),
            'warning' => t('Warning message'),
        );

        foreach (drupal_get_messages($display) as $type => $messages) {
            //convert to uikitapi classes
            switch ($type) {
                case 'error': $type = 'uk-alert';
                break;

                case 'status': $type = 'uk-alert-success';
                break;

                case 'warning': $type = 'uk-alert-warning';
                break;
            }

            $output .= "<div class=\"uk-alert $type\" data-uk-alert><a href='#' class=\"uk-alert-close uk-close\"></a>";
            if (!empty($status_heading[$type])) {
                $output .= '<h2 class="element-invisible">'.$status_heading[$type].'</h2>';
            }
            if (count($messages) > 1) {
                $output .= ' <ul>';
                foreach ($messages as $message) {
                    $output .= '  <li>'.$message.'</li>';
                }
                $output .= ' </ul>';
            } else {
                $output .= $messages[0];
            }
            $output .= '</div>';
        }

        return $output;
    }

/**
 * Theme global controls block
 */
function uikitapi_pushtape_player_controls() {
  $output = <<<EOD
  <div class="pt-controls-markup">
    <div class="pt-controls pt-hide">
	    <div class="uk-grid uk-grid-collapse">
	        <div class="uk-width-1-3 uk-flex uk-flex-center uk-flex-middle">
		    	<a class="pt-previous" href="#" title="Previous"><span class="genericon genericon-rewind"></span> </a>
				<a class="pt-play-pause" href="#" title="Play/Pause">
		        	<span class="play-btn"><span class="genericon genericon-play"></span></span>
					<span class="pause-btn"><span class="genericon genericon-pause"></span></span>
				</a>
				<a class="pt-next" href="#" title="Next"> <span class="genericon genericon-fastforward"></span></a>
			</div>  
	       <div class="uk-width-2-3">
	       <div class="uikitapi-player-back">
	             <div class="pt-time">
				 	<span class="pt-current-time">--:--</span> / <span class="pt-duration">--:--</span>
				 </div>
		<span class="shuffle"></span>
	      <span class="pt-current-track-title"></span>
		      <div class="pt-scrubber">
		        <div class="pt-statusbar">  
		          <div class="pt-loading"></div>  
		          <div class="pt-position"><div class="pt-handle"></div></div>  
		        </div>
		      </div>
	  		</div>
	  		</div>
		</div>
    </div>
  </div>
EOD;

  return $output;
}
