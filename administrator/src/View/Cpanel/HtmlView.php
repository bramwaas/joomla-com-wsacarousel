<?php 
/**
 * @version $Id: 1.0.1
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 - 2022 waasdorpsoekhan.nl, All rights reserved.
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
namespace WaasdorpSoekhan\Component\Wsacarousel\Administrator\View\Cpanel;

\defined('_JEXEC') or die( 'Restricted access' );
//use Joomla\CMS\Factory;
use Joomla\CMS\HTML\Helpers\Sidebar;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;   //v4
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{
	function display($tpl = null)
	{
		ToolBarHelper::title( Text::_('COM_WSACAROUSEL'));
		
		ToolBarHelper::preferences('COM_WSACAROUSEL', 550, 875);
		
		if (class_exists('Sidebar')){
			$this->sidebar = Sidebar::render();
		}
		
		parent::display($tpl);
	}
}
