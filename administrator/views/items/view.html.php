<?php
/**
 * @version $Id: view.html.php 48 2017-08-04 11:41:27Z szymon $
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 DJ-Extensions.com, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://www.waasdorpsoekhan.nl
 * @author email contact@www.waasdorpsoekhan.nl
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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.view');
// use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Uri\Uri;

if (!class_exists('ToolbarHelper', false)) {
    class_alias (  'JToolbarHelper' , 'ToolbarHelper' );
}




class WsaCarouselViewItems extends HtmlView
{
	protected $items;
	protected $pagination;
	protected $state;
	
	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
//			JError::raiseError(500, implode("\n", $errors));   // no joomla 4.0 alternative use standard php.
		    throw new Exception(implode("\n", $errors), 500);
			return false;
		}

		if (class_exists('JHtmlSidebar')){
			$this->sidebar = JHtmlSidebar::render();
		}
		
		foreach($this->items as $item) {
			$item->thumb = 'components/com_wsacarousel/assets/icon-image.png';						
			if(strcasecmp(substr($item->image, 0, 4), 'http') != 0 && !empty($item->image)) {
				$item->image = Uri::root(true).'/'.$item->image;
			}
			$item->preview = '<img src="'.$item->image.'" alt="'.$this->escape($item->title).'" width="300" />';
		}
		
		$this->addToolbar();		
		parent::display($tpl);
	}
	
	protected function addToolbar()
	{
		ToolBarHelper::title(JText::_('COM_WSACAROUSEL_SLIDES'), 'generic.png');

		ToolBarHelper::addNew('item.add','JTOOLBAR_NEW');
		ToolBarHelper::editList('item.edit','JTOOLBAR_EDIT');
		ToolBarHelper::deleteList('', 'items.delete','JTOOLBAR_DELETE');
		ToolBarHelper::divider();
		ToolBarHelper::custom('items.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
		ToolBarHelper::custom('items.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
		ToolBarHelper::divider();
		ToolBarHelper::preferences('com_wsacarousel', 550, 875);
		
	}
}