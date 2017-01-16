<?php
/**
 * @package Helix3 Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('resticted aceess');

jimport('joomla.filesystem.file');

$doc = JFactory::getDocument();
$params = JFactory::getApplication()->getTemplate('true')->params;

//Favicon
if ($favicon = $params->get('favicon')) {
    $doc->addFavicon(JURI::base(true) . '/' . $favicon);
} else {
    $doc->addFavicon($this->baseurl . '/templates/' . $this->template . '/images/favicon.ico');
}


//Error Logo
if ($logo_image = $params->get('error_logo')) {
    $logo = JURI::base(true) . '/' . $logo_image;
} elseif ($logo_image = $params->get('logo_image')) {
    $logo = JURI::base(true) . '/' . $logo_image;
} else {
    $logo = $this->baseurl . '/templates/' . $this->template . '/images/presets/preset1/logo@2x.png';
}

//Error BG
if ($error_bg = $params->get('error_background')) {
    $error_bg = JURI::base(true) . '/' . $error_bg;

    $error_bg_style = '.error-page-inner{'
            . 'background: url(' . $error_bg . ');'
            . '}';
    $doc->addStyleDeclaration($error_bg_style);
}

//Stylesheets
$doc->addStylesheet($this->baseurl . '/templates/' . $this->template . '/css/bootstrap.min.css');
$doc->addStylesheet($this->baseurl . '/templates/' . $this->template . '/css/font-awesome.min.css');
$doc->addStylesheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');

$doc->setTitle($this->error->getCode() . ' - ' . $this->title);
require_once(JPATH_LIBRARIES . '/joomla/document/html/renderer/head.php');
$header_renderer = new JDocumentRendererHead($doc);
$header_contents = $header_renderer->render(null);
?>
<!DOCTYPE html>
<html class="error-page" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta name="viewport" content="width=device-width, initial-scale=1">
                <?php echo $header_contents; ?>
                </head>
                <body>
                    <div class="error-page-inner">
                        <div class="container">
                            <div class="row">
                                <div class="error-page-wrap">
                                    <div class="error-page-logo">
                                        <img class="img-resposive error-logo" src="<?php echo $logo; ?>" />
                                    </div>
                                    <p class="error-message"><?php echo $this->error->getMessage(); ?></p>
                                    <a class="btn btn-primary btn-sm error-button" href="<?php echo $this->baseurl; ?>/" title="<?php echo JText::_('HOME'); ?>"> <?php echo JText::_('HELIX_GO_BACK'); ?></a>
                                    <div class="eror-copyright">
                                        <p>&copy; 2016 All Rights Reserved </p>
                                    </div>
                                    <?php echo $doc->getBuffer('modules', '404', array('style' => 'sp_xhtml')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
                </html>