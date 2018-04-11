<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Joomla\Component\Wsacarousel\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;


/**
 * Tags view class for the Tags package.
 *
 * @since  3.1
 */
class DisplayController extends BaseController
{
	/**
	 * The default view.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $default_view = 'cpanel';

	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.
	 *
	 * @return  static   This object to support chaining.
	 *
	 * @since   3.1
	 */
	public function display($cachable = false, $urlparams = false)
	{
//	    $jinput = Factory::getApplication()->input;
	    
//	    require_once JPATH_COMPONENT.'/helpers/wsacarousel.php';
//	    WsaCarouselHelper::addSubmenu($jinput->getCmd('view', 'cpanel'));
//	    parent::display();
	    
	    
	    
	    $view   = $this->input->get('view', 'wsacarousel');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		// Check for edit form.
		if ($view == 'wsacarousel' && $layout == 'edit' && !$this->checkEditId('com_wsacarousel.edit.item', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			/* nog even niet controleren
			$this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id), 'error');
			$this->setRedirect(Route::_('index.php?option=com_wsacarousel&view=cpanel', false));

			return false;
			*/
		}

		parent::display();

		return $this;
	}
}
