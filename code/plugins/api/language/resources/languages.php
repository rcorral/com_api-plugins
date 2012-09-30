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

class LanguageAPIResourceLanguages extends APIResource
{
	public function get()
	{
		jimport( 'joomla.language.helper' );

		$client = JRequest::getCmd( 'client', 'site' );

		$languages = JLanguageHelper::createLanguageList(
			'', constant( 'JPATH_' . strtoupper( $client ) ), true, true );

		if ( JRequest::getVar( 'default', false ) ) {
			array_unshift( $languages,
				JHtml::_('select.option', 0, JText::_('JOPTION_USE_DEFAULT')) );
		}

		$this->plugin->setResponse( $languages );
	}

	public function post()
	{
		$this->plugin->setResponse( 'here is a post request' );
	}
}
