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
/** @var CBitrixComponent $component <?foreach($arResult["ITEMS"] as $arItem):?>*/
$this->setFrameMode(true);

//debug($_SERVER['REQUEST_URI']);

//debug($arResult["ITEMS"]);

$sec_id = $arResult['SECTION']['PATH'][0]['ID'];
$sec_name = $arResult['SECTION']['PATH'][0]['NAME'];
$sec_url = $arResult['SECTION']['PATH'][0]['SECTION_PAGE_URL'];

$sub_sects = $GLOBALS['video'] -> Sections_For_Type_User($sec_id);

//debug($sub_sects);
?>

<a class="hide" id="set-sort" href="<?= $_SERVER['REQUEST_URI']; ?>">Set_Sort</a>

<?php 
	$cur_url = $APPLICATION->GetCurPage();
	$bool_tag = isset($_GET['tag']);
?>
	<section class="catalog wrap">
	<?php
		if($bool_tag)
		{
			$sec_name = $_GET['tag'];
		}
	?>
		<h1 class="sub-title"><?= $sec_name; ?></h1>
		<div class="filter-box">
			<div class="catigory catigory-mobile-slider">
				<div class="mobile-slide <?= $bool_tag? 'hide':null; ?>">
					<!-- Не удалять этот тег -->
					<a id="all-catalog" href="<?= $sec_url; ?>" class="catigory-item <?= ($cur_url==$sec_url)?'active':null; ?>">
						Все 
					</a>
				</div>
			<?php foreach ($sub_sects as $sec_item): ?>
			<?php $sec_url = $sec_item['SECTION_PAGE_URL']; ?>
				<div class="mobile-slide <?= $bool_tag? 'hide':null; ?>">
					<a href="<?= $sec_url; ?>" class="catigory-item <?= ($cur_url==$sec_url)?'active':null; ?>" data-idsection="<?= $sec_item['ID']; ?>">
						<?= $sec_item['NAME']; ?>
					</a>
				</div>
			<?php endforeach; ?>
			</div>

			<?php
				require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/inclusion/filter-box-video.php');
			?>
		</div>

		<div class="catalog-box">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?php $id_video = $arItem['ID'];//передаём в кнопки ?>
			<div class="video-item">
			<?php 
				$ref = 'http://'.$_SERVER['HTTP_HOST'].$arItem['DETAIL_PAGE_URL'];
			?>
				<a data-idvideo="<?= $id_video; ?>" class="video-box" href="<?= $ref; ?>">
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
	</section>

<?php /* 
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
*/?>
