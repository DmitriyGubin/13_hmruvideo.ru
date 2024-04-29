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
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//debug($arResult["ITEMS"]);
?>

<section class="recommend wrap">
	<h2 class="sub-title">Рекомендуемое</h2>
	<div class="recommend-box recommend-slider">
	<?php foreach ($arResult["ITEMS"] as $arItem): ?>
	<?php $id_video = $arItem['ID'];//передаём в кнопки ?>
		<div class="recommend-slide">
			<div class="video-item">
				<a data-idvideo="<?= $id_video; ?>" class="video-box" href="<?= $arItem['DETAIL_PAGE_URL']; ?>">
					<!-- <img class="video-img" data-lazy="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt=""> -->
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

				<?php
					require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/inclusion/opts-box-video.php');
				?>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</section>




