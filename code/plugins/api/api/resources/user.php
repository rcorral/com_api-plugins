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

/**
 * Class to get the users information
 */
class APIAPIResourceUser extends APIResource
{
	public function get()
	{
		jimport( 'joomla.application.helper' );

		// Set variables to be used
		APIHelper::setSessionUser();

		$user = JFactory::getUser();

		// Response is always successfull if we gotten this far! yippy!
		$response = $this->getSuccessResponse( 200, JText::_('COM_API_SUCCESS') );
		$response->user = (object) array(
			'id' => $user->id,
			'name' => $user->name,
			'username' => $user->username,
			'email' => $user->email
			);

		$this->plugin->setResponse( $response );
	}

	public function post()
	{
		$this->plugin->setResponse( 'here is a post request' );
	}
}
