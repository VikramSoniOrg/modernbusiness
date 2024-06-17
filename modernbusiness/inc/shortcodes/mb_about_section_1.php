<?php
// mb vc element
vc_map(array(
	'name' => 'MB About Section 1',
	'base' => 'mb_about_section_1',
	'description' => 'Left Image. Right Text.',
	'category' => 'MB Elements',
	'params' => array(
		array(
			'type' => 'attach_image',
			'admin_label' => true,
			'heading' => 'Left Image',
			'description' => 'Left Image',
			'param_name' => 'mb_about_section_1_image',
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Heading',
			'description' => 'Heading',
			'param_name' => 'mb_about_section_1_heading',
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Subheading',
			'description' => 'Subheading',
			'param_name' => 'mb_about_section_1_subheading',
		),
		array(
			'type' => 'colorpicker',
			'admin_label' => true,
			'heading' => 'Background Color',
			'description' => 'Background Color',
			'param_name' => 'mb_about_section_1_background_color',
		),		
	)
));
	
// mb vc shortcode
add_shortcode('mb_about_section_1', 'mb_about_section_1');
function mb_about_section_1($atts, $content) {
	extract(shortcode_atts(array(	
		'mb_about_section_1_image' => '',
		'mb_about_section_1_heading' => '',
		'mb_about_section_1_subheading' => '',
		'mb_about_section_1_background_color' => '',
	), $atts));
	
	$html = '';
	
	if ($mb_about_section_1_background_color) {
		$html .= '
		<style>
		#about-section-one {
			background-color: '.$mb_about_section_1_background_color.' !important;
		}
		</style>
		';
	}

	$html .= '
	<!-- About section one-->
    <section class="py-5 bg-light" id="about-section-one">
        <div class="container px-5 my-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="'.wp_get_attachment_url($mb_about_section_1_image).'" alt="..." /></div>
                <div class="col-lg-6">
                    <h2 class="fw-bolder">'.$mb_about_section_1_heading.'</h2>
                    <p class="lead fw-normal text-muted mb-0">'.$mb_about_section_1_subheading.'</p>
                </div>
            </div>
        </div>
    </section>
	';
	
	return $html;
}