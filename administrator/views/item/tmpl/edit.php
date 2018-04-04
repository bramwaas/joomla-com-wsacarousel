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
 * 0.0.3 2018-04-04
 *
 */

// No direct access.
defined('_JEXEC') or die;
//use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;

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
// Fieldsets to not automatically render by /layouts/joomla/edit/params.php
$this->ignore_fieldsets = array('images',  'jmetadata', 'item_associations');

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

	<?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>
	<div>

		<?php echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => 'images')); ?>
		<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'images', Text::_('COM_WSACAROUSEL_IMAGE')); ?>
		<div class="<?php if(version_compare(JVERSION, '4.0', '>=')) echo 'row'; else echo 'row-fluid';?>">
			<div class="col-md-9  fltlft span9 well">
			<?php foreach ($this->form->getFieldset('images') as $field) : ?>
				<?php echo $field->renderField(); ?>
			<?php endforeach; ?>
			</div>
			<div class="col-md-3  fltrt span3 well">
				<div class="card card-light">
					<div class="card-body">
						<?php echo LayoutHelper::render('joomla.edit.global', $this);   ?>
						<?php echo LayoutHelper::render('joomla.edit.metadata', $this); ?>
					</div>
				</div>		
			</div>
		</div>	
		<?php echo HTMLHelper::_('bootstrap.endTab'); ?>

		<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'details', empty($this->item->id) ? Text::_('COM_WSACAROUSEL_DESCRIPTION') : Text::sprintf('COM_WSACAROUSEL_DESCRIPTION', $this->item->id)); ?>
		<div class="<?php if(version_compare(JVERSION, '4.0', '>=')) echo 'row'; else echo 'row-fluid';?>">
			<div class="col-md-9  fltlft span9 well">
				<div class="form-vertical">
					<fieldset class="adminform">


						<div class="tab-content">

							<div class="control-group">
								<div class="control-label"><?php echo $this->form->getLabel('description'); ?></div>
								<div class="controls"><?php echo $this->form->getInput('description'); ?></div>
							</div>

						</div>
					</fieldset>
				</div>
			</div>
		</div>	
		<?php echo HTMLHelper::_('bootstrap.endTab'); ?>

		<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'attrib-jbasic', Text::_('COM_WSACAROUSEL_LINKING_OPTIONS')); ?>
		<div class="<?php if(version_compare(JVERSION, '4.0', '>=')) echo 'row'; else echo 'row-fluid';?>">
			<div class="col-md-9  fltrt span9 well">
						<?php echo LayoutHelper::render('joomla.edit.params', $this); ?>
			</div>
		</div>
		<?php echo HTMLHelper::_('bootstrap.endTab');  ?>

		
		<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'publishing', Text::_('JGLOBAL_FIELDSET_PUBLISHING')); ?>
		<div class="<?php if(version_compare(JVERSION, '4.0', '>=')) echo 'row'; else echo 'row-fluid';?>">
			<div class="col-md-9  fltrt span9 well">
				<?php echo LayoutHelper::render('joomla.edit.publishingdata', $this); ?>
			</div>
		</div>
		<?php echo HTMLHelper::_('bootstrap.endTab'); ?>
		<?php echo HTMLHelper::_('bootstrap.endTabSet'); ?>
	</div>
	<input type="hidden" name="task" value="" />
	<?php echo HTMLHelper::_('form.token'); ?>
</form>

<div class="clr"></div>
