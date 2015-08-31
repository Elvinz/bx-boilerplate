<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc as Loc;

class BoilerPlateComponent extends CBitrixComponent
{
    /**
     * cache keys in arResult
     * @var array()
     */
    protected $cacheKeys = array();

    /**
     * add parameters from cache dependence
     * @var array
     */
    protected $cacheAddon = array();

    /**
     * pager navigation params
     * @var array
     */
    protected $navParams = array();

    /**
     * include lang files
     */
    public function onIncludeComponentLang()
    {
        $this->includeComponentLang(basename(__FILE__));
        Loc::loadMessages(__FILE__);
    }

    /**
     * prepare input params
     * @param array $arParams
     * @return array
     */
    public function onPrepareComponentParams($params)
    {
        $result = [
            'IBLOCK_TYPE' => trim($params['IBLOCK_TYPE']),
            'IBLOCK_ID' => intval($params['IBLOCK_ID']),
            'ELEMENT_ID' => intval($params['~ELEMENT_ID']),
            'ELEMENT_CODE' => trim($params['ELEMENT_CODE']),
            'SECTION_ID' => intval($params['~SECTION_ID']),
            'SECTION_CODE' => trim($params['SECTION_CODE']),
            'CACHE_TIME' => intval($params['CACHE_TIME']) > 0 ? intval($params['CACHE_TIME']) : 3600,
            'SECTION_URL' => trim($params["SECTION_URL"]),
            'DETAIL_URL' => trim($params["DETAIL_URL"]),

            'SHOW_NAV' => ($params['SHOW_NAV'] == 'Y' ? 'Y' : 'N'),
            'COUNT' => intval($params['COUNT']),
            'SORT_FIELD1' => strlen($params['SORT_FIELD1']) ? $params['SORT_FIELD1'] : 'ID',
            'SORT_DIRECTION1' => $params['SORT_DIRECTION1'] == 'ASC' ? 'ASC' : 'DESC',
            'SORT_FIELD2' => strlen($params['SORT_FIELD2']) ? $params['SORT_FIELD2'] : 'ID',
            'SORT_DIRECTION2' => $params['SORT_DIRECTION2'] == 'ASC' ? 'ASC' : 'DESC',
        ];

        return $result;
    }

    /**
     * read data from cache or not
     * @return bool
     */
    protected function readDataFromCache()
    {
        if ($this->arParams['CACHE_TYPE'] == 'N') // no cache
            return false;

        return !($this->StartResultCache(false, $this->cacheAddon));
    }

    /**
     * cache arResult keys
     */
    protected function putDataToCache()
    {
        if (is_array($this->cacheKeys) && sizeof($this->cacheKeys) > 0)
        {
            $this->SetResultCacheKeys($this->cacheKeys);
        }
    }

    /**
     * abort cache process
     */
    protected function abortDataCache()
    {
        $this -> AbortResultCache();
    }

    /**
     * check needed modules
     * @throws LoaderException
     */
    protected function checkModules()
    {
        if (!Main\Loader::includeModule('iblock'))
            throw new Main\LoaderException(Loc::getMessage('STANDARD_ELEMENTS_LIST_CLASS_IBLOCK_MODULE_NOT_INSTALLED'));
    }

    /**
     * check required input params
     * @throws SystemException
     */
    protected function checkParams()
    {
        if ($this->arParams['IBLOCK_ID'] <= 0)
            throw new Main\ArgumentNullException('IBLOCK_ID');

        //404
        if($this->arParams["ELEMENT_ID"] > 0 && $this->arParams["ELEMENT_ID"]."" != $this->arParams["~ELEMENT_ID"])
        {
            \Bitrix\Iblock\Component\Tools::process404(
                trim("404 Message") ?: GetMessage("CATALOG_ELEMENT_NOT_FOUND")
                ,true
                ,$this->arParams["SET_STATUS_404"] === "Y"
                ,$this->arParams["SHOW_404"] === "Y"
                ,$this->arParams["FILE_404"]
            );

            return;
        }

    }

    /**
     * some actions before cache
     */
    protected function executeProlog()
    {
        if ($this->arParams['COUNT'] > 0)
        {
            if ($this->arParams['SHOW_NAV'] == 'Y')
            {
                \CPageOption::SetOptionString('main', 'nav_page_in_session', 'N');
                $this->navParams = array(
                    'nPageSize' => $this->arParams['COUNT']
                );
                $arNavigation = \CDBResult::GetNavParams($this->navParams);
                $this->cacheAddon = array($arNavigation);
            }
            else
            {
                $this->navParams = array(
                    'nTopCount' => $this->arParams['COUNT']
                );
            }
        }
    }

    /**
     * get component results
     */
    protected function getResult()
    {
        $filter = [
            'IBLOCK_TYPE' => $this->arParams['IBLOCK_TYPE'],
            'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
            'ACTIVE' => 'Y'
        ];
        $sort = [
            $this->arParams['SORT_FIELD1'] => $this->arParams['SORT_DIRECTION1'],
            $this->arParams['SORT_FIELD2'] => $this->arParams['SORT_DIRECTION2']
        ];
        $select = [
            'ID',
            'NAME',
            'DETAIL_PAGE_URL',
            'PREVIEW_TEXT',
        ];
        $rsElement = \CIBlockElement::GetList($sort, $filter, false, $this -> navParams, $select);
        while ($arElement = $rsElement->GetNext())
        {
            $this->arResult['ITEMS'][] = [
                'ID' => $arElement['ID'],
                'NAME' => $arElement['NAME'],
                'DATE' => $arElement['DATE_ACTIVE_FROM'],
                'URL' => $arElement['DETAIL_PAGE_URL'],
                'TEXT' => $arElement['PREVIEW_TEXT']
            ];
        }
        if ($this -> arParams['SHOW_NAV'] == 'Y' && $this -> arParams['COUNT'] > 0)
        {
            $this->arResult['NAV_STRING'] = $rsElement->GetPageNavString('');
        }
    }

    /**
     * some actions after component work
     */
    protected function executeEpilog()
    {

    }

    /**
     * component logic
     */
    public function executeComponent()
    {
        try
        {
            $this->checkModules();
            $this->checkParams();
            $this->executeProlog();
            if (!$this->readDataFromCache())
            {
                $this->getResult();
                $this->putDataToCache();
                $this->includeComponentTemplate();
            }
            $this->executeEpilog();
        }
        catch (Exception $e)
        {
            $this->abortDataCache();
            ShowError($e->getMessage());
        }
    }
}