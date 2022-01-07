<?php
/**
 * @version: 1.0.3 
 * $Id: HtmlView.php
 * @package Joomla.Administrator
 * @subpackage com_wsacarousel
 * @copyright Copyright (C) 2018 -2022 waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://waasdorpsoekhan.nl
 * @author email contact@waasdorpsoekhan.nl
 * @developer A.H.C.Waasdorp
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
 2022-01-06
 */
namespace WaasdorpSoekhan\Component\Wsacarousel\Administrator\View\Item;

// Check to ensure this file is included in Joomla!
\defined('_JEXEC') or die( 'Restricted access' );
use Joomla\CMS\Factory;
//use Joomla\CMS\Component\ComponentHelper;
//use Joomla\CMS\HTML\Helpers\Sidebar;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;  // v4
// use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;

/**
 * HTML View class for the Wsacarousel component
 *
 * @since  1.0.1
 */
class HtmlView extends BaseHtmlView
{
    /**
     * The Form object
     *
     * // @var  Joomla\CMS\Form\Form
     */
    protected $form;
    
    /**
     * The active item
     *
     * @var  object
     */
    protected $item;
    
    /**
     * The model state
     *
     * //@var  \JObject
     */
    protected $state;
    
    /**
     * Flag if an association exists
     *
     * @var  boolean
     */
    protected $assoc;
    
    /**
     * The actions the user is authorised to perform
     *
     * //@var    \JObject
     * @since  4.0.0
     */
    protected $canDo;
    
	public function display($tpl = null)
	{
		// Initialiase variables.
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');
		$this->canDo = ContentHelper::getActions('com_wsacarousel');
		$this->assoc = $this->get('Assoc');
		
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
		    throw new \Exception(implode("\n", $errors), 500);
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
		$canDo = $this->canDo;
		
		$text = $isNew ? Text::_( 'COM_WSACAROUSEL_NEW' ) : Text::_( 'COM_WSACAROUSEL_EDIT' );
		ToolBarHelper::title(   Text::_( 'COM_WSACAROUSEL_ITEM' ).': <small><small>[ ' . $text.' ]</small></small>', 'generic.png' );
		
//		if (version_compare(JVERSION, '4.0', '>=')) { // v4
		    if ($isNew) 
		    {
		          ToolbarHelper::saveGroup(
		              [
		                  ['apply', 'item.apply'],
		                  ['save', 'item.save'],
		                  ['save2new', 'item.save2new']
		              ],
		              'btn-success'
		              );
		    
		          ToolbarHelper::cancel('item.cancel');
            }
		
            else
            {
                // Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
                //$itemEditable = $canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_user_id == $userId);
                $itemEditable = true;
                
                $toolbarButtons = [];
                
                // Can't save the record if it's checked out and editable
                if (!$checkedOut && $itemEditable)
                {
                    $toolbarButtons[] = ['apply', 'item.apply'];
                    $toolbarButtons[] = ['save', 'item.save'];
                    
                    //if ($canDo->get('core.create'))
                    {
                        $toolbarButtons[] = ['save2new', 'item.save2new'];
                    }
                }
                
                // If an existing item, can save to a copy.
                //if ($canDo->get('core.create'))
                {
                    $toolbarButtons[] = ['save2copy', 'item.save2copy'];
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
                ToolbarHelper::cancel('item.cancel', 'JTOOLBAR_CLOSE');
            }
//		} // end v4

	}
}
