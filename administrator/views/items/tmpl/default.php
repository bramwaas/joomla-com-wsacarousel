<?php 
/**
 * @version $Id: default.php 48 2017-08-04 11:41:27Z szymon $
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://www.waasdorpsoekhan.nl
 * @author email contact@waasdorpsoekhan.nl
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
 *
 */

defined('_JEXEC') or die('Restricted access'); 

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

$isJoomla3 = version_compare(JVERSION, '3.0', '>=');
HTMLHelper::_('behavior.tooltip');
HTMLHelper::_('behavior.modal');
if($isJoomla3) HTMLHelper::_('formbehavior.chosen', 'select');

$user		= Factory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'COM_WSACAROUSEL.category');
$saveOrder	= $listOrder == 'a.ordering';

if ($isJoomla3 && $saveOrder)
{
	$saveOrderingUrl = 'index.php?option=COM_WSACAROUSEL&task=items.saveOrderAjax&tmpl=component';
	HTMLHelper::_('sortablelist.sortable', 'slidesList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<?php if(!empty( $this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
<?php else: ?>
<div id="j-main-container">
<?php endif;?>
	
<form action="<?php echo Route::_('index.php?option=COM_WSACAROUSEL&view=items'); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar" class="btn-toolbar">
		<div class="filter-search fltlft btn-group pull-left">
			<label class="filter-search-lbl element-invisible" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" placeholder="<?php echo JText::_('COM_WSACAROUSEL_SEARCH_IN_TITLE'); ?>" />
		</div>
		<div class="filter-search fltlft btn-group pull-left">
			<button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" class="btn" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="btn-group pull-right hidden-phone">
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
		<div class="filter-select fltrt btn-group pull-right">
			<select name="filter_published" class="inputbox input-medium" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
				<?php echo HTMLHelper::_('select.options', array(HTMLHelper::_('select.option', '1', 'JPUBLISHED'),HTMLHelper::_('select.option', '0', 'JUNPUBLISHED')), 'value', 'text', $this->state->get('filter.published'), true);?>
			</select>
		</div>
		<div class="filter-select fltrt btn-group pull-right">
			<select name="filter_category" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
				<?php echo HTMLHelper::_('select.options', HTMLHelper::_('category.options', 'COM_WSACAROUSEL'), 'value', 'text', $this->state->get('filter.category'));?>
			</select>
		</div>
	</fieldset>
	<div class="clr"> </div>
	
	<table class="adminlist table table-striped" id="slidesList">
		<thead>
			<tr>
			<?php if($isJoomla3) { ?>
				<th width="1%" class="nowrap center hidden-phone">
					<?php echo HTMLHelper::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
				</th>
			<?php } ?>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" />
				</th>
				<th width="8%">
					<?php echo JText::_('COM_WSACAROUSEL_IMAGE'); ?>
				</th>
				<th>
					<?php echo HTMLHelper::_('grid.sort',  'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
				</th>				
				<th width="5%">
					<?php echo HTMLHelper::_('grid.sort', 'JPUBLISHED', 'a.published', $listDirn, $listOrder); ?>
				</th>
			<?php if(!$isJoomla3) { ?>
				<th width="10%">
					<?php echo HTMLHelper::_('grid.sort',  'JGRID_HEADING_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>
					<?php if ($canOrder && $saveOrder) :?>
						<?php echo HTMLHelper::_('grid.order',  $this->items, 'filesave.png', 'items.saveorder'); ?>
					<?php endif; ?>
				</th>
			<?php } ?>
				<th width="10%">
					<?php echo HTMLHelper::_('grid.sort', 'JCATEGORY', 'category_title', $listDirn, $listOrder); ?>
				</th>
				<th width="1%">
					<?php echo HTMLHelper::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="10">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php 
		$n = count($this->items);
		foreach ($this->items as $i => $item) :
			$ordering	= ($listOrder == 'a.ordering');
			$canCreate	= $user->authorise('core.create',		'COM_WSACAROUSEL.category.'.$item->catid);
			$canEdit	= $user->authorise('core.edit',			'COM_WSACAROUSEL.category.'.$item->catid);
			$canCheckin	= $user->authorise('core.manage',		'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
			$canEditOwn	= true; //$user->authorise('core.edit.own',		'COM_WSACAROUSEL.category.'.$item->catid) && $item->created_by == $userId;
			$canChange	= $user->authorise('core.edit.state',	'COM_WSACAROUSEL.category.'.$item->catid) && $canCheckin;

			?>
			<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->catid?>">
			<?php if($isJoomla3) { ?>
				<td class="order nowrap center hidden-phone">
							<?php
							$iconClass = '';
							if (!$canChange)
							{
								$iconClass = ' inactive';
							}
							elseif (!$saveOrder)
							{
							    $iconClass = ' inactive tip-top hasTooltip" title="' . HTMLHelper::tooltipText('JORDERINGDISABLED');
							}
							?>
							<span class="sortable-handler<?php echo $iconClass ?>">
								<i class="icon-move"></i>
							</span>
							<?php if ($canChange && $saveOrder) : ?>
								<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
							<?php endif; ?>
				</td>
			<?php } ?>
				<td class="center">
					<?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
				</td>
				<td align="center">
					<?php if ($item->image) : ?>
						<a class="modal hasTip" href="<?php echo $item->image; ?>" title="<?php echo $this->escape($item->title); ?>::<?php echo htmlspecialchars($item->preview); ?>"><img src="<?php echo $item->thumb; ?>" alt="<?php echo $this->escape($item->title); ?>" style="border: 1px solid #ccc; padding: 1px;" /></a>
					<?php endif; ?>
				</td>
				<td>
					<?php if ($item->checked_out) : ?>
						<?php echo HTMLHelper::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'items.', $canCheckin); ?>
					<?php endif; ?>
					<?php if ($canEdit || $canEditOwn) : ?>
						<a href="<?php echo Route::_('index.php?option=COM_WSACAROUSEL&task=item.edit&id='.(int) $item->id); ?>">
							<?php echo $this->escape($item->title); ?></a>
					<?php else : ?>
						<?php echo $this->escape($item->title); ?>
					<?php endif; ?>
					<div class="smallsub small">
						<?php 
						$desc = strip_tags($item->description);
						if(function_exists('mb_substr')) {
							echo mb_substr($desc,0,120); if(strlen($desc) > 120) echo '...';
						} else {
							echo substr($desc,0,120); if(strlen($desc) > 120) echo '...';
						} ?>
					</div>
				</td>
				<td class="center">
					<?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'items.', true, 'cb'	); ?>
				</td>
			<?php if(!$isJoomla3) { ?>
				<td class="order" nowrap="nowrap">
					<?php if ($canChange) : ?>
						<?php if ($saveOrder) :?>
							<?php if ($listDirn == 'asc') : ?>
								<span><?php echo $this->pagination->orderUpIcon($i, ($item->catid == @$this->items[$i-1]->catid),'items.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
								<span><?php echo $this->pagination->orderDownIcon($i, $n, ($item->catid == @$this->items[$i+1]->catid), 'items.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
							<?php elseif ($listDirn == 'desc') : ?>
								<span><?php echo $this->pagination->orderUpIcon($i, ($item->catid == @$this->items[$i-1]->catid),'items.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
								<span><?php echo $this->pagination->orderDownIcon($i, $n, ($item->catid == @$this->items[$i+1]->catid), 'items.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
							<?php endif; ?>
						<?php endif; ?>
						<?php $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ?>
						<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="text-area-order input-mini" />
					<?php else : ?>
						<?php echo $item->ordering; ?>
					<?php endif; ?>
				</td>
			<?php } ?>
				<td align="center">
					<?php echo $item->category_title; ?>
				</td>
				<td align="center">
					<?php echo $item->id; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo HTMLHelper::_('form.token'); ?>
	</div>
</form>
</div>

<div class="clr" style="clear: both"></div>
<?php echo DJIMAGESLIDERFOOTER; ?>