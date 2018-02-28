<?php 
/**
 * @version $Id: default.php 48 2017-08-04 11:41:27Z szymon $
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://waasdorpsoekhan.nl
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


defined('_JEXEC') or die('Restricted access'); ?>

<?php if (version_compare(JVERSION, '3.0', '>=')) { ?>

<?php if(!empty( $this->sidebar)): ?>
<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="span10">
<?php else: ?>
<div id="j-main-container">
<?php endif;?>
	
<div class="row-fluid">
		<div class="cpanel-left span8">
			<div id="cpanel" class="cpanel well">
				<div class="module-title nav-header"><?php echo JText::_('COM_WSACAROUSEL_SUBMENU_CPANEL') ?></div>
				<div class="row-striped">
					<div class="row-fluid">
						<div class="icon">
							<a href="index.php?option=com_categories&extension=COM_WSACAROUSEL">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-category.png" alt="<?php echo JText::_('COM_WSACAROUSEL_SUBMENU_CATEGORIES') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_SUBMENU_CATEGORIES'); ?></span>
							</a>
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="icon">
							<a href="index.php?option=COM_WSACAROUSEL&view=items">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-slides.png" alt="<?php echo JText::_('COM_WSACAROUSEL_SUBMENU_SLIDES') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_SUBMENU_SLIDES'); ?></span>
							</a>
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="icon">
							<a href="index.php?option=com_categories&view=category&layout=edit&extension=COM_WSACAROUSEL">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-category-add.png" alt="<?php echo JText::_('COM_WSACAROUSEL_NEW_CATEGORY') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_NEW_CATEGORY'); ?></span>
							</a>
						</div>
					</div>
					<div class="row-fluid">
						<div class="icon">
							<a href="index.php?option=COM_WSACAROUSEL&view=item&layout=edit">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-slide-add.png" alt="<?php echo JText::_('COM_WSACAROUSEL_NEW_SLIDE') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_NEW_SLIDE'); ?></span>
							</a>
						</div>
					</div>
					<div class="row-fluid">
						<div class="icon">
							<a href="https://waasdorpsoekhan.nl/extensions/dj-image-slider.html" target="_blank">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-help.png" alt="<?php echo JText::_('COM_WSACAROUSEL_DOCUMENTATION') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_DOCUMENTATION'); ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<div class="cpanel-right span4">
			<div class="cpanel well">
				<div class="row-fluid">
					<iframe src="https://waasdorpsoekhan.nl/index.php?option=com_content&view=article&tmpl=component&id=437" style="border:0; width: 100%; max-width: 450px; height: 370px; margin: -10px 0; padding: 0;"></iframe>
				</div>
			</div>
		</div>

</div>
</div>

<?php } else { ?>

<table class="adminform">
	<tr>
		<td width="55%" valign="top">
			<div class="cpanel-left">
				<div id="cpanel">
					<div style="float:left;">
						<div class="icon">
							<a href="index.php?option=com_categories&extension=COM_WSACAROUSEL">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-category.png" alt="<?php echo JText::_('COM_WSACAROUSEL_SUBMENU_CATEGORIES') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_SUBMENU_CATEGORIES'); ?></span>
							</a>
						</div>
					</div>
					<div style="float:left;">
						<div class="icon">
							<a href="index.php?option=COM_WSACAROUSEL&view=items">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-slides.png" alt="<?php echo JText::_('COM_WSACAROUSEL_SUBMENU_SLIDES') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_SUBMENU_SLIDES'); ?></span>
							</a>
						</div>
					</div>
					<div style="float:left;">
						<div class="icon">
							<a href="index.php?option=com_categories&view=category&layout=edit&extension=COM_WSACAROUSEL">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-category-add.png" alt="<?php echo JText::_('COM_WSACAROUSEL_NEW_CATEGORY') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_NEW_CATEGORY'); ?></span>
							</a>
						</div>
					</div>
					<div style="float:left;">
						<div class="icon">
							<a href="index.php?option=COM_WSACAROUSEL&view=item&layout=edit">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-slide-add.png" alt="<?php echo JText::_('COM_WSACAROUSEL_NEW_SLIDE') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_NEW_SLIDE'); ?></span>
							</a>
						</div>
					</div>
					<div style="float:left;">
						<div class="icon">
							<a href="https://waasdorpsoekhan.nl/extensions/dj-image-slider.html" target="_blank">
								<img src="components/COM_WSACAROUSEL/assets/icon-48-help.png" alt="<?php echo JText::_('COM_WSACAROUSEL_DOCUMENTATION') ?>" />
								<span><?php echo JText::_('COM_WSACAROUSEL_DOCUMENTATION'); ?></span>
							</a>
						</div>
					</div>
			
				</div>
			</div>
			<div class="cpanel-right">
				<div class="cpanel">					
						<iframe src="https://waasdorpsoekhan.nl/index.php?option=com_content&view=article&tmpl=component&id=437" style="border:0; width: 100%; max-width: 450px; height: 370px; margin: -10px 0; padding: 0;"></iframe>
					<div style="clear: both;" ></div>
				</div>
			</div>
		</td>
	</tr>
</table>
<?php } ?>

<div class="clr" style="clear: both"></div>
<?php echo wsacarouselFOOTER; ?>