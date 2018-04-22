<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\Wsacarousel\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Registry\Registry;
use Joomla\String\StringHelper;


/**
 * Wsacarousel Item table
 *
 * @since  3.1
 */
class ItemTable extends Table
{
	/**
	 * Constructor
	 *
	 * @param   \JDatabaseDriver  $db  A database connector object
	 */
	public function __construct(DatabaseDriver $db)
	{
		$this->typeAlias = 'com_wsacarousel.item';

		parent::__construct('#__wsacarousel', 'id', $db);
	}

	/**
	 * Overloaded bind function
	 *
	 * @param   array  $array   Named array
	 * @param   mixed  $ignore  An optional array or space separated list of properties
	 * to ignore while binding.
	 *
	 * @return  mixed  Null if operation was satisfactory, otherwise returns an error string
	 *
	 * @see     \JTable::bind
	 * @since   3.1
	 */
	public function bind($array, $ignore = '')
	{
		if (isset($array['params']) && is_array($array['params']))
		{
			$registry = new Registry($array['params']);
			$array['params'] = (string) $registry;
		}
		if(empty($array['alias'])) {
		    $array['alias'] = $array['title'];
		}
		$array['alias'] = OutputFilter::stringURLSafe($array['alias']);
		if(trim(str_replace('-','',$array['alias'])) == '') {
		    $array['alias'] = Factory::getDate()->format("Y-m-d-H-i-s");
		}
		
		if (isset($array['metadata']) && is_array($array['metadata']))
		{
			$registry = new Registry($array['metadata']);
			$array['metadata'] = (string) $registry;
		}
/*
		if (isset($array['urls']) && is_array($array['urls']))
		{
			$registry = new Registry($array['urls']);
			$array['urls'] = (string) $registry;
		}

		if (isset($array['images']) && is_array($array['images']))
		{
			$registry = new Registry($array['images']);
			$array['images'] = (string) $registry;
		}
*/
		return parent::bind($array, $ignore);
	}

	/**
	 * Overloaded check method to ensure data integrity.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.1
	 * @throws  \UnexpectedValueException
	 */
	public function check()
	{
		try
		{
			parent::check();
		}
		catch (\Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		// Check for valid name.
		if (trim($this->title) == '')
		{
			throw new \UnexpectedValueException(sprintf('The title is empty'));
		}

		if (empty($this->alias))
		{
			$this->alias = $this->title;
		}

		$this->alias = ApplicationHelper::stringURLSafe($this->alias, $this->language);

		if (trim(str_replace('-', '', $this->alias)) == '')
		{
			$this->alias = Factory::getDate()->format('Y-m-d-H-i-s');
		}

		// Check the publish down date is not earlier than publish up.
		if ((int) $this->publish_down > 0 && $this->publish_down < $this->publish_up)
		{
			throw new \UnexpectedValueException(sprintf('End publish date is before start publish date.'));
		}

		// Clean up keywords -- eliminate extra spaces between phrases
		// and cr (\r) and lf (\n) characters from string
		if (!empty($this->metakey))
		{
			// Only process if not empty
			// Define array of characters to remove
			$bad_characters = array("\n", "\r", "\"", '<', '>');

			// Remove bad characters
			$after_clean = StringHelper::str_ireplace($bad_characters, '', $this->metakey);

			// Create array using commas as delimiter
			$keys = explode(',', $after_clean);
			$clean_keys = array();

			foreach ($keys as $key)
			{
				if (trim($key))
				{
					// Ignore blank keywords
					$clean_keys[] = trim($key);
				}
			}

			// Put array back together delimited by ", "
			$this->metakey = implode(', ', $clean_keys);
		}

		// Clean up description -- eliminate quotes and <> brackets
		if (!empty($this->metadesc))
		{
			// Only process if not empty
			$bad_characters = array("\"", '<', '>');
			$this->metadesc = StringHelper::str_ireplace($bad_characters, '', $this->metadesc);
		}

		// Not Null sanity check
		$date = Factory::getDate();

		if (empty($this->params))
		{
			$this->params = '{}';
		}

		if (empty($this->metadesc))
		{
			$this->metadesc = '';
		}

		if (empty($this->metakey))
		{
			$this->metakey = '';
		}

		if (empty($this->metadata))
		{
			$this->metadata = '{}';
		}

		if (empty($this->urls))
		{
			$this->urls = '{}';
		}

		if (empty($this->images))
		{
			$this->images = '{}';
		}

		if (!(int) $this->checked_out_time)
		{
			$this->checked_out_time = $date->toSql();
		}

		if (!(int) $this->modified_time)
		{
			$this->modified_time = $date->toSql();
		}

		if (!(int) $this->modified_time)
		{
			$this->modified_time = $date->toSql();
		}

		if (!(int) $this->publish_up)
		{
			$this->publish_up = $date->toSql();
		}

		if (!(int) $this->publish_down)
		{
			$this->publish_down = $date->toSql();
		}

		return true;
	}

	/**
	 * Overriden \JTable::store to set modified data and user id.
	 *
	 * @param   boolean  $updateNulls  True to update fields even if they are null.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.1
	 */
	public function store($updateNulls = false)
	{
		$date = Factory::getDate();
		$user = Factory::getUser();

		$isNew = ($this->id==0 ? true : false);
		$success = parent::store($updateNulls);
		$jinput = Factory::getApplication()->input;
		//		if($isNew && $success && JRequest::getVar('view') == 'item') {
		if($isNew && $success && $jinput->get('view') == 'item') {
		    $this->reorder('catid = '.$this->catid);
		}
		
		$this->modified_time = $date->toSql();

		if ($this->id)
		{
			// Existing item
			$this->modified_user_id = $user->get('id');
		}
		else
		{
			// New tag. A tag created and created_by field can be set by the user,
			// so we don't touch either of these if they are set.
			if (!(int) $this->created_time)
			{
				$this->created_time = $date->toSql();
			}

			if (empty($this->created_user_id))
			{
				$this->created_user_id = $user->get('id');
			}
		}

		// Verify that the alias is unique
		$table = new static($this->getDbo());

		if ($table->load(array('alias' => $this->alias)) && ($table->id != $this->id || $this->id == 0))
		{
			$this->setError(Text::_('COM_WSACAROUSEL_ERROR_UNIQUE_ALIAS'));

			return false;
		}

		return parent::store($updateNulls);
	}

}
