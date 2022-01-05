<?php
/**
 * @version $Id: edit.php
 * @package WsaCarousel
 * @subpackage WsaCarousel Component edt item view.
 * @copyright Copyright (C) 2017 - 2022 Waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://Waasdorpsoekhan.nl
 * @author email contact@Waasdorpsoekhan.nl
 * @developer A.H.C. Waasdorp
 *
 * preferred edit layout for item JVERSION>=4.0: administrator/tmpl/item/edit.php 
 * not used by JVERSION < 4.0.
 * copied and adjusted to joomla 4 from: administrator/views/item/tmpl/edit.php 
 * that can be used by all JVERSION s.
 * if(version_compare(JVERSION, '4.0', '>=')) {} removed because versio is always >=4.0
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
 * 0.0.4 2018-04-25
 * 

 */

// No direct access.
\defined('_JEXEC') or die;
//use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Layout\LayoutHelper;

/**
 *  @var WaasdorpSoekhan\Component\Wsacarousel\Administrator\View\Item\HtmlView; $this
 *  The class where this template is a part of
 */

//// 
HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
//HTMLHelper::_('behavior.tabstate');
 

// Fieldsets to not automatically render by /layouts/joomla/edit/params.php
$this->ignore_fieldsets = array('images',  'slide', 'jmetadata', 'item_associations');

?>


<form action="<?php echo Route::_('index.php?option=com_wsacarousel&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate form-horizontal" data-version="v4.0">

	<?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>
	<div>
		<?php echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
		<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'details', Text::_('COM_WSACAROUSEL_ITEM')); ?>
		<div class="row">
			<div class="col-md-9  fltlft span9 card card-light">
					<div class="card-body">
			<?php foreach ($this->form->getFieldset('slide') as $field) : ?>
				<?php echo $field->renderField(); ?>
			<?php endforeach; ?>
				</div>		
			</div>
			<div class="col-md-3  fltrt span3 card card-light">
					<div class="card-body">
						<?php echo LayoutHelper::render('joomla.edit.global', $this);   ?>
						<?php echo LayoutHelper::render('joomla.edit.metadata', $this); ?>
				</div>		
			</div>
		</div>	
		<?php echo HTMLHelper::_('bootstrap.endTab'); ?>

		<?php echo LayoutHelper::render('joomla.edit.params', $this); ?>

		<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'publishing', Text::_('JGLOBAL_FIELDSET_PUBLISHING')); ?>
		<div class="row">
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
<?php echo WSACAROUSELFOOTER; ?>