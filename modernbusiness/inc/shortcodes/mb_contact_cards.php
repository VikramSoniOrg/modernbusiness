<?php
// mb vc element
vc_map(array(
	'name' => 'MB Contact Cards',
	'base' => 'mb_contact_cards',
	'description' => 'MB Team Members.',
	'category' => 'MB Elements',
	'params' => array(
		array(
			'type' => 'colorpicker',
			'admin_label' => true,
			'heading' => 'Background Color',
			'description' => 'Background Color',
			'param_name' => 'mb_contact_cards_background_color',
		),
		array(
			  'type' => 'param_group',
			  'param_name' => 'contact_cards',
			  'heading' => 'Contact Cards',
			  'description' => 'Contact Cards',
			  'params' => array(
			  	array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Icon',
					'description' => 'https://icons.getbootstrap.com/',
					'param_name' => 'mb_contact_cards_icon',
				),
			  	array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Name',
					'description' => 'Name',
					'param_name' => 'mb_contact_cards_name',
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Description',
					'description' => 'Description',
					'param_name' => 'mb_contact_cards_description',
				),
			  )
		
		),		
	)
));
	
// mb vc shortcode
add_shortcode('mb_contact_cards', 'mb_contact_cards');
function mb_contact_cards($atts, $content) {
	extract(shortcode_atts(array(	
		'mb_contact_cards_background_color' => '',
		'contact_cards' => '',
	), $atts));
	
	$html = '';

	$contact_cards = vc_param_group_parse_atts($atts['contact_cards']);
	
	if ($mb_contact_cards_background_color) {
		$html .= '
		<style>
		#mb-contact-cards {
			background-color: '.$mb_contact_cards_background_color.' !important;
		}
		</style>
		';
	}

	$html .= '
	<section class="pb-5" id="mb-contact-cards">
        <div class="container px-5">
            <!-- Contact cards-->
            <div class="row gx-5 row-cols-2 row-cols-lg-4 py-5">
	';

	foreach($contact_cards as $data) {		
				$html .='
				<div class="col">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi '.$data['mb_contact_cards_icon'].'"></i></div>
                    <div class="h5 mb-2">'.$data['mb_contact_cards_name'].'</div>
                    <p class="text-muted mb-0">'.$data['mb_contact_cards_description'].'</p>
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