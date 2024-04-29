<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Смотреть позже");
//debug($later_ids);
?>
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/media.css" rel="stylesheet">

<?php
	$later_ids = $GLOBALS['video'] -> Return_Id_Videos_Yes_No_Auth('watch_later', 'UF_WATCH_LATER');
	$later_ids = array_unique($later_ids);

	//debug($later_ids);

	$bool = (count($later_ids) != 0);
	if($bool)
	{
		$videos = $GLOBALS['helper']->Return_All(
				Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "ID" => $later_ids),
				Array(),
				Array());
		//debug($videos);
	}

	/**Изменяем последовательность видео в соответствии с историей кликов***/
	$videos = $GLOBALS['video'] -> Change_Sequence($videos,$later_ids);
	/**Изменяем последовательность видео в соответствии с историей кликов***/
?>

<div class="main-wraper">
	<section class="wrap history <?= $bool? null : 'hide'; ?>">
		<div class="title-line">
			<h1 class="sub-title">Смотреть позже</h1>
			<div class="clear-history desctop mark-class">
				<svg class="mark-class" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L11 11" stroke="#004EA4" stroke-linecap="round"/>
					<path d="M1 11L11 1" stroke="#004EA4" stroke-linecap="round"/>
				</svg>

				<span class="mark-class">Очистить список</span>

				<div class="check-clear-box hide mark-class">
					<p class="quest mark-class">Очистить список видеозаписей для будущего просмотра?</p>

					<div class="button-line-check mark-class">
						<button id="check-clear-hist-no" class="buttons">Оставить</button>
						<button class="buttons check-clear-hist-yes">Все верно</button>
					</div>
				</div>
			</div>
		</div>

		<div class="time-mark">
				<span>
					<span id="num-items-video"><?= count($later_ids); ?></span> 
					добавленных видео
				</span>
				<div class="clear-history mobile mark-class" style="display: none;">
					<svg class="mark-class" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L11 11" stroke="#004EA4" stroke-linecap="round"/>
						<path d="M1 11L11 1" stroke="#004EA4" stroke-linecap="round"/>
					</svg>

					<span class="mark-class">Очистить</span>

					<div class="check-clear-box hide mark-class">
						<p class="quest mark-class">Очистить список видеозаписей для будущего просмотра?</p>

						<div class="button-line-check mark-class">
							<button id="check-clear-hist-no" class="buttons">Оставить</button>
							<button class="buttons check-clear-hist-yes">Все верно</button>
						</div>
					</div>
				</div>
		</div>

		<div class="histiory-box">
		<?php foreach ($videos as $video_item): ?>
		<?php $id_video = $video_item['ID']; ?>
			<div class="histiory-box-item">
				<div class="video-item">
					<svg class="list-symbol" width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M4.5 14.5H19.5M19.5 0.5H4.5M0.5 7.5H19.5" stroke="#595959" stroke-linecap="round"/>
					</svg>

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

						<?php $id_video = $video_item['ID']; ?>
						<div class="button-line">
							<button class="remoove-history" data-idvideo="<?=$id_video;?>">
								<svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 1.5L1 14.5M14.0001 14.5001L1.0001 1.50007" stroke="#004EA4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								<span>Удалить</span>
							</button>

							<?php 
								$ref = 'https://'.$_SERVER['HTTP_HOST'].$video_item['DETAIL_PAGE_URL'];
							?>

							<button data-ref="<?= $ref; ?>" data-fancybox="" data-src="#share-popup" href="javascript:;" class="share-video">
								<svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.33301 18H0.533008C0.533008 18.3323 0.738463 18.63 1.04917 18.748C1.35987 18.8659 1.71112 18.7794 1.9316 18.5307L1.33301 18ZM12.853 12.9474H13.653V12.1474H12.853V12.9474ZM12.853 17.1579H12.053V18.7316L13.3244 17.8042L12.853 17.1579ZM22.6663 10L23.1378 10.6463L23.9756 10.0352L23.1718 9.37993L22.6663 10ZM12.853 2L13.3585 1.37993L12.053 0.315677V2H12.853ZM12.853 6.21053L12.9357 7.00624L13.653 6.93173V6.21053H12.853ZM1.9316 18.5307C3.38063 16.8965 4.78911 15.7167 6.46996 14.9361C8.15055 14.1556 10.1618 13.7474 12.853 13.7474V12.1474C9.99752 12.1474 7.74213 12.5812 5.79605 13.485C3.85023 14.3886 2.27205 15.7351 0.73442 17.4693L1.9316 18.5307ZM12.053 12.9474V17.1579H13.653V12.9474H12.053ZM13.3244 17.8042L23.1378 10.6463L22.1949 9.35367L12.3816 16.5116L13.3244 17.8042ZM23.1718 9.37993L13.3585 1.37993L12.3475 2.62007L22.1609 10.6201L23.1718 9.37993ZM12.053 2V6.21053H13.653V2H12.053ZM12.7704 5.41481C8.59967 5.84805 5.51011 7.16108 3.46816 9.34888C1.42183 11.5414 0.533008 14.4991 0.533008 18H2.13301C2.13301 14.764 2.95085 12.2481 4.63785 10.4406C6.32924 8.6284 8.99968 7.41511 12.9357 7.00624L12.7704 5.41481Z" fill="#004EA4"></path>
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
								<span class="option-title hide"></span>
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
			</div>
		<?php endforeach; ?>
		</div>
	</section>

	<section class="wrap no-tems <?= $bool? 'hide' : null; ?>">
		<div>
			<svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M49.5775 17.6667C50.4987 20.2732 51 23.078 51 26C51 39.8071 39.8071 51 26 51C12.1929 51 1 39.8071 1 26C1 12.1929 12.1929 1 26 1C29.5583 1 32.9429 1.74339 36.0071 3.08333" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round"/>
				<path d="M26 37.3638V24.1812C26 23.8929 26.1245 23.6185 26.3415 23.4286L44.1818 7.81836" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round"/>
				<path d="M10 20L16 14L22 20L28 14" stroke="#3D3D3D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>

			<p class="no-tems-title">Видео не добавлены в список</p>
			<a href="/" class="go-to-main">На главную</a>
		</div>
	</section>
</div>

	<script src="<?= SITE_TEMPLATE_PATH.'/libraries/order.js'; ?>" type="text/javascript"></script>
	<script src="js/main.js" type="text/javascript"></script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>