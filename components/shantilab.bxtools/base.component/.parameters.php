<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc as Loc;
Loc::loadMessages(__FILE__);

$arComponentParameters = [
	"GROUPS" => [],
	"PARAMETERS" => [
		/*"KEY" => [
			"PARENT" => "BASE",
			"NAME" => Loc::GetMessage("BASE_IBLOCK_ELEMENT_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		],*/
		"CACHE_TIME"  =>  ["DEFAULT"=>36000000],
		"CACHE_GROUPS" => [
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => Loc::GetMessage("BASE_CP_BCE_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		],
	],
];