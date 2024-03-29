<?php
/**
 * @package     WsaCarousel
 * @subpackage  com_wsacarousel
 *
 * @copyright Copyright (C) 2018 - 2022 Waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: https://Waasdorpsoekhan.nl
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
 * */
namespace WaasdorpSoekhan\Component\Wsacarousel\Administrator\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Session\Session;


/**
 * The Tag Controller
 *
 * @since  3.1
 */
class ItemController extends FormController
{
    /**
     * Method to check if you can add a new record.
     *
     * @param   array  $data  An array of input data.
     *
     * @return  boolean
     *
     * @since   3.1
     */
    protected function allowAdd($data = array())
    {
        return $this->app->getIdentity()->authorise('core.create', 'com_wsacarousel');
    }
    
    /**
     * Method to check if you can edit a record.
     *
     * @param   array   $data  An array of input data.
     * @param   string  $key   The name of the key for the primary key.
     *
     * @return  boolean
     *
     * @since   3.1
     */
    protected function allowEdit($data = array(), $key = 'id')
    {
        // Since there is no asset tracking and no categories, revert to the component permissions.
        return parent::allowEdit($data, $key);
    }
    
    /**
     * Method to run batch operations.
     *
     * @param   object  $model  The model.
     *
     * @return  boolean	 True if successful, false otherwise and internal error is set.
     *
     * @since   3.1
     */
    public function batch($model = null)
    {
        Session::checkToken() or jexit(Text::_('JINVALID_TOKEN'));
        
        // Set the model
        $model = $this->getModel('Item');
        
        // Preset the redirect
        $this->setRedirect('index.php?option=com_wsacarousel&view=item');
        
        return parent::batch($model);
    }
}
