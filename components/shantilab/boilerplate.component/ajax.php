<?
define('NO_AGENT_CHECK', true); // disable agents
define("STOP_STATISTICS", true); // disable statistic

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php'); //include bitrix core

if (isset($_POST['AJAX']) && $_POST['AJAX'] == 'Y')
{
	/*
	 * Some logic
	 */

	echo CUtil::PhpToJSObject([]); //return results
	die();
}