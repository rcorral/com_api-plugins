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

class CoreAPIResourceEditors extends APIResource
{
	public function get()
	{
		APIHelper::setSessionUser();
		$editors = self::getEditors();

		if ( JRequest::getVar( 'default', false ) ) {
			$editors = array_merge( array(
				(object) array( 'value' => '', 'text' => JText::_('JOPTION_USE_DEFAULT') ) ),
				$editors );
		}

		$this->plugin->setResponse( $editors );
	}

	public function post()
	{
		$this->plugin->setResponse( 'here is a post request' );
	}

	/**
	 * Basically a copy of the getOptions method from the editors form field
	 */	
	protected function getEditors()
	{
		// Get the database object and a new query object.
		$db		= JFactory::getDBO();
		$query	= $db->getQuery(true);

		// Build the query.
		$query->select('element AS value, name AS text');
		$query->from('#__extensions');
		$query->where('folder = '.$db->quote('editors'));
		$query->where('enabled = 1');
		$query->order('ordering, name');

		// Set the query and load the options.
		$db->setQuery($query);
		$options = $db->loadObjectList();
		$lang = JFactory::getLanguage();
		foreach ($options as $i=>$option) {
				$lang->load('plg_editors_'.$option->value, JPATH_ADMINISTRATOR, null, false, false)
			||	$lang->load('plg_editors_'.$option->value, JPATH_PLUGINS .'/editors/'.$option->value, null, false, false)
			||	$lang->load('plg_editors_'.$option->value, JPATH_ADMINISTRATOR, $lang->getDefault(), false, false)
			||	$lang->load('plg_editors_'.$option->value, JPATH_PLUGINS .'/editors/'.$option->value, $lang->getDefault(), false, false);
			$options[$i]->text = JText::_($option->text);
		}

		// Check for a database error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}

		return $options;
	}
}
