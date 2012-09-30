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

class CoreAPIResourceContentLanguage extends APIResource
{
	public function get()
	{
		require_once JPATH_ROOT . '/libraries/joomla/html/html/contentlanguage.php';

		$languages = JHtmlContentLanguage::existing( true, true );

		$this->plugin->setResponse( $languages );
	}

	public function post()
	{
		$this->plugin->setResponse( 'here is a post request' );
	}
}
