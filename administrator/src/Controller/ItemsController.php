<?php
/**
 * @version $Id: items.php 1.0.1 2022-01-03
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2018 - 2022 Waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://www.Waasdorpsoekhan.nl
 * @author email contact@Waasdorpsoekhan.nl
 * @developer Bram Waasdorp
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
namespace WaasdorpSoekhan\Component\Wsacarousel\Administrator\Controller;

// No direct access.
\defined('_JEXEC') or die;
use Joomla\CMS\MVC\Controller\AdminController;

//jimport('joomla.application.component.controlleradmin');

class ItemsController extends AdminController
{
    public function getModel($name = 'Item', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }
}