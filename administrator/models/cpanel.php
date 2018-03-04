<?php
/**
 * @version $Id: cpanel.php 48 2017-08-04 11:41:27Z szymon $
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

defined('_JEXEC') or die;
//use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

jimport( 'joomla.application.component.model');


class WsaCarouselModelCPanel extends BaseDatabaseModel {

	function __construct()
	{
		parent::__construct();
	}
}
?>
