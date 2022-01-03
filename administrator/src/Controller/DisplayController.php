<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_wsacarousel
 *
 * @copyright   Copyright (C) 2019 - 2022 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace WaasdorpSoekhan\Component\Wsacarousel\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
// use Joomla\CMS\Language\Text;
// use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use WaasdorpSoekhan\Component\Wsacarousel\Administrator\Helper\WsacarouselHelper;

/**
 * Wsacarousel view class for the Tags package.
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
	protected $default_view = 'items';

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
	public function display($cachable = false, $urlparams = array())
	{
	    $db = Factory::getDBO();
	    $db->setQuery("SELECT manifest_cache FROM #__extensions WHERE element='com_wsacarousel' LIMIT 1");
	    $version = json_decode($db->loadResult());
	    $version = $version->version;
	    
	    define('WSACAROUSELFOOTER', '<div style="text-align: center; margin: 10px 0;">WsaCarousel (version '.$version.'), &copy; 2018-'.Factory::getDate()->format('Y').' Copyright by <a target="_blank" href="https://www.waasdorpsoekhan.nl">www.waasdorpsoekhan.nl</a>, All Rights Reserved.<br /><a target="_blank" href="https://www.waasdorpsoekhan.nl"><img src="'.Uri::base().'components/com_wsacarousel/assets/logo.png" alt="www.waasdorpsoekhan.nl" style="margin: 20px 0 0;" /></a></div>');
	    
	    
	    
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
		// Load the submenu.
		WsacarouselHelper::addSubmenu($view);
		return parent::display($cachable, $urlparams );
	}
}
