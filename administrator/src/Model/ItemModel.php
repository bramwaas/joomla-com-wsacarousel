<?php
/**
 * @version 1.0.3
 * @package     Joomla.Administrator
 * @subpackage com_wsacarousel
 * @copyright Copyright (C) 2017 -2022 waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://www.waasdorpsoekhan.nl
 * @author email: contact@waasdorpsoekhan.nl
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
 * 2022 01 09 removed getTable because it is unnecesary and it called the wrong J3 version of the table class
 */
namespace WaasdorpSoekhan\Component\Wsacarousel\Administrator\Model;

// No direct access
\defined('_JEXEC') or die;
//use Joomla\CMS\Access\Rules;
use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Versioning\VersionableModelTrait;
//use Joomla\CMS\Form\Form;

/**
 * Wsacarousel Component Item Model
 *
 * @since  3.1
 */
class ItemModel extends AdminModel
{
    use VersionableModelTrait;
    /**
     * Name of the form
     *
     * @var string
     * @since  4.0.0
     */
    protected $formName = 'item';
    /**
     * @var    string  The prefix to use with controller messages.
     * @since  3.1
     */
    protected $text_prefix = 'COM_WSACAROUSEL';
    
    /**
     * @var    string  The type alias for this content type.
     * @since  3.2
     */
    public $typeAlias = 'com_wsacarousel.item';
    
    /**
     * Allowed batch commands
     *
     * @var    array
     * @since  3.7.0
     */
    protected $batch_commands = array(
        'assetgroup_id' => 'batchAccess',
        'language_id' => 'batchLanguage',
    );
    
    /**
     * Method to test whether a record can be deleted.
     *
     * @param   object  $record  A record object.
     *
     * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
     *
     * @since   3.1
     */
    protected function canDelete($record)
    {
        if (!empty($record->id))
        {
            if ($record->published != -2)
            {
                return false;
            }
            
            return parent::canDelete($record);
        }
    }
    
    /**
     * Method to test whether a record can have its state changed.
     *
     * @param   object  $record  A record object.
     *
     * @return  boolean  True if allowed to change the state of the record. Defaults to the permission set in the component.
     *
     * @since   3.1
     */
    protected function canEditState($record)
    {
        return parent::canEditState($record);
    }
    
    /**
     * Auto-populate the model state.
     *
     * @note Calling getState in this method will result in recursion.
     *
     * @return  void
     *
     * @since   3.1
     */
    protected function populateState()
    {
        $app = Factory::getApplication();
        
//        $parentId = $app->input->getInt('parent_id');
//        $this->setState('tag.parent_id', $parentId);
        
        // Load the User state.
        $pk = $app->input->getInt('id');
        $this->setState($this->getName() . '.id', $pk);
        
        // Load the parameters.
        $params = ComponentHelper::getParams('com_wsacarousel');
        $this->setState('params', $params);
    }
    
	public function getForm($data = array(), $loadData = true)
	{

		// Get the form.
		$form = $this->loadForm('com_wsacarousel.item', 'item', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		/* not implemented yet
		// Modify the form based on access controls.
		if (!$this->canEditState((object) $data)) {
			// Disable fields for display.
			$form->setFieldAttribute('ordering', 'disabled', 'true');
			$form->setFieldAttribute('published', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is a record you can edit.
			$form->setFieldAttribute('ordering', 'filter', 'unset');
			$form->setFieldAttribute('published', 'filter', 'unset');
		}*/

		return $form;
	}
	
	protected function loadFormData()
	{
		// Check the session for previously entered form data. 
	    $app = Factory::getApplication();
	    $data = $app->getUserState('com_wsacarousel.edit.item.data', array());

		if (empty($data)) {
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('item.id') == 0) {
				$jinput = $app->input;
				$data->set('catid', $jinput->getInt('catid', $app->getUserState('com_wsacarousel.items.filter.category')));	
			}
		}

		return $data;
	}
	
	protected function prepareTable($table)
	{
//		jimport('joomla.filter.output');
		$date = Factory::getDate();
		$user = Factory::getUser();

		$table->title		= htmlspecialchars_decode($table->title, ENT_QUOTES);
		$table->alias		= ApplicationHelper::stringURLSafe($table->alias);

		if (empty($table->alias)) {
		    $table->alias = ApplicationHelper::stringURLSafe($table->title);
		}
		
		// Set the publish date to now
		if($table->published == 1 && intval($table->publish_up) == 0) {
			$table->publish_up = $date->toSql();
		}
		
		/*
		if (empty($table->id)) {

			// Set ordering to the last item if not set
			if (empty($table->ordering)) {
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__WsaCarousel');
				$max = $db->loadResult();

				$table->ordering = $max+1;
			}
		}
		*/
	}
	
	protected function getReorderConditions($table)
	{
		$condition = array();
		$condition[] = 'catid = '.(int) $table->catid;

		return $condition;
	}
	
}