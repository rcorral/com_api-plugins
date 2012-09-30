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

class CoreAPIResourceHelpsite extends APIResource
{
	public function get()
	{
		APIHelper::setSessionUser();
		$sites = self::getSites();

		if ( JRequest::getVar( 'default', false ) ) {
			$sites = array_merge( array(
				(object) array( 'value' => '', 'text' => JText::_('JOPTION_USE_DEFAULT') ) ),
				$sites );
		}

		$this->plugin->setResponse( $sites );
	}

	public function post()
	{
		$this->plugin->setResponse( 'here is a post request' );
	}

	/**
	 * Basically a copy of the getOptions method from the helpsite form field
	 */	
	protected function getSites()
	{
		jimport('joomla.language.help');

		// Merge any additional options in the XML definition.
		$options = JHelp::createSiteList( JPATH_ADMINISTRATOR . '/help/helpsites.xml' );

		return $options;
	}
}
