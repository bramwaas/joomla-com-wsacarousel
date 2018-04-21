<?php
/**
 * @version $Id: edit_params.php 48 2017-08-04 11:41:27Z szymon $
 * @package WsaCarousel
 * @subpackage WsaCarousel Component
 * @copyright Copyright (C) 2017 waasdorpsoekhan.nl, All rights reserved.
 * @license http://www.gnu.org/licenses GNU/GPL
 * @author url: http://waasdorpsoekhan.nl
 * @author email contact@waasdorpsoekhan.nl
 * @developer A.h.C. Waasdorp
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

// No direct access.
defined('_JEXEC') or die;
use  Joomla\CMS\Language\Text;


$fieldSets = $this->form->getFieldsets('params');
foreach ($fieldSets as $name => $fieldSet) : ?>
	
	<fieldset class="panelform" >
		
			<!-- h3><?php echo Text::_($fieldSet->label); ?></h3 -->
			<?php if (isset($fieldSet->description) && trim($fieldSet->description)) :
				echo '<p class="tip alert alert-info">'.$this->escape(Text::_($fieldSet->description)).'</p>';
			endif; ?>
			<?php foreach ($this->form->getFieldset($name) as $field) : ?>
				<?php echo $field->renderField(); ?>
			<?php endforeach; ?>
		
	</fieldset>
<?php endforeach; ?>