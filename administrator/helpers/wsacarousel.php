<?php
/**
 * @version $Id: wsacarousel.php 0.0.1 2018-02-17
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 Waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://Waasdorpsoekhan.nl
 * @author email contact@Waasdorpsoekhan.nl
 * @developer Bram Waasdorp
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

defined('_JEXEC') or die;

abstract class WsaCarouselHelper
{
	
	public static function addSubmenu($vName)
	{
		if($vName=='item' || $vName=='category') return;
		$version = new JVersion;
		
		if (version_compare($version->getShortVersion(), '3.0.0', '<')) {
			
			JSubMenuHelper::addEntry(
				JText::_('COM_WsaCarousel_SUBMENU_CPANEL'),
				'index.php?option=com_WsaCarousel',
				$vName == 'cpanel'
			);
			JSubMenuHelper::addEntry(
				JText::_('COM_WsaCarousel_SUBMENU_SLIDES'),
				'index.php?option=com_WsaCarousel&view=items',
				$vName == 'items'
			);
			JSubMenuHelper::addEntry(
				JText::_('COM_WsaCarousel_SUBMENU_CATEGORIES'),
				'index.php?option=com_categories&extension=com_WsaCarousel',
				$vName == 'categories'
			);
	
			
		} else {
			
			JHtmlSidebar::addEntry(
				JText::_('COM_WsaCarousel_SUBMENU_CPANEL'),
				'index.php?option=com_WsaCarousel',
				$vName == 'cpanel'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_WsaCarousel_SUBMENU_SLIDES'),
				'index.php?option=com_WsaCarousel&view=items',
				$vName == 'items'
			);
			JHtmlSidebar::addEntry(
				JText::_('COM_WsaCarousel_SUBMENU_CATEGORIES'),
				'index.php?option=com_categories&extension=com_WsaCarousel',
				$vName == 'categories'
			);
		}
		
		if ($vName=='categories') {
			JToolBarHelper::title(
			JText::sprintf('COM_WsaCarousel_CATEGORIES_TITLE',JText::_('com_WsaCarousel')),
			'slider-categories');
		}
	}
	
}
?>