<?php
	
	show_admin_bar(false);
	
	register_nav_menus( array(
	    'primary' => __( 'Primary Menu', 'twentytwelve' ),
	) );
	add_theme_support('custom-logo');
	
    // Register custom navigation walker
  require_once('wp_bootstrap_navwalker.php');
    	
  add_action( 'init', 'custom_widgets' );
	function custom_widgets() {
		register_sidebar( array(
			'name' => __( 'Banner', 'twentytwelve' ),
			'id' => 'banner',
			'description' => __( 'Appears on banner slider section', 'twentytwelve' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Footer', 'twentytwelve' ),
			'id' => 'footer',
			'description' => __( 'Appears on footer section', 'twentytwelve' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

	}    

function mwd_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
//   $delimiter = '&raquo;'; // delimiter between crumbs
  $delimiter = ''; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $ul_before = '<ul class="breadcrumb">';
  $ul_after = '</ul>';
  $before = '<li class="current">'; // tag before the current crumb
  $after = '</li>'; // tag after the current crumb
 
  global $post;
  $homeLink = get_bloginfo('url');
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo $ul_before.'<li><a href="' . $homeLink . '">' . $home . '</a></li>'.$ul_after;
 
  } else {
 
	// echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	echo $ul_before.'<li><a href="' . $homeLink . '">' . $home . '</a></li>'. $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    // echo '</div>';
    echo $ul_after;
 
  }
} // end qt_custom_breadcrumbs()


function mwd_accordion($atts = [], $content = null) {
      $output = "<dl class='collapsible'> ";
          if( !is_null($content) ){
            $output .= do_shortcode($content);
          } else {
            $output .= "<p>Use This code</p><br>";
            $output .= "<code> [collapse title=`Example Name` class=`example` id=`#example`] [/collapse] </code>";
          }
      $output .= "</dl>";
    return $output;
      
}
add_shortcode('accordion','mwd_accordion');

function mwd_collapse($atts = [] , $content = null) {

  // extract all atts
  extract(shortcode_atts(array(
        'title' => null,
        'class' => 'collapsible-title',
        'id'  => null
  ),$atts));

        // start Main Div
        $output  = '<div class="accordion"> ';
          // Opening Title element
          $output .= '<dt class=" '.$class.' " id="'.$id.'"> ';     
            $output .= esc_html( __( $title, 'collapse' ) );
            $output .= '<i class="fa fa-plus"></i>';
          $output .= '</dt>';
          // Closing Title element
          // Opening Content element
          $output .= '<dd class="collapsible-content"> ';
            $output .= '<div class="gallery-grids">';

              $output .= do_shortcode($content);

            $output .= "</div>";              
          $output .= '</dd>';
          // Closing Content Element
        $output .= '</div>';
        // end Main Div

  return $output;
}
add_shortcode('collapse', 'mwd_collapse');

 
// add_filter('metaslider_flex_slider_anchor_attributes', 'metaslider_add_full_url_to_slides', 10, 3);
function metaslider_add_rel_attribute_to_images($attributes, $slide, $slider_id) {
        $attributes['class'] = ' slider_img';
        $attributes['height'] = '';
	return $attributes;
}
add_filter('metaslider_flex_slider_image_attributes', 'metaslider_add_rel_attribute_to_images', 10, 3);

	function set_Og_and_Author_Tag(){
		global $post,$url,$title;
		$ID = $post->ID;
		$title = get_the_title();
		$url = get_permalink();
		$image = wp_get_attachment_image_src($ID,'full');
		if(!$image){
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        }		
		
    ?>
        <meta name="author" content="Myanmar Web Designer">
        <link rel="author" href="https://www.myanmarwebdesigner.com/" />
        <meta property="og:url" content="<?= $url ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?= $title ?>" />
        <meta property="og:description" content="" />
        <meta property="og:image" content="<?php echo esc_url( $image[0] ); ?>" />
        <meta property="og:image:width" content="<?php echo absint( $image[1] ) ?>" />
        <meta property="og:image:height" content="<?php echo absint( $image[2] ) ?>" />
        <meta name="twitter:card" content="<?= $url ?>">
	<?php
	}
  add_action("wp_head","set_Og_and_Author_Tag");
  
      // xenu http://fonts.googleapis.com/ no found error fix
remove_action('wp_head', 'wp_resource_hints', 2);
add_action('wp_head','custom_dns_prefetch');
	function custom_dns_prefetch(){
				echo  "	<link rel='dns-prefetch' href='//www.google.com' /> ";
        echo " <link rel='dns-prefetch' href='//s.w.org' />";
	}

?>