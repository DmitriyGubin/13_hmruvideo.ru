<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['TAGS'] = [];

if ($arResult['PROPERTIES']['TAG']['VALUE']) {
    $dbRes = CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => IBLOCK_TAGS_ID, 'ACTIVE' => 'Y', 'ID' => $arResult['PROPERTIES']['TAG']['VALUE']]);
    while ($arRes = $dbRes->Fetch()) {
        $arResult['TAGS'][] = $arRes['NAME'];
    }
}

// noindex
if ($arResult['PROPERTIES']['NOT_REGISTER']['VALUE'] !== 'YES') {
    $APPLICATION->SetPageProperty("robots", "noindex, nofollow");
}

$cp = $this->__component; // объект компонента
if (is_object($cp))
    $cp->SetResultCacheKeys(array('TIMESTAMP_X'));