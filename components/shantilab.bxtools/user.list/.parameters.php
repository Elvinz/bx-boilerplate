<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */
$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"USER_MAX" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("T_IBLOCK_DESC_LIST_CONT"),
			"TYPE" => "STRING",
			"DEFAULT" => "4",
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
	),
);
?>
