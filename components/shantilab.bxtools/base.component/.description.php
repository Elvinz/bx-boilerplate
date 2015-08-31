<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("BASE_COMPONENT_NAME"), //component name lang
	"DESCRIPTION" => GetMessage("BASE_COMPONENT_DESCRIPTION"), //component description lang
	"ICON" => "", // component image path like "/images/cat_detail.gif"
	"CACHE_PATH" => "Y", // button for clear cache
	"SORT" => 10,
	"PATH" => array(
		"ID" => "shantilab", //main group name
		"NAME" => GetMessage("BASE_COMPONENT_MAIN_GROUP_NAME"), //main group name
		"CHILD" => array(
			"ID" => "bxtools", //subgroup ID
			"NAME" => GetMessage("BASE_COMPONENT_SUBGROUP_NAME"), //subgroup name
			"SORT" => 10
		),
	),
);

?>