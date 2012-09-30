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

class UsersAPIResourceUser extends APIResource
{
	public function get()
	{
		require_once JPATH_ADMINISTRATOR.'/components/com_users/models/user.php';

		$model = APIodel::getInstance('User', 'UsersModel');
		$user = $model->getItem( JRequest::getInt('id') );

		if ( false === $user || ( empty( $user ) && $model->getError() ) ) {
			$response = $this->getErrorResponse( 400, $model->getError() );
		} else {
			// We don't care about the password, and for security reasons, don't send
			$user->password = '';
			$response = $user;
		}

		$this->plugin->setResponse( $response );
	}

	public function post()
	{
		// Set variables to be used
		APIHelper::setSessionUser();

		JFactory::getLanguage()->load('com_users', JPATH_ADMINISTRATOR);

		// Include dependencies
		jimport('joomla.application.component.controller');
		jimport('joomla.form.form');
		jimport('joomla.database.table');

		APIodel::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_users/models' );
		JForm::addFormPath( JPATH_ADMINISTRATOR . '/components/com_users/models/forms' );
		JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_users/tables' );

		// Get user data
		$data = JRequest::getVar( 'jform', array(), 'post', 'array' );
		if ( !isset( $data['groups'] ) ) {
			$data['groups'] = array();
		}

		// Save user
		$model = APIodel::getInstance( 'User', 'UsersModel' );
		$model->getState('user.id'); // This is only here to trigger populateState()
		$success = $model->save( $data );

		if ( $model->getError() ) {
			$response = $this->getErrorResponse( 400, $model->getError() );
		} elseif ( !$success ) {
			$response = $this->getErrorResponse( 400, JText::_('COM_API_ERROR_OCURRED') );
		} else {
			$response = $this->getSuccessResponse( 201, JText::_('COM_API_SUCCESS') );
			$response->id = $model->getState('user.id');
		}

		$this->plugin->setResponse( $response );
	}

	public function put()
	{	
		// Simply call post as Joomla will just save an article with an id
		$this->post();

		$response = $this->plugin->get( 'response' );
		if ( isset( $response->success ) && $response->success ) {
			JResponse::setHeader( 'status', 200, true );
			$response->code = 200;
			$this->plugin->setResponse( $response );
		}
	}
}
