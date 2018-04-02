<?php
/**
 * @version $Id: edit.php 48 2017-08-04 11:41:27Z szymon $
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 Waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://Waasdorpsoekhan.nl
 * @author email contact@Waasdorpsoekhan.nl
 * @developer A.H.C. Waasdorp
 *
 *
 * WsaCarousel is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * WsaCarousel is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WsaCarousel. If not, see <http://www.gnu.org/licenses/>.
 * 0.0.2 2018-04-02
 *
 */

// No direct access.
defined('_JEXEC') or die;
//use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

if(version_compare(JVERSION, '4.0', '>=')) {
    HTMLHelper::_('behavior.formvalidator');
    HTMLHelper::_('behavior.keepalive');
    HTMLHelper::_('behavior.tabstate');
}
else { // v3 or lower
    HTMLHelper::_('behavior.framework');
    HTMLHelper::_('behavior.tooltip');
    HTMLHelper::_('behavior.formvalidation');
    if(version_compare(JVERSION, '3.0', '>=')) HTMLHelper::_('formbehavior.chosen', 'select'); /* J!3.0 only */
}

?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'item.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
			<?php echo $this->form->getField('description')->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		}
		else {
			alert("<?php echo $this->escape(Text::_('COM_WSACAROUSEL_VALIDATION_FORM_FAILED'));?>");
		}
	}
</script>

<form action="<?php echo Route::_('index.php?option=com_wsacarousel&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate form-horizontal">

	<div class="row-fluid">	
	<div class="col-md-9 width-60 fltlft span7 well">
		<div class="form-vertical">
		<fieldset class="adminform">
		
			<h3><?php echo empty($this->item->id) ? Text::_('COM_WSACAROUSEL_NEW') : Text::sprintf('COM_WSACAROUSEL_EDIT', $this->item->id); ?></h3>				
			
			<div class="tab-content">
				
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('title'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('catid'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('catid'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('image'); ?></div>
				</div>
				<div style="clear:both"></div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
				</div>
				
			</div>
		</fieldset>
		</div>
	</div>

	<div class="col-md-3 width-40 fltrt span5 well">
		<div class="card card-light">
		<div class="card-body">
			<fieldset class="panelform" >
		
			<h3><?php echo JText::_('COM_WSACAROUSEL_PUBLISHING_OPTIONS'); ?></h3>
			
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('published'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('published'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('publish_up'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('publish_up'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('publish_down'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('publish_down'); ?></div>
				</div>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
				</div>
			
			</fieldset>
			<?php echo $this->loadTemplate('params'); ?>
		
		</div>
		</div>		
		
		<input type="hidden" name="task" value="" />
		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
	</div>
</form>

<div class="clr"></div>
