<?php
/**
* COMPONENT FILE HEADER
**/
namespace GCore\Admin\Extensions\Chronoconnectivity\Controllers;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Installer extends \GCore\Libs\GController {
	function index(){
		//apply updates
		$sql = file_get_contents(\GCore\C::ext_path('chronoconnectivity', 'admin').'sql'.DS.'install.chronoconnectivity.sql');
		
		$queries = \GCore\Libs\Database::getInstance()->split_sql($sql);
		foreach($queries as $query){
			\GCore\Libs\Database::getInstance()->exec(\GCore\Libs\Database::getInstance()->_prefixTable($query));
		}
		
		$session = \GCore\Libs\Base::getSession();
		$session->setFlash('success', l_('CC_DB_TABLES_INSTALLED'));
		$this->redirect(r_('index.php?ext=chronoconnectivity'));
	}
}
?>