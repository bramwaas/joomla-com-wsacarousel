<?php
/**
 * @version $Id: /View/HtmlView.php
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 - 2022 waasdorpsoekhan.com, All rights reserved.
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
 * 2018-11-04 composed from views/items/view.html.php and J4 com_tags and com_banners /View/HtmlView.php
 * 2018-05-13
 * 2022-01-03 v1.0.1
 * 2022-01-06
 */
namespace WaasdorpSoekhan\Component\Wsacarousel\Administrator\View\Items;

// Check to ensure this file is included in Joomla!
\defined('_JEXEC') or die( 'Restricted access' );

// use Joomla\CMS\Factory;
use Joomla\CMS\HTML\Helpers\Sidebar;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;  // v4

use Joomla\CMS\Uri\Uri;


/**
 * Main "Wsacarousel" Admin View (Items)
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Is this view an Empty State
     *
     * @var  boolean
     * @since 4.0.0
     */
    private $isEmptyState = false;
    
	protected $items;
	protected $pagination;
	protected $state;
	/**
	 * Form object for search filters
	 *
	 * // @var  \JForm
	 */
	public $filterForm;
	
	/**
	 * The active search filters
	 *
	 * @var  array
	 */
	public $activeFilters;

	/**
	 * The sidebar markup
	 *
	 * @var  string
	 */
	protected $sidebar;
	
	/**
	 * Display the view.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 */
	
	
	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		$this->filterForm    = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');
		if (!\count($this->items) && $this->isEmptyState = $this->get('IsEmptyState'))
		{
		    $this->setLayout('emptystate');
		}
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
		    throw new \Exception(implode("\n", $errors), 500);
			return false;
		}

		if (class_exists('Sidebar')){
			$this->sidebar = Sidebar::render();
		}
		
		foreach($this->items as $item) {
		    $item->order_up = true;
		    $item->order_dn = true;
		    $item->thumb = 'components/com_wsacarousel/assets/icon-image.png';						
			if(strcasecmp(substr($item->image, 0, 4), 'http') != 0 && !empty($item->image)) {
				$item->image = Uri::root(true).'/'.$item->image;
			}
			$item->preview = '<figure><img class="item-preview" src="'.$item->image.'" alt="'.$this->escape($item->title).'" /><figcaption class="item-caption">' .  $this->escape($item->title) . '</figcaption></figure>';
		}
		
		$this->addToolbar();		
		parent::display($tpl);
	}
	
	protected function addToolbar()
	{
		ToolBarHelper::title(Text::_('COM_WSACAROUSEL_SLIDES'), 'generic.png');

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