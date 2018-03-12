<?php
/**
 * @version $Id: wsacarousel.php 0.0.1 2018-02-17
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 Waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://www.Waasdorpsoekhan.nl
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
 * 2018-03-04 deleted pre version 3 code.
 */

defined('_JEXEC') or die;
use Joomla\CMS\Version;
//use Joomla\CMS\Toolbar\ToolbarHelper;  // v4
use Joomla\CMS\Language\Text;
class_alias (  'JToolbarHelper' , 'ToolbarHelper' );  // v3


abstract class WsaCarouselHelper
{
	
	public static function addSubmenu($vName)
	{
		if($vName=='item' || $vName=='category') return;
		$version = new Version;
		
 
			
			JHtmlSidebar::addEntry(
				Text::_('COM_WSACAROUSEL_SUBMENU_CPANEL'),
				'index.php?option=com_wsacarousel',
				$vName == 'cpanel'
			);
			JHtmlSidebar::addEntry(
				Text::_('COM_WSACAROUSEL_SUBMENU_SLIDES'),
				'index.php?option=com_wsacarousel&view=items',
				$vName == 'items'
			);
			JHtmlSidebar::addEntry(
				Text::_('COM_WSACAROUSEL_SUBMENU_CATEGORIES'),
				'index.php?option=com_categories&extension=com_wsacarousel',
				$vName == 'categories'
			);

		
		if ($vName=='categories') {
			ToolBarHelper::title(
			Text::sprintf('COM_WSACAROUSEL_CATEGORIES_TITLE',Text::_('COM_WSACAROUSEL')),
			'slider-categories');
		}
	}
	
}
?>