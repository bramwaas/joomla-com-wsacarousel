<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_wsaonepage
 *
 * @copyright   (C) 2021 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * 2022-01-02   copied from com_wsaonepage and adapted .
 */

namespace WaasdorpSoekhan\Component\Wsacarousel\Administrator\Extension;

\defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
//use WaasdorpSoekhan\Component\Wsacarousel\Administrator\Service\Html\AdministratorService;
use Psr\Container\ContainerInterface;  // TODO find a way to solve this eclipse error

/**
 * Component class for com_wsacarousel
 *
 * @since  1.0.1  (Joomla 4.0.0)
 */
class WsacarouselComponent extends MVCComponent implements BootableExtensionInterface,  RouterServiceInterface
{
	use HTMLRegistryAwareTrait;
	use RouterServiceTrait;
	
	/**
	 * Booting the extension. This is the function to set up the environment of the extension like
	 * registering new class loaders, etc.
	 *
	 * If required, some initial set up can be done from services of the container, eg.
	 * registering HTML services.
	 *
	 * @param   ContainerInterface  $container  The container
	 *
	 * @return  void
	 *
	 * @since   4.0.0
	 */
	public function boot(ContainerInterface $container)
	{
	  //  $this->getRegistry()->register('wsacarouseladministrator', new AdministratorService);
	}

}
