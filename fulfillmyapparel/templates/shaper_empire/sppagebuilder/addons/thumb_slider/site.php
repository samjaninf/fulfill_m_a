<?php

/**
 * @package Onepage
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('resticted aceess');


//Load Helix
$helix3_path = JPATH_PLUGINS . '/system/helix3/core/helix3.php';

if (file_exists($helix3_path)) {
    require_once($helix3_path);
    helix3::addCSS('flexslider.css') // CSS Files
            ->addJS('jquery.flexslider-min.js'); // JS Files
}

AddonParser::addAddon('sp_thumb_slider', 'sp_thumb_slider_addon');
AddonParser::addAddon('sp_thumb_slider_item', 'sp_thumb_slider_item_addon');

$sppbSlideArray = array();

function sp_thumb_slider_addon($atts, $content) {

    global $sppbSlideArray;

    extract(spAddonAtts(array(
        'title' => '',
        'heading_selector' => 'h3',
        'title_text_color' => '',
        "slide_height" => '700',
        'autoplay' => 'true',
        'button_text' => '',
        'button_url' => '',
        'arrows' => 'true',
        "class" => '',
                    ), $atts));

    AddonParser::spDoAddon($content);


    //autoplay, controllers & arrow
    $slide_autoplay = ($autoplay) ? 'data-sppb-tg-autoplay="true"' : 'data-sppb-tg-autoplay="false"';
    $slide_arrows = ($arrows) ? 'data-sppb-tg-arrows="true"' : 'data-sppb-tg-arrows="false"';

    //slide height
    $doc = JFactory::getDocument();
    $slide_height_style = '.sppb-addon-thumb-gallery #slider .slides > li .thumb-slider-bg{ height: ' . $slide_height . 'px; }';
    $doc->addStyleDeclaration($slide_height_style);


    $output = '<div class="sppb-addon sppb-thumb-gallery-wrapper sppb-addon-thumb-gallery ' . $class . '">';

    if ($title) {
        $title_style = '';
        if ($title_text_color)
            $title_style .= 'color:' . $title_text_color . ';';

        $output .= '<' . $heading_selector . ' class="sppb-addon-title" style="' . $title_style . '">' . $title . '</' . $heading_selector . '>';
    }
    $output .= '<div id="slider" class="flexslider sppb-tg-slider" ' . $slide_autoplay . ' ' . $slide_arrows . '>';
    $output .= '<ul class="slides">';

    foreach ($sppbSlideArray as $slideItem) {

        // echo "<pre>";
        // print_r($slideItem['title_animation']);
        // echo "</pre>";
        // slide image
        $bg_image = ($slideItem['image']) ? 'style="background-image: url(' . JURI::base() . $slideItem['image'] . ');"' : '';

        // *** animation *** //
        // Title animation
        $title_animation = '';
        if (isset($slideItem['title_animation']) && $slideItem['title_animation']) {
            $title_animation = ' sppb-wow ' . $slideItem['title_animation'];
        }
        // title attr
        $title_data_attr = '';
        if (isset($slideItem['title_animationduration']) && $slideItem['title_animationduration'])
            $title_data_attr .= ' data-sppb-wow-duration="' . $slideItem['title_animationduration'] . 'ms"';
        if (isset($slideItem['title_animationdelay']) && $slideItem['title_animationdelay'])
            $title_data_attr .= ' data-sppb-wow-delay="' . $slideItem['title_animationdelay'] . 'ms"';

        // sub title animation
        $subtitle_animation = '';
        if (isset($slideItem['subtitle_animation']) && $slideItem['subtitle_animation']) {
            $subtitle_animation = ' sppb-wow ' . $slideItem['subtitle_animation'];
        }
        // subtitle attr
        $subtitle_data_attr = '';
        if (isset($slideItem['subtitle_animationduration']) && $slideItem['subtitle_animationduration'])
            $subtitle_data_attr .= ' data-sppb-wow-duration="' . $slideItem['subtitle_animationduration'] . 'ms"';
        if (isset($slideItem['subtitle_animationdelay']) && $slideItem['subtitle_animationdelay'])
            $subtitle_data_attr .= ' data-sppb-wow-delay="' . $slideItem['subtitle_animationdelay'] . 'ms"';

        // button animation
        $button_animation = '';
        if (isset($slideItem['button_animation']) && $slideItem['button_animation']) {
            $button_animation = ' sppb-wow ' . $slideItem['button_animation'];
        }

        // button attr
        $button_data_attr = '';
        if (isset($slideItem['subtitle_animationduration']) && $slideItem['subtitle_animationduration'])
            $button_data_attr .= ' data-sppb-wow-duration="' . $slideItem['subtitle_animationduration'] . 'ms"';
        if (isset($slideItem['subtitle_animationdelay']) && $slideItem['subtitle_animationdelay'])
            $button_data_attr .= ' data-sppb-wow-delay="' . $slideItem['subtitle_animationdelay'] . 'ms"';

        $output .= '<li>';
        $output .= '<div class="thumb-slider-bg" ' . $bg_image . '>';
        //$output .= '<img src="' . $slideItem['image'] . '" alt="' . $slideItem['title'] . '"/>';
        $output .= '<div class="slider-title-wrap">';
        $output .= '<h1 class="slider-title ' . $title_animation . '" ' . $title_data_attr . '>' . $slideItem['title'] . '</h1>';
        $output .= '<p class="slider-sub-title ' . $subtitle_animation . '" ' . $subtitle_data_attr . '>' . $slideItem['sub_title'] . '</p>';
        $output .= '<a class="btn btn-primary btn-sm ' . $button_animation . '" href="' . $slideItem['button_url'] . '" ' . $button_data_attr . '>' . $slideItem['button_text'] . '</a>';
        $output .= '</div>'; //.slider-title-wrap
        $output .= '</div>'; //.thumb-slider-bg
        $output .= '</li>';
    }

    $output .= '</ul>'; //ul.slides
    $output .= '</div>'; // END /#slider


    $output .= '<div class="slide_thumb_wrap">';
    $output .= '<div id="carousel" class="flexslider">';
    $output .= '<ul class="slides">'; // END /#slider
    foreach ($sppbSlideArray as $slideItem) {
        $output .= '<li>';
        $output .= '<div class="thumb-wrap">';
        $output .= '<div class="thumb-text">';
        $output .= '<h4 class="slider-title" ' . $title_data_attr . '>' . $slideItem['title'] . '</h4>';
        $output .= '</div>';
        $output .= '<img src="' . JUri::root() . $slideItem['image'] . '"  alt="' . $slideItem['title'] . '"/>';
        $output .= '</div>';
        $output .= '</li>';
    }
    $output .= '</ul>'; // END /#slider
    $output .= '</div>'; // END /#scarousel
    $output .= '</div>'; // END /#scarousel




    $output .= '</div>'; // END /.flexslider


    $sppbSlideArray = array();
    return $output;
}

function sp_thumb_slider_item_addon($atts) {
    global $sppbSlideArray;

    extract(spAddonAtts(array(
        "title" => '',
        "sub_title" => '',
        "button_url" => '',
        "button_text" => '',
        "image" => '',
        "title_animation" => '',
        "title_animationduration" => '',
        "title_animationdelay" => '',
        "subtitle_animation" => '',
        "subtitle_animationduration" => '',
        "subtitle_animationdelay" => '',
        "button_animation" => '',
        "button_animationduration" => '',
        "button_animationdelay" => '',
                    ), $atts));


    $sppbSlideArray[] = array(
        'title' => $title,
        'sub_title' => $sub_title,
        'button_url' => $button_url,
        'button_text' => $button_text,
        'image' => $image,
        "title_animation" => $title_animation,
        "title_animationduration" => $title_animationduration,
        "title_animationdelay" => $title_animationdelay,
        "subtitle_animation" => $subtitle_animation,
        "subtitle_animationduration" => $subtitle_animationduration,
        "subtitle_animationdelay" => $subtitle_animationdelay,
        "button_animation" => $button_animation,
        "button_animationduration" => $button_animationduration,
        "button_animationdelay" => $button_animationdelay,
    );
}
