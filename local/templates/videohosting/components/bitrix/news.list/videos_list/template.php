<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component  $arResult["ITEMS"]*/
$this->setFrameMode(true);

//debug($arResult["ITEMS"]);
?>

<div class="catalog-box">
<?php foreach ($arResult["ITEMS"] as $arItem): ?>
	<?php $id_video = $arItem['ID'];//передаём в кнопки ?>
	<div class="video-item">
		<a data-idvideo="<?= $id_video; ?>" class="video-box" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
			<img class="video-img" src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>">
		</a>

		<div class="video-name-box">
			<p class="video-name">
				<?= $arItem['NAME']; ?>
			</p>

			<div class="video-option mark-class">
				<div class="video-option-round mark-class"></div>
				<div class="video-option-round mark-class"></div>
				<div class="video-option-round mark-class"></div>
			</div>
		</div>

		<div class="views-date">
			<span>
				<?php $countt = $arItem['SHOW_COUNTER']; ?>
				<span><?= $countt ?></span>
				<?= 'просмотр'.$GLOBALS['helper']->Return_Ending($countt,'','a','ов'); ?>
			</span>
			<svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="2" cy="2" r="2" fill="#7F8692"/>
			</svg>
			<span>
				<?= $GLOBALS['helper']->Date_Converter($arItem['CREATED_DATE']); ?>	
			</span>
		</div>

		<?php
			require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/inclusion/opts-box-video.php');
		?>
	</div>
<?php endforeach; ?>
</div>