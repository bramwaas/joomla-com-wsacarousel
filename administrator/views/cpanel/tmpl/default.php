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
 * administrator/views/cpanel/tmpl/default.php default layout for cpanel
 * that can be used by all JVERSION s. Used for JVERSION < 4.0
 * preferred default layout for cpanel JVERSION>=4.0: administrator/tmpl/cpanel/default.php 
 * will be used by JVERSION >= 4.0. if available.
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
 * 2018-3-4 pre version 3 deleted
 */


defined('_JEXEC') or die('Restricted access'); 
use Joomla\CMS\Language\Text;

?>

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
				<div class="module-title nav-header"><?php echo Text::_('COM_WSACAROUSEL_SUBMENU_CPANEL') ?></div>
				<div class="row-striped">
					<div class="row-fluid">
						<div class="icon">
							<a href="index.php?option=com_categories&extension=com_wsacarousel">
								<img src="components/com_wsacarousel/assets/icon-48-category.png" alt="<?php echo Text::_('COM_WSACAROUSEL_SUBMENU_CATEGORIES') ?>" />
								<span><?php echo Text::_('COM_WSACAROUSEL_SUBMENU_CATEGORIES'); ?></span>
							</a>
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="icon">
							<a href="index.php?option=COM_WSACAROUSEL&view=items">
								<img src="components/com_wsacarousel/assets/icon-48-slides.png" alt="<?php echo Text::_('COM_WSACAROUSEL_SUBMENU_SLIDES') ?>" />
								<span><?php echo Text::_('COM_WSACAROUSEL_SUBMENU_SLIDES'); ?></span>
							</a>
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="icon">
							<a href="index.php?option=com_categories&view=category&layout=edit&extension=com_wsacarousel">
								<img src="components/com_wsacarousel/assets/icon-48-category-add.png" alt="<?php echo Text::_('COM_WSACAROUSEL_NEW_CATEGORY') ?>" />
								<span><?php echo Text::_('COM_WSACAROUSEL_NEW_CATEGORY'); ?></span>
							</a>
						</div>
					</div>
					<div class="row-fluid">
						<div class="icon">
							<a href="index.php?option=COM_WSACAROUSEL&view=item&layout=edit">
								<img src="components/com_wsacarousel/assets/icon-48-slide-add.png" alt="<?php echo Text::_('COM_WSACAROUSEL_NEW_SLIDE') ?>" />
								<span><?php echo Text::_('COM_WSACAROUSEL_NEW_SLIDE'); ?></span>
							</a>
						</div>
					</div>
					<div class="row-fluid">
						<div class="icon">
							<a href="https://www.waasdorpsoekhan.nl/extensions/com_wsacarousel.html" target="_blank">
								<img src="components/com_wsacarousel/assets/icon-48-help.png" alt="<?php echo Text::_('COM_WSACAROUSEL_DOCUMENTATION') ?>" />
								<span><?php echo Text::_('COM_WSACAROUSEL_DOCUMENTATION'); ?></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<div class="cpanel-right span4">
			<div class="cpanel well">
				<div class="row-fluid">
					<iframe src="https://www.waasdorpsoekhan.nl/index.php?option=com_content&view=article&tmpl=component&id=437" style="border:0; width: 100%; max-width: 450px; height: 370px; margin: -10px 0; padding: 0;"></iframe>
				</div>
			</div>
		</div>

</div>
</div>



<div class="clr" style="clear: both"></div>
<?php echo WSACAROUSELFOOTER; ?>