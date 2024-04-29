<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мое избранное");



//debug($_SESSION['my_favorites']);

?>
<link href="css/styles.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">

<?php

	$fav_ids = $GLOBALS['video'] -> Return_Id_Videos_Yes_No_Auth('my_favorites', 'UF_FAVORITES');
	$fav_ids = array_unique($fav_ids);

	$bool = (count($fav_ids) != 0);
	if($bool)
	{
		$videos = $GLOBALS['helper']->Return_All(
				Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "ID" => $fav_ids),
				Array(),
				Array());
		//debug($videos);
	}

	/**Изменяем последовательность видео в соответствии с историей кликов***/
	$videos = $GLOBALS['video'] -> Change_Sequence($videos,$fav_ids);
	/**Изменяем последовательность видео в соответствии с историей кликов***/
?>

<div class="main-wraper">
	<section class="wrap history <?= $bool? null : 'hide'; ?>">
		<div class="title-line">
			<h1 class="sub-title">Избранное</h1>
			<div class="clear-history desctop mark-class">
				<svg class="mark-class" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L11 11" stroke="#004EA4" stroke-linecap="round"/>
					<path d="M1 11L11 1" stroke="#004EA4" stroke-linecap="round"/>
				</svg>

				<span class="mark-class">Очистить избранное</span>

				<div class="check-clear-box hide mark-class">
					<p class="quest mark-class">Очистить все добавленные в избранное видеозаписи?</p>

					<div class="button-line-check mark-class">
						<button id="check-clear-hist-no" class="buttons">Оставить</button>
						<button class="buttons check-clear-hist-yes">Все верно</button>
					</div>
				</div>
			</div>
		</div>
		<div class="histiory-box">
			<div class="time-mark">
				<span>
					<span id="num-items-video"><?= count($fav_ids); ?></span>
					избранных видео
				</span>
				<div class="clear-history mobile mark-class" style="display: none;">
					<svg class="mark-class" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L11 11" stroke="#004EA4" stroke-linecap="round"/>
						<path d="M1 11L11 1" stroke="#004EA4" stroke-linecap="round"/>
					</svg>

					<span class="mark-class">Очистить</span>

					<div class="check-clear-box hide mark-class">
						<p class="quest mark-class">Очистить все добавленные в избранное видеозаписи?</p>

						<div class="button-line-check mark-class">
							<button id="check-clear-hist-no" class="buttons">Оставить</button>
							<button class="buttons check-clear-hist-yes">Все верно</button>
						</div>
					</div>
				</div>
			</div>
		<?php foreach ($videos as $video_item): ?>
		<?php $id_video = $video_item['ID']; ?>
			<div class="video-item">
				<a data-idvideo="<?= $id_video; ?>" class="video-box" href="<?= $video_item['DETAIL_PAGE_URL']; ?>">
					<img class="video-img" src="<?=\CFile::GetPath($video_item['PREVIEW_PICTURE']);?>">
				</a>

				<div class="text-box">
					<div class="video-name-box">
						<p class="video-name">
							<?= $video_item['NAME']; ?>
						</p>

						<!-- <div class="video-option">
							<div class="video-option-round"></div>
							<div class="video-option-round"></div>
							<div class="video-option-round"></div>
						</div> -->
					</div>

					<div class="views-date">
						<span>
							<?php $countt = $video_item['SHOW_COUNTER']; ?>
							<span><?= $countt ?></span>
							<?= 'просмотр'.$GLOBALS['helper']->Return_Ending($countt,'','a','ов'); ?>
						</span>
						<svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="2" cy="2" r="2" fill="#7F8692"></circle>
						</svg>
						<span>
							<?= $GLOBALS['helper']->Date_Converter($video_item['CREATED_DATE']); ?>
						</span>
					</div>

					<div class="about-video">
						<?= $GLOBALS['helper']->Сut_Text($video_item['~DETAIL_TEXT'], 164); ?>
					</div>

					<div class="button-line">
						<button class="remoove-history" data-idvideo="<?=$id_video;?>">
							<svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M15 18.3963L15 2C15 1.44772 14.5523 1 14 1L2 0.999999C1.44772 0.999999 1 1.44772 1 2L1 18.4176C1 18.6615 1.27559 18.8035 1.47418 18.6619L8.21212 13.8571L14.5188 18.6354C14.7164 18.7851 15 18.6442 15 18.3963Z" stroke="#004EA4" stroke-width="1.5" stroke-linecap="round"/>
								<path d="M1 13.5L15 4.5" stroke="#004EA4" stroke-width="1.6"/>
							</svg>

							<span>Удалить из избранного</span>
						</button>

						<?php 
							$ref = 'https://'.$_SERVER['HTTP_HOST'].$video_item['DETAIL_PAGE_URL'];
						?>

						<button data-ref="<?= $ref; ?>" data-fancybox="" data-src="#share-popup" href="javascript:;" class="share-video" >
							<svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.33301 18H0.533008C0.533008 18.3323 0.738463 18.63 1.04917 18.748C1.35987 18.8659 1.71112 18.7794 1.9316 18.5307L1.33301 18ZM12.853 12.9474H13.653V12.1474H12.853V12.9474ZM12.853 17.1579H12.053V18.7316L13.3244 17.8042L12.853 17.1579ZM22.6663 10L23.1378 10.6463L23.9756 10.0352L23.1718 9.37993L22.6663 10ZM12.853 2L13.3585 1.37993L12.053 0.315677V2H12.853ZM12.853 6.21053L12.9357 7.00624L13.653 6.93173V6.21053H12.853ZM1.9316 18.5307C3.38063 16.8965 4.78911 15.7167 6.46996 14.9361C8.15055 14.1556 10.1618 13.7474 12.853 13.7474V12.1474C9.99752 12.1474 7.74213 12.5812 5.79605 13.485C3.85023 14.3886 2.27205 15.7351 0.73442 17.4693L1.9316 18.5307ZM12.053 12.9474V17.1579H13.653V12.9474H12.053ZM13.3244 17.8042L23.1378 10.6463L22.1949 9.35367L12.3816 16.5116L13.3244 17.8042ZM23.1718 9.37993L13.3585 1.37993L12.3475 2.62007L22.1609 10.6201L23.1718 9.37993ZM12.053 2V6.21053H13.653V2H12.053ZM12.7704 5.41481C8.59967 5.84805 5.51011 7.16108 3.46816 9.34888C1.42183 11.5414 0.533008 14.4991 0.533008 18H2.13301C2.13301 14.764 2.95085 12.2481 4.63785 10.4406C6.32924 8.6284 8.99968 7.41511 12.9357 7.00624L12.7704 5.41481Z" fill="#004EA4"/>
							</svg>

							<span>Поделиться</span>
						</button>
					</div>
				</div>

				<!-- <div class="opts-box-video">
					<div class="option-item">
						<svg class="opt-box-svg" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M22.3741 8.33333C22.7794 9.48019 23 10.7143 23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C13.5656 1 15.0549 1.32709 16.4031 1.91667" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round"/>
							<path d="M12 17V11.4538C12 11.1654 12.1245 10.8911 12.3415 10.7012L20 4" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round"/>
						</svg>

						<p class="option-title">Смотреть позже</p>
					</div>

					<div class="option-item">
						<svg class="opt-box-svg" width="19" height="23" viewBox="0 0 19 23" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M18 21.4L18 2C18 1.44772 17.5523 1 17 1L2.5 0.999999C1.94772 0.999999 1.5 1.44771 1.5 2L1.5 21.421C1.5 21.6643 1.77428 21.8064 1.973 21.6661L10 16L17.52 21.64C17.7178 21.7883 18 21.6472 18 21.4Z" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round"/>
						</svg>

						<p class="option-title">В избранное</p>
					</div>
				</div> -->
			</div>
		<?php endforeach; ?>
		</div>
	</section>

	<section class="wrap no-tems <?= $bool? 'hide' : null; ?>">
		<div>
			<svg width="51" height="59" viewBox="0 0 51 59" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M33 7.99999L1 8L0.999996 58L22.5 45.9227L44 58L44 19" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M12.5 35.5003C19.1531 32.124 26.5135 32.2095 33.5 35.5005" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round"/>
				<path d="M11 24L14.5 20.5L18 24" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M28 24L31.5 20.5L35 24" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M36.9997 3.82853L40.5351 7.36406L36.9997 10.8994" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M49.7277 10.8994L46.1924 7.36388L49.7277 3.82852" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M39.8284 0.999795L43.364 4.53516L46.8993 0.999795" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M46.8991 13.7277L43.3636 10.1924L39.8282 13.7277" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			<p class="no-tems-title">Избранное не добавлено</p>
			<a href="/" class="go-to-main">На главную</a>
		</div>
	</section>
</div>

	<script src="js/main.js" type="text/javascript"></script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>