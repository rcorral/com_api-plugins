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

class CoreAPIResourceJHtml extends APIResource
{
	public function get()
	{
		$type = JRequest::getVar( 'type' );

		$this->plugin->setResponse( JHtml::_($type) );
	}

	public function post()
	{
		$this->plugin->setResponse( 'here is a post request' );
	}
}
