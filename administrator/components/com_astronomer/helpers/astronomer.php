<?php

/**
 * @version    CVS: 1.0.6
 * @package    Com_Astronomer
 * @author     Troy "Bear" Hall <webmaster@arksky.org>
 * @copyright  2016 Troy Hall & Arkansas Sky Observatory
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Astronomer helper.
 *
 * @since  1.6
 */
class AstronomerHelpersAstronomer
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  string
	 *
	 * @return void
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_ASTRONOMER_TITLE_OBSERVATIONS'),
			'index.php?option=com_astronomer&view=observations',
			$vName == 'observations'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return    JObject
	 *
	 * @since    1.6
	 */
	public static function getActions()
	{
		$user   = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_astronomer';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}


class AstronomerHelper extends AstronomerHelpersAstronomer
{

}
