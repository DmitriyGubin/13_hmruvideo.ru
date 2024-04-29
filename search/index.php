<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Поиск");
$APPLICATION->SetTitle("Поиск");
$APPLICATION->SetPageProperty("title", "Поиск");
?>

<link href="css/styles.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">

<div class="main-wraper">
	<section class="wrap history catalog">
		<h1 class="sub-title">Результаты поиска</h1>
		<div class="filter-box">
			<p class="video-nums"> Найдено <span id="num-videos">180</span> видео</p>

			<?php
				require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/inclusion/filter-box-video.php');
			?>
		</div>

		<?
			$_GET['product'] = trim($_GET['product']);

			if($GLOBALS['user_type'] == 'ALL')
			{
				$arrFilter_name=array("?NAME"=>$_GET['product']);
			}
			else
			{
				$prop_user = 'PROPERTY_'.$GLOBALS['user_type'].'_VALUE';
				$arrFilter_name=array("?NAME"=>$_GET['product'], $prop_user => 'YES');
			}

            // tags
            if (str_starts_with($_GET['product'], '#')) {
                unset($arrFilter_name['?NAME']);

                $arrFilter_name['PROPERTY_TAG.NAME'] = mb_substr(mb_strtolower($_GET['product']), 1);
            }

			// DESC  ASC
			// $sortField = "CREATED";
			// $sortOrder = "ASC";

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

			// $sortField = "TIME_VIDEO";
			// $sortOrder = "DESC";
		?>

<?php if($_GET['product'] != ''): ?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list", 
			"search_list", 
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "Y",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "SHOW_COUNTER",
					1 => "DATE_CREATE",
					2 => "CREATED_DATE",
					3 => "",
				),
				"USE_FILTER" => "Y",
				"FILTER_NAME" => "arrFilter_name",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => $_REQUEST["ID"],
				"IBLOCK_TYPE" => "catalog",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "1000",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "Y",
				"SET_META_KEYWORDS" => "Y",
				"SET_STATUS_404" => "Y",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => $sortField,
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => $sortOrder,
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"COMPONENT_TEMPLATE" => "search_list"
			),
			false
		);?>
<?php endif; ?>
	</section>

</div>

	<script type="text/javascript" src="js/main.js"></script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>