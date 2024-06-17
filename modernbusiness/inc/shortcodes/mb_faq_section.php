<?php
// mb vc element
vc_map(array(
	'name' => 'MB FAQ Section',
	'base' => 'mb_faq_section',
	'description' => 'MB FAQ Section.',
	'category' => 'MB Elements',
	'params' => array(
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Heading',
			'description' => 'Heading',
			'param_name' => 'mb_faq_section_heading',
		),
		array(
			'type' => 'colorpicker',
			'admin_label' => true,
			'heading' => 'Background Color',
			'description' => 'Background Color',
			'param_name' => 'mb_faq_section_background_color',
		),
		array(
			  'type' => 'param_group',
			  'param_name' => 'faqs',
			  'heading' => 'FAQs',
			  'description' => 'FAQs',
			  'params' => array(
			  	array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Question',
					'description' => 'Question',
					'param_name' => 'mb_faq_section_question',
				),
				array(
					'type' => 'textarea',
					'admin_label' => true,
					'heading' => 'Answer',
					'description' => 'Answer',
					'param_name' => 'mb_faq_section_answer',
				),
			  )
		
		),		
	)
));
	
// mb vc shortcode
add_shortcode('mb_faq_section', 'mb_faq_section');
function mb_faq_section($atts, $content) {
	extract(shortcode_atts(array(	
		'mb_faq_section_heading' => '',
		'mb_faq_section_background_color' => '',
		'faqs' => '',
	), $atts));
	
	$html = '';

	$faqs = vc_param_group_parse_atts($atts['faqs']);

	$rand = mt_rand();
	
	if ($mb_faq_section_background_color) {
		$html .= '
		<style>
		#accordion-item-'.$rand.' {
			background-color: '.$mb_faq_section_background_color.' !important;
		}
		</style>
		';
	}

	$html .= '	
	<h2 class="fw-bolder mb-3">'.$mb_faq_section_heading.'</h2>
	<div class="accordion mb-5" id="accordionExample'.$rand.'">
	';

	$counter = 0;
	foreach($faqs as $data) {	
		$counter++;	
		$html .='
		<div class="accordion-item" id="accordion-item-'.$rand.'">
	        <h3 class="accordion-header" id="heading'.$rand.'-'.$counter.'"><button class="accordion-button'.($counter > 1 ? ' collapsed' : '').'" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$rand.'-'.$counter.'" aria-expanded="'.($counter > 1 ? 'false' : 'true').'" aria-controls="collapse'.$rand.'-'.$counter.'">'.$data['mb_faq_section_question'].'</button></h3>
	        <div class="accordion-collapse collapse'.($counter > 1 ? '' : ' show').'" id="collapse'.$rand.'-'.$counter.'" aria-labelledby="heading'.$rand.'-'.$counter.'" data-bs-parent="#accordionExample'.$rand.'">
	            <div class="accordion-body">'.$data['mb_faq_section_answer'].'</div>
	        </div>
	    </div>
	  	';
	}

	$html .= '
	</div>
	';
	
	return $html;
}