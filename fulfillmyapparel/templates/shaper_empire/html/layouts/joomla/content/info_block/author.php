<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

?>
<dd class="createdby" itemprop="author" itemscope itemtype="http://schema.org/Person">
	
	<img itemprop="name" data-toggle="tooltip" title="<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', '') . ' ' . $displayData['item']->author; ?>" alt="<?php echo $displayData['item']->author; ?>" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($displayData['item']->author_email))); ?>?s=42">
	<?php $author = ($displayData['item']->created_by_alias ? $displayData['item']->created_by_alias : $displayData['item']->author); ?>
	<span><?php echo  JText::_('HELIX_BY'); ?> </span>
	<?php $author = '<span class="info-block-title" itemprop="name" data-toggle="tooltip" title="' . JText::sprintf('COM_CONTENT_WRITTEN_BY', '') . '">' . $author . '</span>'; ?>
	<?php if (!empty($displayData['item']->contact_link ) && $displayData['params']->get('link_author') == true) : ?>
		<?php echo JHtml::_('link', $displayData['item']->contact_link, $author, array('itemprop' => 'url')); ?>
	<?php else :?>
		<?php echo $author; ?>
	<?php endif; ?>
</dd>