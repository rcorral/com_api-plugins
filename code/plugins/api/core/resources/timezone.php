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

class CoreAPIResourceTimezone extends APIResource
{
	public function get()
	{
		APIHelper::setSessionUser();

		$options = array();
		if ( JRequest::getVar( 'default', false ) ) {
			$options = array(
				(object) array( 'value' => '', 'text' => JText::_('JOPTION_USE_DEFAULT') ) );
		}

		$sites = APIHelper::getField( 'timezone', array(
			'name' => JRequest::getVar('field_name', ''),
			'id' => JRequest::getVar('field_id', ''),
			'_options' => $options
			));

		$this->plugin->setResponse( array( 'html' => $sites->input ) );
	}

	public function post()
	{
		$this->plugin->setResponse( 'here is a post request' );
	}
}
