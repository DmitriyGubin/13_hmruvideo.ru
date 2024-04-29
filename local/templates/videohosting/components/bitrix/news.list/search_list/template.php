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
/** @var CBitrixComponent $component $arResult["ITEMS"]   */
$this->setFrameMode(true);

//debug($arResult["ITEMS"]);
?>
 
<a class="hide" id="set-sort" href="<?= $_SERVER['REQUEST_URI']; ?>">Set_Sort</a>

<div class="histiory-box">
<?php foreach ($arResult["ITEMS"] as $arItem): ?>
	<?php 
		$id_video = $arItem['ID'];
		$ref = 'http://'.$_SERVER['HTTP_HOST'].$arItem['DETAIL_PAGE_URL'];
	?>
	<div class="video-item">
		<a data-idvideo="<?=$id_video;?>" class="video-box" href="<?= $ref; ?>">
			<img class="video-img" src="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>">
		</a>

		<div class="text-box">
			<div class="video-name-box">
				<p class="video-name">
					<?= $arItem['NAME']; ?>
				</p>
			</div>

			<div class="views-date">
				<span>
					<?php $countt = $arItem['SHOW_COUNTER']; ?>
					<span><?= $countt ?></span>
					<?= 'просмотр'.$GLOBALS['helper']->Return_Ending($countt,'','a','ов'); ?>
				</span>
				<svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="2" cy="2" r="2" fill="#7F8692"></circle>
				</svg>
				<span>
					<?= $GLOBALS['helper']->Date_Converter($arItem['CREATED_DATE']); ?>
				</span>
			</div>

			<div class="about-video">
				<?= $GLOBALS['helper']->Сut_Text($arItem['~DETAIL_TEXT'], 164); ?>
			</div>

			<div class="button-line">

				<?php
				$later_ids = $GLOBALS['video'] -> Return_Id_Videos_Yes_No_Auth('watch_later', 'UF_WATCH_LATER');

				$bool_later = in_array($id_video, $later_ids);
				?>

				<button class="watch-later <?= $bool_later? 'hide' : null; ?>" data-idvideo="<?=$id_video;?>">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.4879 7C18.8195 7.93834 19 8.94809 19 10C19 14.9706 14.9706 19 10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C11.281 1 12.4995 1.26762 13.6026 1.75" stroke="#004EA4" stroke-width="1.5" stroke-linecap="round"/>
						<path d="M10 14.091V9.63563C10 9.34727 10.1245 9.07294 10.3415 8.88305L16.5455 3.45459" stroke="#004EA4" stroke-width="1.5" stroke-linecap="round"/>
					</svg>
					<span>Смотреть позже</span>
				</button>

				<?php 
					$ref = 'https://'.$_SERVER['HTTP_HOST'].$arItem['DETAIL_PAGE_URL'];
				?>

				<button data-ref="<?= $ref; ?>" data-fancybox="" data-src="#share-popup" href="javascript:;" class="share-video">
					<svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1.33301 18H0.533008C0.533008 18.3323 0.738463 18.63 1.04917 18.748C1.35987 18.8659 1.71112 18.7794 1.9316 18.5307L1.33301 18ZM12.853 12.9474H13.653V12.1474H12.853V12.9474ZM12.853 17.1579H12.053V18.7316L13.3244 17.8042L12.853 17.1579ZM22.6663 10L23.1378 10.6463L23.9756 10.0352L23.1718 9.37993L22.6663 10ZM12.853 2L13.3585 1.37993L12.053 0.315677V2H12.853ZM12.853 6.21053L12.9357 7.00624L13.653 6.93173V6.21053H12.853ZM1.9316 18.5307C3.38063 16.8965 4.78911 15.7167 6.46996 14.9361C8.15055 14.1556 10.1618 13.7474 12.853 13.7474V12.1474C9.99752 12.1474 7.74213 12.5812 5.79605 13.485C3.85023 14.3886 2.27205 15.7351 0.73442 17.4693L1.9316 18.5307ZM12.053 12.9474V17.1579H13.653V12.9474H12.053ZM13.3244 17.8042L23.1378 10.6463L22.1949 9.35367L12.3816 16.5116L13.3244 17.8042ZM23.1718 9.37993L13.3585 1.37993L12.3475 2.62007L22.1609 10.6201L23.1718 9.37993ZM12.053 2V6.21053H13.653V2H12.053ZM12.7704 5.41481C8.59967 5.84805 5.51011 7.16108 3.46816 9.34888C1.42183 11.5414 0.533008 14.4991 0.533008 18H2.13301C2.13301 14.764 2.95085 12.2481 4.63785 10.4406C6.32924 8.6284 8.99968 7.41511 12.9357 7.00624L12.7704 5.41481Z" fill="#004EA4"/>
					</svg>

					<span>Поделиться</span>
				</button>

				<?php
				$fav_ids = $GLOBALS['video'] -> Return_Id_Videos_Yes_No_Auth('my_favorites', 'UF_FAVORITES');

				$bool_fav = in_array($id_video, $fav_ids);
				?>

				<button class="favorites" data-idvideo="<?=$id_video;?>">
					<svg class="<?= $bool_fav?'active':null; ?>" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15 18.3963L15 2C15 1.44772 14.5523 1 14 1L2 0.999999C1.44772 0.999999 1 1.44772 1 2L1 18.4176C1 18.6615 1.27559 18.8035 1.47418 18.6619L8.21212 13.8571L14.5188 18.6354C14.7164 18.7851 15 18.6442 15 18.3963Z" stroke="#004EA4" stroke-width="1.5" stroke-linecap="round"/>
					</svg>
					<p class="option-title hide"></p>
				</button>
			</div>
		</div>
	</div>
<?php endforeach; ?>
</div>

<?php /* 
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
*/?>

