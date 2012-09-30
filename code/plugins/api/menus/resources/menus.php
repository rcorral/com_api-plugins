<?php
/**
 * @package	API
 * @version 0.2
 * @author 	Rafael Corral
 * @link 	http://jommobile.com
 * @copyright Copyright (C) 2012 Rafael Corral. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.plugin.plugin');

class MenusAPIResourceMenus extends APIResource
{
	public function get()
	{
		require_once JPATH_ADMINISTRATOR.'/components/com_menus/models/menus.php';
		require_once JPATH_PLUGINS.'/api/menus/resources/helper.php';

		$model = APIodel::getInstance('APIHelperModel', 'MenusModel');
		$model->_setCache('getstart', $model->getState('list.start'));
		$menus = $model->getItems();

		if ( false === $menus || ( empty( $menus ) && $model->getError() ) ) {
			$response = $this->getErrorResponse( 400, $model->getError() );
		} else {
			$response = $menus;
		}

		$this->plugin->setResponse( $response );
	}

	public function post()
	{
		$this->plugin->setResponse( 'here is a post request' );
	}
}
