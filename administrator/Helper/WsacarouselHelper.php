<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\Wsacarousel\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Version;
use Joomla\CMS\Toolbar\ToolbarHelper;  // v4
use Joomla\CMS\Language\Text;
/**
 * Contact component helper.
 *
 * @since  1.6
 */
class WsacarouselHelper extends ContentHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  The name of the active view.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
    public static function addSubmenu($vName)
    {
        if($vName=='item' || $vName=='category') return;
        $version = new Version;
        
        
        
        \JHtmlSidebar::addEntry(
            Text::_('COM_WSACAROUSEL_SUBMENU_CPANEL'),
            'index.php?option=com_wsacarousel',
            $vName == 'cpanel'
            );
        \JHtmlSidebar::addEntry(
            Text::_('COM_WSACAROUSEL_SUBMENU_SLIDES'),
            'index.php?option=com_wsacarousel&view=items',
            $vName == 'items'
            );
        \JHtmlSidebar::addEntry(
            Text::_('COM_WSACAROUSEL_SUBMENU_CATEGORIES'),
            'index.php?option=com_categories&extension=com_wsacarousel',
            $vName == 'categories'
            );

        \JHtmlSidebar::addEntry(
            'Helper/WsacarouselHelper.php ',
            'index.php?option=com_categories&extension=com_wsacarousel',
            $vName == 'categories'
            );
        
        
        if ($vName=='categories') {
            ToolBarHelper::title(
                Text::sprintf('COM_WSACAROUSEL_CATEGORIES_TITLE',Text::_('COM_WSACAROUSEL')),
                'slider-categories');
        }
    }
    
	/**
	 * Adds Count Items for Category Manager.
	 *
	 * @param   \stdClass[]  &$items  The contact category objects
	 *
	 * @return  \stdClass[]
	 *
	 * @since   3.5
	 */
	public static function countItems(&$items)
	{
		$db = Factory::getDbo();

		foreach ($items as $item)
		{
			$item->count_trashed = 0;
			$item->count_archived = 0;
			$item->count_unpublished = 0;
			$item->count_published = 0;
			$query = $db->getQuery(true);
			$query->select('published AS state, count(*) AS count')
				->from($db->qn('#__wsacarousel'))
				->where('catid = ' . (int) $item->id)
				->group('published');
			$db->setQuery($query);
			$slides = $db->loadObjectList();

			foreach ($slides as $slide)
			{
			    if ($slide->state == 1)
				{
				    $item->count_published = $slide->count;
				}

				if ($slide->state == 0)
				{
				    $item->count_unpublished = $slide->count;
				}

				if ($slide->state == 2)
				{
				    $item->count_archived = $slide->count;
				}

				if ($slide->state == -2)
				{
				    $item->count_trashed = $slide->count;
				}
			}
		}

		return $items;
	}

}
