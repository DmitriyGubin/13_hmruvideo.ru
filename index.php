<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "HUALIAN MACHINERY");
$APPLICATION->SetPageProperty("description", "Видеопортал от компании Hualian Machinery. Познавательный и обучающий контент на тему пищевого и упаковочного промышленного оборудования.");
$APPLICATION->SetPageProperty("title", "HMRU Video - Видеопортал от компании Hualian Machinery");
$APPLICATION->SetTitle("HUALIAN MACHINERY");
?>

<?
	$arrFilter_reccomend=array("PROPERTY_RECOMMENDED_VALUE"=>'YES');
	$arrFilter_reccomend = $GLOBALS['video']->Make_Video_Filter_For_User($arrFilter_reccomend);   
?>

<div class="main-wraper">

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"recommended_video",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
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
		"FIELD_CODE" => array("",""),
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "arrFilter_reccomend",
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
		"PROPERTY_CODE" => array("",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>

<?php
	$Filter=Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "PROPERTY_TOP_FIVE_VALUE" => "YES");
	$Filter = $GLOBALS['video']->Make_Video_Filter_For_User($Filter);
	$top = $GLOBALS['helper']->Return_All($Filter,
		Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"),
		Array()); 
	//debug($top);
?>

<section class="top-video wrap">
	<div class="top-video-first-line">
		<h2 class="sub-title">Топ 5 видео</h2>
		<a class="all-top" href="/top_videos/">
			<svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 1L6.5 6.5L1 12" stroke="#004EA4" stroke-linecap="round"/>
			</svg>
			<span class="all-top-title">Весь топ</span>
		</a>
	</div>

	<div class="top-video-box top-video-slider">
	<?php for ($i = 0; $i <= 4; $i++): ?>
	<?php
		if(!isset($top[$i])) 
		{
			break;
		}
	?>
		<?php $id_video = $top[$i]['ID'];//передаём в кнопки ?>
		<div class="top-video-slide">
			<div class="video-item">
				<a data-idvideo="<?= $id_video; ?>" class="video-box" href="<?= $top[$i]['DETAIL_PAGE_URL']; ?>">
					<img class="video-img" src="<?=\CFile::GetPath($top[$i]['PREVIEW_PICTURE']);?>">
				</a>

				<div class="video-name-box">
					<p class="video-name">
						<?= $top[$i]['NAME']; ?>
					</p>

					<div class="video-option mark-class">
						<div class="video-option-round mark-class"></div>
						<div class="video-option-round mark-class"></div>
						<div class="video-option-round mark-class"></div>
					</div>
				</div>

				<?php
					require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/inclusion/opts-box-video.php');
				?>
			</div>
		</div>
	<?php endfor; ?>
	</div>
</section>

<?
	$arrFilter_interesting=array("PROPERTY_INERESTING_VIDEO_VALUE"=>'YES');
	$arrFilter_interesting = $GLOBALS['video']->Make_Video_Filter_For_User($arrFilter_interesting); 
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"interesting_video",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
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
		"FIELD_CODE" => array("",""),
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "arrFilter_interesting",
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
		"PROPERTY_CODE" => array("",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
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

<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH.'/js/main_page.js' ?>"></script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>