<?php
// Pull all the categories into an array
$options_categories = array();
$options_categories['None'] = 0;
$options_categories_obj = get_categories(array('hide_empty' => 0));
foreach ($options_categories_obj as $category) {
	$options_categories[$category->cat_name] = $category->cat_ID;
}

// mb vc element
vc_map(array(
	'name' => 'MB Blog Section',
	'base' => 'mb_blog_section',
	'description' => 'MB Blog Section.',
	'category' => 'MB Elements',
	'params' => array(
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Heading',
			'description' => 'Heading',
			'param_name' => 'mb_blog_section_heading',
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Subheading',
			'description' => 'Subheading',
			'param_name' => 'mb_blog_section_subheading',
		),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => 'Category',
			'description' => 'Select Posts Category',
			'param_name' => 'mb_blog_section_category',
			'value' => $options_categories
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Posts Per Page',
			'description' => 'Posts Per Page',
			'param_name' => 'mb_blog_section_posts_per_page',
		),
		array(
			'type' => 'colorpicker',
			'admin_label' => true,
			'heading' => 'Background Color',
			'description' => 'Background Color',
			'param_name' => 'mb_blog_section_background_color',
		),		
	)
));
	
// mb vc shortcode
add_shortcode('mb_blog_section', 'mb_blog_section');
function mb_blog_section($atts, $content) {
	extract(shortcode_atts(array(	
		'mb_blog_section_heading' => '',
		'mb_blog_section_subheading' => '',
		'mb_blog_section_category' => '',
		'mb_blog_section_posts_per_page' => '3',
		'mb_blog_section_background_color' => '',
	), $atts));
	
	$html = '';
	
	if ($mb_blog_section_background_color) {
		$html .= '
		<style>
		#mb-blog-section {
			background-color: '.$mb_blog_section_background_color.' !important;
		}
		</style>
		';
	}

	$html .= '
	<section class="pt-5" id="mb-blog-section">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">'.$mb_blog_section_heading.'</h2>
                        <p class="lead fw-normal text-muted mb-5">'.$mb_blog_section_subheading.'</p>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
	';

	$the_query = new WP_Query(array('posts_per_page' => $mb_blog_section_posts_per_page, 'cat' => $mb_blog_section_category));
	while ($the_query->have_posts()) : $the_query->the_post();
	$categories = get_the_category();
	$category_html = '';
	foreach ($categories as $category) {
		$category_html .= '<div class="badge bg-primary bg-gradient rounded-pill mb-2 me-2">'.$category->name.'</div>';
	}	
	$html .= '
	<div class="col-lg-4 mb-5">
        <div class="card h-100 shadow border-0">
            <img class="card-img-top" src="'.get_the_post_thumbnail_url(get_the_ID(), 'mb-blog-section').'" alt="..." />
            <div class="card-body p-4">
                '.$category_html.'
                <a class="text-decoration-none link-dark stretched-link" href="'.get_permalink().'"><h5 class="card-title mb-3">'.get_the_title().'</h5></a>
                <p class="card-text mb-0">'.get_the_excerpt().'</p>
            </div>
            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                <div class="d-flex align-items-end justify-content-between">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle me-3" src="'.get_avatar_url(get_the_author_meta('ID'), array('size' => 40)).'" alt="..." />
                        <div class="small">
                            <div class="fw-bold">'.get_the_author().'</div>
                            <div class="text-muted">'.get_the_time('F jS, Y').' &middot; '.round(str_word_count(get_the_content()) / 300).' min read</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	';	
	endwhile;
	wp_reset_postdata();

	$html .= '
			</div>
		</div>
	</section>
	';
	
	return $html;
}