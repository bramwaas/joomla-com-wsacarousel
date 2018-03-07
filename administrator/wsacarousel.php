<?php
/**
 * @version $Id: wsacarousel.php 
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2018 A.H.C. Waasdorp, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://www.waasdorpsoekhan.nl
 * @author email contact@.waasdorpsoekhan.nl
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
use Joomla\CMS\Factory; 
use Joomla\CMS\MVC\Controller\BaseController as Controller;
use Joomla\CMS\Uri;
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

// Include dependancies
jimport('joomla.application.component.controller');

$db = Factory::getDBO();
$db->setQuery("SELECT manifest_cache FROM #__extensions WHERE element='com_wsacarousel' LIMIT 1");
$version = json_decode($db->loadResult());
$version = $version->version;

define('WSACAROUSELFOOTER', '<div style="text-align: center; margin: 10px 0;">WsaCarousel (version '.$version.'), &copy; 2017-'.Factory::getDate()->format('Y').' Copyright by <a target="_blank" href="https://www.waasdorpsoekhan.nl">www.waasdorpsoekhan.nl</a>, All Rights Reserved.<br /><a target="_blank" href="https://www.waasdorpsoekhan.nl"><img src="'.Uri::base().'components/com_wsacarousel/assets/logo.png" alt="www.waasdorpsoekhan.nl" style="margin: 20px 0 0;" /></a></div>');

$controller	= Controller::getInstance('wsacarousel');

// Perform the Request task
$controller->execute(Factory::getApplication()->input->get('task') );
$controller->redirect();

?>