<?php 
/**
 * @version $Id: view.html.php 48 2017-08-04 11:41:27Z szymon $
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

defined('_JEXEC') or die( 'Restricted access' );
//use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView;
//use Joomla\CMS\Toolbar\ToolbarHelper;
//use Joomla\CMS\Uri\Uri;
//use Joomla\CMS\Language\Text;

    class_alias (  'JToolbarHelper' , 'ToolbarHelper' );




jimport( 'joomla.application.component.view');
jimport( 'joomla.application.categories');
jimport('joomla.html.pane');

class WsaCarouselViewCpanel extends HtmlView
{
	function display($tpl = null)
	{
		ToolBarHelper::title( JText::_('COM_WSACAROUSEL'));
		
		ToolBarHelper::preferences('COM_WSACAROUSEL', 550, 875);
		
		if (class_exists('JHtmlSidebar')){
			$this->sidebar = JHtmlSidebar::render();
		}
		
		parent::display($tpl);
	}
}
