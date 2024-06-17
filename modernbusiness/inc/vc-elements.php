<?php
add_action('vc_before_init', 'mb_vc_elements');
function mb_vc_elements() {
    require_once(dirname(__FILE__).'/shortcodes/mb_about_section_1.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_about_section_2.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_team_members.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_heading.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_pricing_section.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_contact_cards.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_contact_form.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_faq_section.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_features_section.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_testimonial_section.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_cta_section.php');
    require_once(dirname(__FILE__).'/shortcodes/mb_blog_section.php');
}