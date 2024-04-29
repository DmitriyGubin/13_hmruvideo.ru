<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Каталог");
$APPLICATION->SetTitle("Каталог");
//debug($arParams['FILTER_NAME']);

?>
<?
// global $arrFilter;
// $arrFilter=array("SECTION_ID"=>$_SESSION['id_section']);

if(isset($_SESSION['prop_sort']) and isset($_SESSION['type_sort']))
{
	$sortField = $_SESSION['prop_sort'];
	$sortOrder = $_SESSION['type_sort'];
}
else
{
	$sortField = "ACTIVE_FROM";
	$sortOrder = "DESC";
}

//global $arrFilter; $GLOBALS['arrFilter']

if($GLOBALS['user_type'] == 'ALL')
{
	if($_GET['tag'] != '') 
	{
		$arrFilter=array("PROPERTY_TAG_VALUE"=>$_GET['tag']);
	}
}
else
{
	$prop_user = 'PROPERTY_'.$GLOBALS['user_type'].'_VALUE';
	if($_GET['tag'] != '')
	{
		$arrFilter=array("PROPERTY_TAG_VALUE"=>$_GET['tag'], $prop_user => 'YES');
	}
	else
	{
		$arrFilter=array($prop_user => 'YES');
	}
}

?>

<div class="main-wraper">
	<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"catalog_viudeo", 
	array(
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "DATE_ACTIVE_FROM",
			1 => "SHOW_COUNTER",
			2 => "DATE_CREATE",
			3 => "SECTION_ID",
			4 => "CREATED_DATE",
			5 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "YOUTUBE_REF",
			1 => "VIDEO_FILE",
			2 => "PRODUCT_PHOTO",
			3 => "RETAIL",
			4 => "DEALERS",
			5 => "MANAGERS",
			6 => "NOT_REGISTER",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "DATE_CREATE",
			2 => "CREATED_DATE",
			3 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "1000",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_FOLDER" => "/catalog/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => $sortField,
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => $sortOrder,
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "catalog_viudeo",
		"FILTER_NAME" => "arrFilter",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "TAG",
			1 => "",
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"detail" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		)
	),
	false
);?>
</div>

<!-- Подключение slick slidera -->
	<?php 
	use Bitrix\Main\Page\Asset;
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/libraries/slick/slick.css');
	Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/libraries/slick/slick-theme.css'); 
	?>
	<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH.'/libraries/slick/slick.min.js'; ?>"></script>
<!-- Подключение slick slidera -->

<script type="text/javascript" src="/catalog/js/main.js"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>