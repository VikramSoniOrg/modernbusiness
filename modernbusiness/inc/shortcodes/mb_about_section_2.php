<?php
// mb vc element
vc_map(array(
	'name' => 'MB About Section 2',
	'base' => 'mb_about_section_2',
	'description' => 'Right Image. Left Text.',
	'category' => 'MB Elements',
	'params' => array(
		array(
			'type' => 'attach_image',
			'admin_label' => true,
			'heading' => 'Right Image',
			'description' => 'Right Image',
			'param_name' => 'mb_about_section_2_image',
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Heading',
			'description' => 'Heading',
			'param_name' => 'mb_about_section_2_heading',
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Subheading',
			'description' => 'Subheading',
			'param_name' => 'mb_about_section_2_subheading',
		),
		array(
			'type' => 'colorpicker',
			'admin_label' => true,
			'heading' => 'Background Color',
			'description' => 'Background Color',
			'param_name' => 'mb_about_section_2_background_color',
		),		
	)
));
	
// mb vc shortcode
add_shortcode('mb_about_section_2', 'mb_about_section_2');
function mb_about_section_2($atts, $content) {
	extract(shortcode_atts(array(	
		'mb_about_section_2_image' => '',
		'mb_about_section_2_heading' => '',
		'mb_about_section_2_subheading' => '',
		'mb_about_section_2_background_color' => '',
	), $atts));
	
	$html = '';
	
	if ($mb_about_section_2_background_color) {
		$html .= '
		<style>
		#about-section-two {
			background-color: '.$mb_about_section_2_background_color.' !important;
		}
		</style>
		';
	}

	$html .= '
	<!-- About section two-->
    <section class="py-5"  id="about-section-two">
        <div class="container px-5 my-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="'.wp_get_attachment_url($mb_about_section_2_image).'" alt="..." /></div>
                <div class="col-lg-6">
                    <h2 class="fw-bolder">'.$mb_about_section_2_heading.'</h2>
                    <p class="lead fw-normal text-muted mb-0">'.$mb_about_section_2_subheading.'</p>
                </div>
            </div>
        </div>
    </section>
	';
	
	return $html;
}