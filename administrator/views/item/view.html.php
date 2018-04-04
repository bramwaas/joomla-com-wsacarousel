<?php
/**
 * @version $Id: view.html.php 48 2017-08-04 11:41:27Z szymon $
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://waasdorpsoekhan.nl
 * @author email contact@waasdorpsoekhan.nl
 * @developer Szymon Woronowski - szymon.woronowski@design-joomla.eu
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
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView;
//use Joomla\CMS\Toolbar\ToolbarHelper;  // v4
// use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;


if (version_compare(JVERSION, '4.0', '>=')) {
    class_alias('Joomla\CMS\Toolbar\ToolbarHelper', 'ToolbarHelper'); // v4
} else {
    class_alias('JToolbarHelper' , 'ToolbarHelper' );  //v3
}





jimport('joomla.application.component.view');
class WsaCarouselViewItem extends HtmlView
{
	protected $form;
	protected $item;
	protected $state;

	public function display($tpl = null)
	{
		// Initialiase variables.
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
		    //			JError::raiseError(500, implode("\n", $errors));   // no joomla 4.0 alternative use standard php.
		    throw new Exception(implode("\n", $errors), 500);
		    return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}
	
	protected function addToolbar()
	{
//		JRequest::setVar('hidemainmenu', true);
	    $jinput = Factory::getApplication()->input;
	    $jinput->set('hidemainmenu', true);
	    
		$user		= Factory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);
		$canDo		= true; //ContactHelper::getActions($this->state->get('filter.category'));

		$text = $isNew ? Text::_( 'COM_WSACAROUSEL_NEW' ) : Text::_( 'COM_WSACAROUSEL_EDIT' );
		ToolBarHelper::title(   Text::_( 'COM_WSACAROUSEL_ITEM' ).': <small><small>[ ' . $text.' ]</small></small>', 'generic.png' );
		
		if (version_compare(JVERSION, '4.0', '>=')) { // v4
		    if ($isNew) 
		    {
		          ToolbarHelper::saveGroup(
		              [
		                  ['apply', 'tag.apply'],
		                  ['save', 'tag.save'],
		                  ['save2new', 'tag.save2new']
		              ],
		              'btn-success'
		              );
		    
		          ToolbarHelper::cancel('tag.cancel');
            }
		
            else
            {
                // Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
                //$itemEditable = $canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_user_id == $userId);
                $itemEditable = true;
                
                $toolbarButtons = [];
                
                // Can't save the record if it's checked out and editable
                //if (!$checkedOut && $itemEditable)
                {
                    $toolbarButtons[] = ['apply', 'tag.apply'];
                    $toolbarButtons[] = ['save', 'tag.save'];
                    
                    if ($canDo->get('core.create'))
                    {
                        $toolbarButtons[] = ['save2new', 'tag.save2new'];
                    }
                }
                
                // If an existing item, can save to a copy.
                //if ($canDo->get('core.create'))
                {
                    $toolbarButtons[] = ['save2copy', 'tag.save2copy'];
                }
                
                ToolbarHelper::saveGroup(
                    $toolbarButtons,
                    'btn-success'
                    );
                /*
                 if (ComponentHelper::isEnabled('com_contenthistory') && $this->state->params->get('save_history', 0) && $itemEditable)
                 {
                 ToolbarHelper::versions('com_tags.tag', $this->item->id);
                 }
                 */
                ToolbarHelper::cancel('tag.cancel', 'JTOOLBAR_CLOSE');
            }
		} // end v4
		else 
		
		{ // v3
		if ($isNew)  {
			// For new records, check the create permission.
			//if ($canDo->get('core.create')) {
				ToolBarHelper::apply('item.apply', 'JTOOLBAR_APPLY');
				ToolBarHelper::save('item.save', 'JTOOLBAR_SAVE');
				ToolBarHelper::custom('item.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
			//}

			ToolBarHelper::cancel('item.cancel', 'JTOOLBAR_CANCEL');
		}
		else {
			// Can't save the record if it's checked out.
			if (!$checkedOut) {
				// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
				//if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId)) {
					ToolBarHelper::apply('item.apply', 'JTOOLBAR_APPLY');
					ToolBarHelper::save('item.save', 'JTOOLBAR_SAVE');

					// We can save this record, but check the create permission to see if we can return to make a new one.
					//if ($canDo->get('core.create')) {
						ToolBarHelper::custom('item.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
					//}
				//}
			}

			// If checked out, we can still save
			//if ($canDo->get('core.create')) {
				ToolBarHelper::custom('item.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
			//}

			ToolBarHelper::cancel('item.cancel', 'JTOOLBAR_CLOSE');
		}
		}  // end v3

	}
}
