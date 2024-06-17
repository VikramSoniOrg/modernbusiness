<?php
// mb vc element
vc_map(array(
	'name' => 'MB Contact Form',
	'base' => 'mb_contact_form',
	'description' => 'MB Contact Form.',
	'category' => 'MB Elements',
	'params' => array(
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Contact Form 7 ID',
			'description' => 'Enter Contact Form 7 ID',
			'param_name' => 'mb_contact_form_cf_id',
		),
		array(
			'type' => 'colorpicker',
			'admin_label' => true,
			'heading' => 'Background Color',
			'description' => 'Background Color',
			'param_name' => 'mb_contact_form_background_color',
		),		
	)
));
	
// mb vc shortcode
add_shortcode('mb_contact_form', 'mb_contact_form');
function mb_contact_form($atts, $content) {
	extract(shortcode_atts(array(	
		'mb_contact_form_cf_id' => '',
		'mb_contact_form_background_color' => '',
	), $atts));
	
	$html = '';
	
	if ($mb_contact_form_background_color) {
		$html .= '
		<style>
		#mb-contact-form {
			background-color: '.$mb_contact_form_background_color.' !important;
		}
		</style>
		';
	}

	$html .= '
	<section id="mb-contact-form">
        <div class="container px-5">
            <!-- Contact form-->
            <div class="bg-light rounded-3 pb-5 px-4 px-md-5 mb-5">                        
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                    '.do_shortcode('[contact-form-7 id="'.$mb_contact_form_cf_id.'"]').'
                    </div>
				</div>
			</div>
		</div>
	</section>
	';
	
	return $html;
}