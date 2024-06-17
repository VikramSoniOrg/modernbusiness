<?php
// mb vc element
vc_map(array(
	'name' => 'MB Heading',
	'base' => 'mb_heading',
	'description' => 'Heading.',
	'category' => 'MB Elements',
	'params' => array(
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Icon',
			'description' => 'https://icons.getbootstrap.com/',
			'param_name' => 'mb_heading_icon',
		),
		array(
			'type' => 'checkbox',
			'admin_label' => true,
			'heading' => 'Rounded corners?',
			'description' => 'Rounded corners',
			'param_name' => 'mb_heading_rounded_corners',
			'value' => array('Yes' => 1)
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Heading',
			'description' => 'Heading',
			'param_name' => 'mb_heading_heading',
		),
		array(
			'type' => 'textfield',
			'admin_label' => true,
			'heading' => 'Subheading',
			'description' => 'Subheading',
			'param_name' => 'mb_heading_subheading',
		),
		array(
			'type' => 'colorpicker',
			'admin_label' => true,
			'heading' => 'Background Color',
			'description' => 'Background Color',
			'param_name' => 'mb_heading_background_color',
		),		
	)
));
	
// mb vc shortcode
add_shortcode('mb_heading', 'mb_heading');
function mb_heading($atts, $content) {
	extract(shortcode_atts(array(	
		'mb_heading_icon' => '',
		'mb_heading_rounded_corners' => '',
		'mb_heading_heading' => '',
		'mb_heading_subheading' => '',
		'mb_heading_background_color' => '',
	), $atts));
	
	$html = '';
	
	if ($mb_heading_background_color) {
		$html .= '
		<style>
		#mb-heading {
			background-color: '.$mb_heading_background_color.' !important;
		}
		</style>
		';
	}

	$html .= '
	<section class="'.($mb_heading_rounded_corners ? '' : ' bg-light').' pt-5" id="mb-heading">
        <div class="container px-5'.($mb_heading_rounded_corners ? '' : ' mt-5').'">
        	'.($mb_heading_rounded_corners ? '<div class="bg-light rounded-3 py-5 px-4 px-md-5">' : '').'
            <div class="text-center">
            	'.($mb_heading_icon ? '<div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi '.$mb_heading_icon.'"></i></div>' : '').'
                <h1 class="fw-bolder">'.$mb_heading_heading.'</h1>
                <p class="lead fw-normal text-muted mb-0">'.$mb_heading_subheading.'</p>
            </div>
            '.($mb_heading_rounded_corners ? '</div>' : '').'
        </div>
    </section>
	';
	
	return $html;
}