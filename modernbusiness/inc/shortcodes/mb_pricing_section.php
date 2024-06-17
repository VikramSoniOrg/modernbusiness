<?php
// mb vc element
vc_map(array(
	'name' => 'MB Pricing Section',
	'base' => 'mb_pricing_section',
	'description' => 'MB Pricing Section.',
	'category' => 'MB Elements',
	'params' => array(
		array(
			'type' => 'colorpicker',
			'admin_label' => true,
			'heading' => 'Background Color',
			'description' => 'Background Color',
			'param_name' => 'mb_pricing_section_background_color',
		),
		array(
			  'type' => 'param_group',
			  'param_name' => 'pricing_plans',
			  'heading' => 'Pricing Plans',
			  'description' => 'Pricing Plans',
			  'params' => array(
			  	array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Starred?',
					'description' => 'Starred',
					'param_name' => 'mb_pricing_section_starred',
					'value' => array('No' => '0', 'Yes' => '1')
				),
			  	array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Name',
					'description' => 'Name',
					'param_name' => 'mb_pricing_section_name',
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Price',
					'description' => 'Price',
					'param_name' => 'mb_pricing_section_price',
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Button Name',
					'description' => 'Button Name',
					'param_name' => 'mb_pricing_section_button_name',
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Button Link',
					'description' => 'Button Link',
					'param_name' => 'mb_pricing_section_button_link',
				),
				array(
					'type' => 'textarea_raw_html',
					'admin_label' => true,
					'heading' => 'Description',
					'description' => 'Each feature needs to be in a new line. Example: 1=Feature Name or 0=Feature Name. 1=Check. 0=Cross.',
					'param_name' => 'mb_pricing_section_description',
				),
			  )
		
		),		
	)
));
	
// mb vc shortcode
add_shortcode('mb_pricing_section', 'mb_pricing_section');
function mb_pricing_section($atts, $content) {
	extract(shortcode_atts(array(
		'mb_pricing_section_background_color' => '',	
		'pricing_plans' => '',
	), $atts));
	
	$html = '';

	$pricing_plans = vc_param_group_parse_atts($atts['pricing_plans']);
	
	if ($mb_pricing_section_background_color) {
		$html .= '
		<style>
		#pricing-section {
			background-color: '.$mb_pricing_section_background_color.' !important;
		}
		</style>
		';
	}

	$html .= '
	<section class="bg-light py-5" id="pricing-section">
    	<div class="container px-5">
        	<div class="row gx-5 justify-content-center">
	';

	foreach($pricing_plans as $data) {
				$description = explode("\n", rawurldecode(base64_decode($data['mb_pricing_section_description'])));		
				$html .='
				<div class="col-lg-6 col-xl-4">
                    <div class="card mb-5 mb-xl-0">
                        <div class="card-body p-5">
                            <div class="small text-uppercase fw-bold '.($data['mb_pricing_section_starred'] ? '' : ' text-muted').'">'.($data['mb_pricing_section_starred'] ? '<i class="bi bi-star-fill text-warning"></i> ' : '').$data['mb_pricing_section_name'].'</div>
                            <div class="mb-3">
                                <span class="display-4 fw-bold">'.$data['mb_pricing_section_price'].'</span>
                                <span class="text-muted">/ mo.</span>
                            </div>
                            <ul class="list-unstyled mb-4">';
                            foreach ($description as $feature) {
                            	$feature = explode('=', $feature);
                            	$html .= '
                            	<li class="mb-2'.($feature[0] ? '' : ' text-muted').'">
                                    <i class="bi'.($feature[0] ? ' bi-check text-primary' : ' bi-x').'"></i>
                                    '.$feature[1].'
                                </li>';
                            }                                
                            $html .= '    
                            </ul>
                            <div class="d-grid"><a class="btn '.($data['mb_pricing_section_starred'] ? 'btn-primary' : 'btn-outline-primary').'" href="'.$data['mb_pricing_section_button_link'].'">'.$data['mb_pricing_section_button_name'].'</a></div>
                        </div>
                    </div>
                </div>
			  	';
	}

	$html .= '
			</div>
		</div>
	</section>
	';
	
	return $html;
}