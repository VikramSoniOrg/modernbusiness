<?php
// mb vc element
vc_map(array(
	'name' => 'MB CTA Section',
	'base' => 'mb_cta_section',
	'description' => 'MB CTA Section.',
	'category' => 'MB Elements',
	'params' => array(
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Heading',
			'description' => 'Heading',
			'param_name' => 'mb_cta_section_heading',
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Subheading',
			'description' => 'Subheading',
			'param_name' => 'mb_cta_section_subheading',
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Contact Form 7 ID',
			'description' => 'Enter Contact Form 7 ID',
			'param_name' => 'mb_cta_section_cf_id',
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Privacy Text',
			'description' => 'Privacy Text',
			'param_name' => 'mb_cta_section_privacy_text',
		),
		array(
			'type' => 'colorpicker',
			'admin_label' => true,
			'heading' => 'Background Color',
			'description' => 'Background Color',
			'param_name' => 'mb_cta_section_background_color',
		),		
	)
));
	
// mb vc shortcode
add_shortcode('mb_cta_section', 'mb_cta_section');
function mb_cta_section($atts, $content) {
	extract(shortcode_atts(array(	
		'mb_cta_section_heading' => '',
		'mb_cta_section_subheading' => '',
		'mb_cta_section_cf_id' => '',
		'mb_cta_section_privacy_text' => '',
		'mb_cta_section_background_color' => '',
	), $atts));
	
	$html = '';
	
	if ($mb_cta_section_background_color) {
		$html .= '
		<style>
		#mb-cta-section {
			background-color: '.$mb_cta_section_background_color.' !important;
		}
		</style>
		';
	}

	$html .= '
	<section class="pb-5">
    	<div class="container px-5 my-5">
			<aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5" id="mb-cta-section">
		        <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
		            <div class="mb-4 mb-xl-0">
		                <div class="fs-3 fw-bold text-white">'.$mb_cta_section_heading.'</div>
		                <div class="text-white-50">'.$mb_cta_section_subheading.'</div>
		            </div>
		            <div class="ms-xl-4">		               
		                '.do_shortcode('[contact-form-7 id="'.$mb_cta_section_cf_id.'"]').'
		                <div class="small text-white-50">'.$mb_cta_section_privacy_text.'</div>
		            </div>
		        </div>
		    </aside>
    	</div>
    </section>
	';
	
	return $html;
}