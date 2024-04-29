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
//debug($arResult);
//debug($_SERVER);

$this_sect_id = $arResult['IBLOCK_SECTION_ID'];

$sub_sects_ids = $GLOBALS['helper'] -> Id_Sections_Two_Level_Catalog($this_sect_id);
  
$filter = Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID" => $sub_sects_ids, "!ID"=>$arResult['ID']);
$filter = $GLOBALS['video']->Make_Video_Filter_For_User($filter);

$similar_video = $GLOBALS['helper'] -> Return_All($filter,
	Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "CREATED_DATE"),
	Array()
);

//debug($similar_video);

$vide_file = $arResult['PROPERTIES']['VIDEO_FILE']['VALUE'];
?>

<section class="play-video wrap">
	<div class="left-area">
	<?php if($vide_file != ''): ?>
		<div class="video-box" style="background: black;">
			<video preload="metadata" id="video-player">
				<source src="<?=\CFile::GetPath($vide_file);?>" type="video/mp4">
			</video>

				<div class="video-buts">
					<div class="play-stop">
						<svg class="stop-video hide" width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0H5V17H0V0Z" fill="white"/>
							<path d="M10 0H15V17H10V0Z" fill="white"/>
						</svg>

						<svg class="play-video-icon" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 17V0L15.5 8.5L0 17Z" fill="white"/>
						</svg>
					</div>

					<div class="time-box">
						<div class="polzunok-container-time">
							<div class="polzunok-time"></div>
						</div>
						<div class="video-time current-video-time">00:00</div>
						<div class="video-time middle">/</div>
						<div class="video-time all-video-time">00:00</div>
					</div>

					<div class="volume-box">
						<svg class="main-radio" width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8 16V0L3 4H0V12H3L8 16Z" fill="white"/>
						</svg>

						<div class="icon-volume-box">
							<svg id="no-noise" class="no-noise noise-level hide" width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M0.22166 6.70797C-0.0738866 7.00352 -0.0738866 7.4827 0.22166 7.77824C0.517206 8.07379 0.996381 8.07379 1.29193 7.77824L4.00014 5.07003L6.70846 7.77835C7.00401 8.07389 7.48318 8.07389 7.77873 7.77835C8.07428 7.4828 8.07428 7.00363 7.77873 6.70808L5.07041 3.99976L7.77873 1.29144C8.07428 0.995893 8.07428 0.516718 7.77873 0.221171C7.48318 -0.0743749 7.00401 -0.0743748 6.70846 0.221171L4.00014 2.92949L1.29193 0.221277C0.996381 -0.0742694 0.517206 -0.0742694 0.22166 0.221277C-0.0738866 0.516823 -0.0738866 0.995999 0.22166 1.29154L2.92987 3.99976L0.22166 6.70797Z" fill="white"/>
							</svg>

							<svg id="middle-noise" class="middle-noise noise-level" width="4" height="8" viewBox="0 0 4 8" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0 0.5C0.459627 0.5 0.914752 0.590531 1.33939 0.766422C1.76403 0.942314 2.14987 1.20012 2.47487 1.52513C2.79988 1.85013 3.05769 2.23597 3.23358 2.66061C3.40947 3.08525 3.5 3.54037 3.5 4C3.5 4.45963 3.40947 4.91475 3.23358 5.33939C3.05769 5.76403 2.79988 6.14987 2.47487 6.47487C2.14987 6.79988 1.76403 7.05769 1.33939 7.23358C0.914753 7.40947 0.459627 7.5 6.75609e-08 7.5L1.5299e-07 4L0 0.5Z" fill="white"/>
							</svg>

							<svg id="high-noise" class="high-noise noise-level hide" width="7" height="14" viewBox="0 0 7 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M-6.75611e-08 3.5C0.459627 3.5 0.914752 3.59053 1.33939 3.76642C1.76403 3.94231 2.14987 4.20012 2.47487 4.52513C2.79988 4.85013 3.05769 5.23597 3.23358 5.66061C3.40947 6.08525 3.5 6.54037 3.5 7C3.5 7.45963 3.40947 7.91475 3.23358 8.33939C3.05769 8.76403 2.79988 9.14987 2.47487 9.47487C2.14987 9.79988 1.76403 10.0577 1.33939 10.2336C0.914753 10.4095 0.459627 10.5 0 10.5L8.54287e-08 7L-6.75611e-08 3.5Z" fill="white"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M5 7C5 4.23858 2.76142 2 0 2V0C3.86599 0 7 3.13401 7 7C7 10.866 3.86599 14 0 14V12C2.76142 12 5 9.76142 5 7Z" fill="white"/>
							</svg>
						</div>

						<div class="polzunok-container-volume">
							<div class="polzunok-volume"></div> 
						</div>
					</div>
					<div class="full-screen">
						<svg class="open-full-screen" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.0598e-07H7V3H3V7H0V3.0598e-07Z" fill="white"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M0 18H7V15H3V11H0V18Z" fill="white"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M18 3.0598e-07V7L15 7V3L11 3V0L18 3.0598e-07Z" fill="white"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M18 18V11H15V15H11V18H18Z" fill="white"/>
						</svg>

						<svg class="close-full-screen hide" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M18 7L11 7L11 0H14L14 4L18 4L18 7ZM0 11L7 11L7 18H4L4 14L0 14V11ZM7 7L0 7V4L4 4L4 0H7L7 7ZM18 11H11V18H14V14H18V11Z" fill="white"/>
						</svg>
					</div>
				</div>
		</div>
	<?php else: ?>
		<div class="video-box youtube">
			<iframe class="youtube_video" src="<?= $arResult['PROPERTIES']['YOUTUBE_REF']['VALUE']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
			</iframe>
		</div>
	<?php endif; ?>
			<div class="title-box">
				<div>
					<h1 class="sub-title">
						<?= $arResult['NAME']; ?>
					</h1>
					<div class="sub-title-descr">
						<span class="sub-title-descr">
							<?php $countt = $arResult['SHOW_COUNTER']; ?>
							<span><?= $countt; ?></span>
							&#160;<?= 'просмотр'.$GLOBALS['helper']->Return_Ending($countt,'','a','ов'); ?>
						</span>
						<svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="2" cy="2" r="2" fill="#7F8692"/>
						</svg>
						<span class="sub-title-descr">
							<?= $GLOBALS['helper']->Date_Converter($arResult['CREATED_DATE']); ?>
						</span>
					</div>
				</div>

				<div class="button-box">
					<?php  
					$ref = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$arResult['DETAIL_PAGE_URL'];
					?>
					<a data-ref="<?= $ref; ?>" data-fancybox="" data-src="#share-popup" href="javascript:;" class="video-button share-butts" id="share-video">
						<svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1.33325 18H0.533252C0.533252 18.3323 0.738707 18.63 1.04941 18.748C1.36012 18.8659 1.71136 18.7794 1.93184 18.5307L1.33325 18ZM12.8533 12.9474H13.6533V12.1474H12.8533V12.9474ZM12.8533 17.1579H12.0533V18.7316L13.3247 17.8042L12.8533 17.1579ZM22.6666 10L23.138 10.6463L23.9759 10.0352L23.1721 9.37993L22.6666 10ZM12.8533 2L13.3587 1.37993L12.0533 0.315677V2H12.8533ZM12.8533 6.21053L12.9359 7.00624L13.6533 6.93173V6.21053H12.8533ZM1.93184 18.5307C3.38087 16.8965 4.78936 15.7167 6.47021 14.9361C8.15079 14.1556 10.1621 13.7474 12.8533 13.7474V12.1474C9.99776 12.1474 7.74238 12.5812 5.7963 13.485C3.85048 14.3886 2.2723 15.7351 0.734664 17.4693L1.93184 18.5307ZM12.0533 12.9474V17.1579H13.6533V12.9474H12.0533ZM13.3247 17.8042L23.138 10.6463L22.1951 9.35367L12.3818 16.5116L13.3247 17.8042ZM23.1721 9.37993L13.3587 1.37993L12.3478 2.62007L22.1611 10.6201L23.1721 9.37993ZM12.0533 2V6.21053H13.6533V2H12.0533ZM12.7706 5.41481C8.59992 5.84805 5.51036 7.16108 3.46841 9.34888C1.42207 11.5414 0.533252 14.4991 0.533252 18H2.13325C2.13325 14.764 2.9511 12.2481 4.6381 10.4406C6.32948 8.6284 8.99992 7.41511 12.9359 7.00624L12.7706 5.41481Z" fill="#004EA4"/>
						</svg>

						<span>Поделиться</span>
					</a>

					<button data-fancybox="" data-src="#quest-popup" href="javascript:;" class="video-button" id="any-quest">
						<svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M4.63511 12.7298L5.35065 13.0876L5.51337 12.7621L5.37503 12.4256L4.63511 12.7298ZM2 18L1.28446 17.6422L0.506585 19.198L2.19403 18.7761L2 18ZM7.76356 16.5591L8.2099 15.8952L7.91466 15.6967L7.56953 15.783L7.76356 16.5591ZM20.2 9.5C20.2 13.7526 16.7526 17.2 12.5 17.2V18.8C17.6362 18.8 21.8 14.6362 21.8 9.5H20.2ZM12.5 1.8C16.7526 1.8 20.2 5.24741 20.2 9.5H21.8C21.8 4.36375 17.6362 0.2 12.5 0.2V1.8ZM4.8 9.5C4.8 5.24741 8.24741 1.8 12.5 1.8V0.2C7.36375 0.2 3.2 4.36375 3.2 9.5H4.8ZM5.37503 12.4256C5.00465 11.5247 4.8 10.5372 4.8 9.5H3.2C3.2 10.7495 3.44685 11.9434 3.89519 13.034L5.37503 12.4256ZM3.91957 12.372L1.28446 17.6422L2.71554 18.3578L5.35065 13.0876L3.91957 12.372ZM2.19403 18.7761L7.95759 17.3352L7.56953 15.783L1.80597 17.2239L2.19403 18.7761ZM12.5 17.2C10.9104 17.2 9.43555 16.7192 8.2099 15.8952L7.31722 17.223C8.79849 18.2189 10.5826 18.8 12.5 18.8V17.2Z" fill="#004EA4"/>
						</svg>
						Есть вопрос?
					</button>

					<button data-idvideo="<?= $arResult['ID']; ?>" class="video-button fav-butt" id="add-favorites">
						<svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15 18.3963L15 2C15 1.44772 14.5523 1 14 1L2 0.999999C1.44772 0.999999 1 1.44772 1 2L1 18.4176C1 18.6615 1.27559 18.8035 1.47418 18.6619L8.21212 13.8571L14.5188 18.6354C14.7164 18.7851 15 18.6442 15 18.3963Z" stroke="#004EA4" stroke-width="1.5" stroke-linecap="round"/>
						</svg>
						<span class="option-title hide"></span>
					</button>
				</div>
			</div>

			<?php $all_text = $arResult['~DETAIL_TEXT']; ?>

            <div class="about-video-tags">
                <?php foreach ($arResult['TAGS'] as $tag): ?>
                    <div class="about-video-tag">
                        <a href="<?= '/search/?product=' . urlencode('#' . $tag) ?>">#<?= $tag ?></a>
                    </div>
                <?php endforeach; ?>
            </div>

			<p class="about-video-text short">
				<?= $GLOBALS['helper']->Сut_Text($all_text, 212); ?>
			</p>

			<p class="about-video-text full hide">
				<?= $all_text; ?>
			</p>

			<?php $boll = (mb_strlen($all_text,"UTF-8") > 212); ?>
			<div class="more-text <?= $boll? null : 'hide'; ?>">
				<span>Полное описание</span>
				<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12 0.75L6.5 6.25L1 0.75" stroke="#004EA4" stroke-linecap="round"/>
				</svg>
			</div>

			<div class="delimeter"></div>

			<?php 
			$comments = $GLOBALS['helper'] -> Return_All(
				Array("IBLOCK_ID"=>16, "ACTIVE"=>"Y", "PROPERTY_VIDEO_ID" => $arResult['ID']),
				Array("ID", "IBLOCK_ID", "NAME", "CREATED_DATE", 
					"PROPERTY_COMMENTARY_TEXT",
					"PROPERTY_USER_ID",
					"PROPERTY_VIDEO_ID"
				),
				Array("CREATED"=>"DESC")
			);

					//debug(count($comments));
			?>

			<div class="comments-line <?= count($comments) == 0?'hide':null; ?>">
				<p class="comments-num">
					<span id="number-of-comments"></span>
				</p>
				<div class="comments-show-hide" style="display: none;">
					<span>Скрыть</span>
					<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12 0.75L6.5 6.25L1 0.75" stroke="#004EA4" stroke-linecap="round"/>
					</svg>
				</div>
			</div>
			<div class="hide-show-mobile-commentary-box">

				<?php 
				$id_user = $GLOBALS['video'] -> Get_User_ID();
				$bool_us = ($id_user == 0);
				?>
				
				<div class="login-register-box <?= $bool_us?null:'hide'; ?>">
					Вы тоже можете оставлять комментраии – <a class="reff-top">Войдите</a> или <a class="reff-top">Зарегестрируйтесь</a>
				</div>
				
				<div class="commentary-box-input <?= $bool_us?'hide':null; ?>">

					<?php 
					$user_ava_id = $GLOBALS['user_ava_id'];
					$user_name = $GLOBALS['user_name'];
					?>
					<div class="user-ava ava-box">
						<?php if($user_ava_id != ''): ?>
							<img src="<?=\CFile::GetPath($user_ava_id); ?>">
							<?php else: ?>
								<span class="first-latter">
									<?= mb_substr($user_name, 0, 1, "UTF-8"); ?>
								</span>
							<?php endif; ?>
						</div>

						<div class="comment-video-box">
							<input id="comment-video-input" type="text" placeholder="Ваш комментарий">

							<div class="line-arrow" style="display: none;">
								<svg class="vert-line" width="2" height="26" viewBox="0 0 2 26" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 0V26" stroke="#EDF2F9"/>
								</svg>
								<svg data-idvideo="<?= $arResult['ID']; ?>" data-iduser="<?= $id_user; ?>" class="comment-arrow" width="21" height="17" viewBox="0 0 21 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.5 8.5H19.5M19.5 8.5L12 1M19.5 8.5L12 16" stroke="#4294FF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</div>

							<button data-idvideo="<?= $arResult['ID']; ?>" data-iduser="<?= $id_user; ?>" class="buttons" id="send-comment" style="display: none;">
								Отправить
							</button>
						</div>
					</div>

					<div class="commentary-box">
						<?php foreach ($comments as $com_item): ?>
							<?php
							$id_user_comm = $com_item['PROPERTY_USER_ID_VALUE'];
							$user_comm = $GLOBALS['helper'] -> Return_User_By_ID($id_user_comm);
							$user_comm_ava = $user_comm['PERSONAL_PHOTO'];
							$user_comm_name = $user_comm['NAME'];
							?>
							<div class="commentary-item-wraper">
								<div class="commentary-item">
									<div class="user-ava ava-box">
										<?php if($user_comm_ava != ''): ?>
											<img src="<?=\CFile::GetPath($user_comm_ava); ?>">
											<?php else: ?>
												<span class="first-latter">
													<?= mb_substr($user_comm_name, 0, 1, "UTF-8"); ?>	
												</span>
											<?php endif; ?>
										</div>

										<div class="commentary-text-box">
											<div class="author-date">
												<span class="commentary-athor"><?= $user_comm_name; ?></span>
												<svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
													<circle cx="2" cy="2" r="2" fill="#7F8692"/>
												</svg>
												<span class="commentary-date">
													<?= $GLOBALS['helper']->Date_Converter($com_item['CREATED_DATE']); ?>	
												</span>
											</div>

											<div class="commentary-text">
												<?= $com_item['PROPERTY_COMMENTARY_TEXT_VALUE']; ?>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<div style="display: none;" class="delimeter mobile"></div>
				</div>
				<?php 
				//debug($_SERVER);
				//HTTP_HOST
				?>

				<div class="right-area">
					<h2 class="similar-title">Похожие видео</h2>
					<div class="similar-box">
						<?php foreach ($similar_video as $sim_item): ?>
							<?php $id_video = $sim_item['ID'];//передаём в кнопки ?>
							<div class="similar-item">
								<?php 
								$reff = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$sim_item['DETAIL_PAGE_URL'];
								?>
								<a href="<?= $reff; ?>" data-idvideo="<?= $id_video; ?>"  class="poster-box video-box">
									<img class="poster-img" src="<?=\CFile::GetPath($sim_item['PREVIEW_PICTURE']);?>">
								</a>

								<div class="about-similar">
									<div class="similar-text">
										<?= $GLOBALS['helper']->Сut_Text($sim_item['NAME'], 47); ?>
									</div>

									<div class="video-option mark-class" style="display: none;">
										<div class="video-option-round mark-class"></div>
										<div class="video-option-round mark-class"></div>
										<div class="video-option-round mark-class"></div>
									</div>
									<p class="similar-date">
										<?= $GLOBALS['helper']->Date_Converter($sim_item['CREATED_DATE']); ?>
									</p>
								</div>

								<?php
								require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH.'/inclusion/opts-box-video.php');
								?>
							</div>
						<?php endforeach; ?>
					</div>
					<div id="more-similar-box">
						<!-- <button id="more-similar">Показать еще</button> -->
					</div>
				</div>
			</section>

			<!-- Попап -->
			<div style="display: none;" id="quest-popup">
				<h3 class="popup-title">Задать вопрос по товару</h3>
				<p class="popup-sub-title">Расскажите, что вы хотели бы узнать по данному товару</p>
				<div class="product-box">
					<?php 
					$img_id = $arResult['PROPERTIES']['PRODUCT_PHOTO']['VALUE'];
					if($img_id == '')
					{
						$path = SITE_TEMPLATE_PATH.'/img/no-photo.png';
					}
					else
					{
						$path = CFile::GetPath($img_id);
					}
					?>
					<img class="prod-img" src="<?= $path; ?>">
					<div class="prod-name desctop">
						<?= $arResult['NAME']; ?>
					</div>
					<div class="prod-name mobile" style="display: none;">
						<?= $GLOBALS['helper']->Сut_Text($arResult['NAME'], 41); ?>
					</div>
				</div>

				<form>
					<input id="check-auth-inp" type="hidden" value="<?= $id_user; ?>">
					<div class="input-line <?= $bool_us? null:'hide'; ?>">
						<input id="pop-up-mail" placeholder="Почта" type="text" class="form-inp cleare">
						<input id="pop-up-phone" placeholder="Телефон (по желанию)" type="text" class="form-inp cleare">
					</div>
					<textarea class="cleare" id="pop-up-mess" placeholder="Сообщение"></textarea>
					<p class="form-error hide"></p>
					<button id="send-pop-up-quest">Отправить</button>
				</form>
			</div>
			<!-- Попап -->






			<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH.'/libraries/polzunok/jquery.ui.touch-punch.min.js'; ?>"></script>
			<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH.'/libraries/polzunok/jquery-ui.min.js'; ?>"></script>
			<script type="text/javascript" src="/catalog/js/detail.js"></script>

<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/my_classes/getid3/getid3.php';

$path = CFile::GetPath($vide_file);

$duration = 0;

if ($path) {
    $getID3 = new getID3;
    $file = $getID3->analyze($_SERVER['DOCUMENT_ROOT'] . $path);

    $duration = round($file['playtime_seconds']);
}
?>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "VideoObject",
        "name": "<?= $arResult['NAME'] ?>",
        "description": "<?= $arResult['DETAIL_TEXT'] ?>",
        "thumbnailUrl": "<?= $arResult['PREVIEW_PICTURE']['SRC'] ? 'https://' . $_SERVER['SERVER_NAME'] . $arResult['PREVIEW_PICTURE']['SRC'] : '' ?>",
        "uploadDate": "<?= date('Y-m-d', strtotime($arResult['DATE_CREATE'])) ?>",
        "duration": "<?= 'PT' . floor($duration/60) . 'M' . $duration%60 . 'S' ?>",
        "embedUrl": "https://<?= $_SERVER['SERVER_NAME'] . CFile::GetPath($vide_file) ?>"
    }
</script>
