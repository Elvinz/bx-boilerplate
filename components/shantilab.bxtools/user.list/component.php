<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

if($this->StartResultCache(false))
{
	$filter = Array
	(
		"ACTIVE"              => "Y",
		"GROUPS_ID"           => Array(5)
	);
	$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter); // выбираем пользователей
	while($arUser = $rsUsers->fetch()){
		if ($arUser["PERSONAL_PHOTO"]){
			$arUser["PERSONAL_PHOTO"] = CFile::GetFileArray($arUser["PERSONAL_PHOTO"]);
		}
		$arResult["ITEMS"][] = $arUser;
	}

	$this->SetResultCacheKeys(array(
		"ITEMS"
	));

	if (!$arResult["ITEMS"]){
		$this->abortResultCache();
		return;
	}

	$this->IncludeComponentTemplate();
}

?>