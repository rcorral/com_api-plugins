<?php
/**
 * @package	API
 * @version 0.2
 * @author 	Rafael Corral
 * @link 	http://jommobile.com
 * @copyright Copyright (C) 2012 Rafael Corral. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

defined('_JEXEC') or die();

class CategoriesModelAPIHelperModel extends CategoriesModelCategories
{
	function _setCache( $store, $value )
	{
		$store = $this->getStoreId($store);
		$this->cache[$store] = $value;
	}
}
