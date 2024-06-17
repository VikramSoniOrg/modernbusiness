<?php
// add title support
add_theme_support('title-tag');

// add css and js
add_action('wp_enqueue_scripts', 'mb_scripts');
function mb_scripts() {	
	// CSS
	wp_enqueue_style('mb-bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css', array(), '1.0');
	wp_enqueue_style('mb-styles', get_theme_file_uri('/css/styles.css'), array('mb-bootstrap-icons'), '1.0');
	wp_enqueue_style('mb-style', get_stylesheet_uri(), array('mb-styles'), '1.0');

	// JS
	wp_enqueue_script('mb-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), '1.0', true);
	wp_enqueue_script('mb-scripts', get_theme_file_uri('/js/scripts.js'), array('mb-bootstrap'), '1.0', true);
}

// register menus
register_nav_menus(array(
	'main_menu' 	=> __('Main Menu'),
	'footer_menu' 	=> __('Footer Menu'),
));

// add image size
add_image_size('mb-blog-section', 600, 350, true);
add_image_size('mb-blog-hero'	, 700, 350, true);

// mb custom menu
function mb_menu($theme_location) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term($locations[$theme_location], 'nav_menu');
        $menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list = '';
 		
		if ($theme_location == 'main_menu') {
			$menu_list .= '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">' ."\n";
			
			$total_menu_items = count($menu_items);
			$c = 0;
			  
			foreach($menu_items as $menu_item) {
				$c++;
				$classes = implode(' ', $menu_item->classes);

				if($menu_item->menu_item_parent == 0) {					 
					$parent = $menu_item->ID;
					 
					$menu_array = array();
					foreach($menu_items as $submenu) {
						if($submenu->menu_item_parent == $parent) {
							$bool = true;
							$submenu_classes = implode(' ', $submenu->classes);
							$menu_array[] = '<li><a class="dropdown-item '.$submenu_classes.'" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' ."\n";
						}
					}

					if(count($menu_array) > 0) {						 
						$menu_list .= '<li class="nav-item dropdown '.$classes.'">' ."\n";
						$menu_list .= '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="'.$menu_item->url.'" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $menu_item->title . '</a>' ."\n";
						
						$menu_list .= ' <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">' ."\n";
							
						$menu_list .= implode("\n", $menu_array);
						
						$menu_list .= '</ul>' ."\n";						 
					} else {						 
						$menu_list .= '<li class="nav-item '.$classes.'">' ."\n";
						$menu_list .= '<a class="nav-link" href="' . $menu_item->url . '">' . $menu_item->title . '</a>' ."\n";
					}
					
					// end <li>
					$menu_list .= '</li>' ."\n";					 
				}				 
			}
			  
			$menu_list .= '</ul>' ."\n";
			
		} else if ($theme_location == 'footer_menu') {
			$total_menu_items = count($menu_items);
			$c = 0;
			foreach ($menu_items as $key => $menu_item) {
				$c++;
				$classes = implode(' ', $menu_item->classes);			
				$title = $menu_item->title;
				$url = $menu_item->url;

				if ($c < $total_menu_items) {
					$menu_list .= '<a class="link-light small" href="' . $url . '">' . $title . '</a> <span class="text-white mx-1">&middot;</span> ';
				}
				else {
					$menu_list .= '<a class="link-light small" href="' . $url . '">' . $title . '</a>';
				}
			}
		}
  
    } else {
        $menu_list = '<!-- no menu defined in location "'.$theme_location.'" -->';
    }
     
    echo $menu_list;
}

// add classes to nav items
add_filter('wp_get_nav_menu_items', 'iid_nav_menu_classes', 10, 3);
function iid_nav_menu_classes($items, $menu, $args) {
    _wp_menu_item_classes_by_context($items);
	
    return $items;
}

// visual composer elements
require_once(dirname(__FILE__).'/inc/vc-elements.php');

// custom widgets
require_once(dirname(__FILE__).'/inc/widgets.php');

// register sidebar
register_sidebar( array(
	'name'          => __( 'Right Sidebar' ),
	'id'            => 'right-sidebar',
	'description'   => __( 'Right Sidebar.' ),
	'before_widget' => '<div id="%1$s" class="text-center widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<div class="h6 fw-bolder widget-title">',
	'after_title'   => '</div>',
) );