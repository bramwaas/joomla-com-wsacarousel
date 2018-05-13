<?php
/**
 * @version 0.0.3
 * @package     Joomla.Administrator
 * @subpackage  com_wsacarousel
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
namespace Joomla\Component\Wsacarousel\Administrator\Model;

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;


//jimport('joomla.application.component.modellist');

class ItemsModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array                $config   An optional associative array of configuration settings.
     * @param   MVCFactoryInterface  $factory  The factory.
     *
     * @see     \JControllerLegacy
     * @since   1.6
     */
    public function __construct($config = array(),MVCFactoryInterface $factory = null)
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'alias', 'a.alias',
				'catid', 'a.catid', 'category_title',
				'ordering', 'a.ordering',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',
				'published', 'a.published',
				'access', 'a.access', 'access_level',
				'created', 'a.created',
				'created_by', 'a.created_by',
				'language', 'a.language'
			);
		}

		parent::__construct($config, $factory);
    }
	
    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return    void
     *
     * @since    3.1
     */
    protected function populateState($ordering = 'a.ordering', $direction = 'asc')
	{
		// Initialise variables.
		$app = Factory::getApplication();

		$search = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $this->getUserStateFromRequest($this->context.'.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		$category = $this->getUserStateFromRequest($this->context.'.filter.category', 'filter_category', '');
		$this->setState('filter.category', $category);
		
		// List state information.
		parent::populateState($ordering , $direction);
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   3.1
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.search');
		$id	.= ':'.$this->getState('filter.published');
		$id	.= ':'.$this->getState('filter.category');
		
		return parent::getStoreId($id);
	}
	
	/**
	 * Method to create a query for a list of items.
	 *
	 * @return  string
	 *
	 * @since  3.1
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = Factory::getUser();
		
		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*'
			)
		);
		$query->from($db->quoteName('#__wsacarousel', 'a'));
		
		// Join over the users for the checked out user.
		$query->select($db->quoteName('uc.name', 'editor'))
		->join(
		    'LEFT',
		    $db->quoteName('#__users', 'uc') . ' ON ' . $db->quoteName('uc.id') . ' = ' . $db->quoteName('a.checked_out')
		    );
// new from contacts		
		// Join over the asset groups.
		$query->select($db->quoteName('ag.title', 'access_level'))
		->join(
		    'LEFT',
		    $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
		    );
		// end from contacts
		
		// Join over the categories.
		$query->select($db->quoteName('c.title', 'category_title'))
		->join(
		    'LEFT',
		    $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
		    );
// new from contacts		
		// Filter by access level.
		if ($access = $this->getState('filter.access'))
		{
		    $query->where($db->quoteName('a.access') . ' = ' . (int) $access);
		}
		
		// Implement View Level Access
		if (!$user->authorise('core.admin'))
		{
		    $groups = implode(',', $user->getAuthorisedViewLevels());
		    $query->where($db->quoteName('a.access') . ' IN (' . $groups . ')');
		}
		
// end from contacts		
		// Filter by published state
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('a.published = ' . (int) $published);
		}
		else if ($published === '') {
			$query->where('(a.published = 0 OR a.published = 1)');
		}
		
		// Filter by category state
		$category = $this->getState('filter.category');
		if (is_numeric($category)) {
			$query->where('a.catid = ' . (int) $category);
		}
		
		// Filter by search in title.
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			}
			else {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(a.title LIKE '.$search.' OR a.alias LIKE '.$search.')');
			}
		}
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
		if ($orderCol == 'a.ordering' || $orderCol == 'category_title') {
			$orderCol = 'category_title '.$orderDirn.', a.ordering';
		}
		$query->order($db->escape($orderCol.' '.$orderDirn));
		
		return $query;
	}
	
}
