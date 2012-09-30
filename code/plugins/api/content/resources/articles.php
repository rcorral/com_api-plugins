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

class ContentAPIResourceArticles extends APIResource
{
	public function get()
	{
		$db = JFactory::getDBO();
		$where = ' WHERE `state` != -2';

		if ( $categoryid = JRequest::getInt( 'categoryid', 0 ) ) {
			$query .= " AND `catid` = {$categoryid}";
		}
		
		$query = "SELECT * FROM #__content";

		$db->setQuery( $query );
		$articles = $db->loadObjectList();

		$this->plugin->setResponse( $articles );
	}

	public function post()
	{
		$this->plugin->setResponse( 'This is a post request.' );
	}

	public function delete( $id = null )
	{
		// Include dependencies
		jimport('joomla.application.component.controller');
		jimport('joomla.form.form');
		jimport('joomla.database.table');

		require_once JPATH_ADMINISTRATOR . '/components/com_content/controllers/articles.php';
		require_once JPATH_ADMINISTRATOR . '/components/com_content/models/article.php';
		JForm::addFormPath( JPATH_ADMINISTRATOR . '/components/com_content/models/forms/' );
		JTable::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_content/tables/' );

		// Fake parameters
		$_POST['task'] = 'trash';
		$_REQUEST['task'] = 'trash';
		$_REQUEST[JUtility::getToken()] = 1;
		$_POST[JUtility::getToken()] = 1;

		JFactory::getLanguage()->load('com_content', JPATH_ADMINISTRATOR);
		$controller = new ContentControllerArticles();
		try {
			$controller->execute('trash');
		} catch ( JException $e ) {
			$success = false;
			$controller->set('messageType', 'error');
			$controller->set('message', $e->getMessage() );
		}

		if ( $controller->getError() ) {
			$response = $this->getErrorResponse( 400, $controller->getError() );
		} elseif ( 'error' == $controller->get('messageType') ) {
			$response = $this->getErrorResponse( 400, $controller->get('message') );
		} else {
			$response = $this->getSuccessResponse( 200, $controller->get('message') );
		}

		$this->plugin->setResponse( $response );
	}
}
