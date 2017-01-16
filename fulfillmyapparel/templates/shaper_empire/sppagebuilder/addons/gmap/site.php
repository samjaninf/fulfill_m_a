<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2015 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

AddonParser::addAddon('sp_gmap','sp_gmap_addon');

function sp_gmap_addon($atts){

	extract(spAddonAtts(array(
		"title"							=> '',
		"heading_selector" 				=> 'h3',
		"title_fontsize" 				=> '',
		"title_fontweight" 				=> '',
		"title_text_color" 				=> '',
		"title_margin_top" 				=> '',
		"title_margin_bottom" 			=> '',		
		"map"							=> '',
		"gmap_api"						=> '',
		"height"						=> '',
		"type"							=> '',
		"zoom"							=> '',
		'mousescroll'					=> '',
		'water_color'					=> '#d3d3d3',
		'highway_stroke_color'			=> '#a2a2a2',
		'highway_fill_color'			=> '#bdbdbd',
		'local_stroke_color'			=> '#ffffff',
		'local_fill_color'				=> '#ffffff',
		'poi_fill_color'				=> '#ebebeb',
		'administrative_color'			=> '#a7a7a7',
		'landscape_color'				=> '#efefef',
		'road_text_color'				=> '#696969',
		'road_arterial_fill_color'		=> '#efefef',
		'road_arterial_stroke_color'	=> '#efefef',
		"class"							=> '',
		), $atts));

	if($map) {

		$map = explode(',', $map);
		
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();

		if ($gmap_api) {
			$doc->addScript('//maps.google.com/maps/api/js?libraries=places&key='. $gmap_api .'');
		} else{
			$doc->addScript('//maps.google.com/maps/api/js?libraries=places');
		}
		
		$doc->addScript( JURI::base() . '/templates/' . $app->getTemplate() . '/js/gmap.js' );

		$output  = '<div class="sppb-addon sppb-addon-gmap ' . $class . '">';

		if($title) {

			$title_style = '';
			if($title_margin_top !='') $title_style .= 'margin-top:' . (int) $title_margin_top . 'px;';
			if($title_margin_bottom !='') $title_style .= 'margin-bottom:' . (int) $title_margin_bottom . 'px;';
			if($title_text_color) $title_style .= 'color:' . $title_text_color  . ';';
			if($title_fontsize) $title_style .= 'font-size:'.$title_fontsize.'px;line-height:'.$title_fontsize.'px;';
			if($title_fontweight) $title_style .= 'font-weight:'.$title_fontweight.';';

			$output .= '<'.$heading_selector.' class="sppb-addon-title" style="' . $title_style . '">' . $title . '</'.$heading_selector.'>';
		}

		$output .= '<div class="sppb-addon-content">';

		$output .= '<div style="height:' . (int) $height . 'px" class="sppb-addon-gmap-canvas" data-lat="' . $map[0] . '" data-lng="' . $map[1] . '" data-maptype="' . $type . '" data-mapzoom="' . $zoom . '" data-mousescroll="' . $mousescroll . '" data-water_color="' . $water_color . '"
			data-highway_stroke_color="' . $highway_stroke_color . '" 
			data-highway_fill_color="' . $highway_fill_color . '" 
			data-local_stroke_color="' . $local_stroke_color . '" 
			data-local_fill_color="' . $local_fill_color . '" 
			data-poi_fill_color="' . $poi_fill_color . '" 
			data-administrative_color="' . $administrative_color . '" 
			data-landscape_color="' . $landscape_color . ' " 
			data-road_text_color="' . $road_text_color . '" 
			data-road_arterial_fill_color="' . $road_arterial_fill_color . '" 
			data-road_arterial_stroke_color="' . $road_arterial_stroke_color . '"></div>';

		$output .= '</div>';
		
		$output .= '</div>';

		return $output;

	}

	return;

}