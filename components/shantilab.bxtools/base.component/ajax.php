<?
define("STOP_STATISTICS", true);
define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC","Y");
define("DisableEventsCheck", true);
define("BX_SECURITY_SHOW_MESSAGE", true);

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php'); //include bitrix core

if (isset($_POST['AJAX']) && $_POST['AJAX'] == 'Y')
{
	/*
	 * Some logic
	 */

	echo CUtil::PhpToJSObject([]); //return results
	die();
}
