<?php session_start(); ?>
<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
    use Bitrix\Main\Page\Asset;
    require_once($_SERVER["DOCUMENT_ROOT"]."/my_classes/myhelper.php");
    $GLOBALS['helper'] = new Myhelper;//мой обьект

    require_once($_SERVER["DOCUMENT_ROOT"]."/my_classes/myvideo.php");
    $GLOBALS['video'] = new Myvideo;//мой обьект

    $GLOBALS['user_type'] = $GLOBALS['video']->Create_Auth_Rules();

    $user_obj = new CUser;
    //$check_auth = (CUser::GetID() != 0);

    $check_auth = (($user_obj->GetID()) != 0);//0 если пользователь не зашёл, true - если авторизован

	$user_name = $user_obj -> GetFirstName();
	$user_mail = $user_obj -> GetEmail();
	$id_user = $USER->GetID();
	$this_user = $GLOBALS['helper']->Return_User_By_ID($id_user);
	$user_ava_id = $this_user['PERSONAL_PHOTO'];
	$GLOBALS['user_ava_id'] = $user_ava_id;
	$GLOBALS['user_name'] = $user_name;
?>

<!DOCTYPE html>
<html>
<head>
	<?php $APPLICATION->ShowHead() ?>
	<title><?php $APPLICATION->ShowTitle() ?></title>

	<?php
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/styles.css');
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1">');

        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/libraries/jquery-3.6.0.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/libraries/maskedinput.js');
        Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/libraries/fancybox/jquery.fancybox.min.css');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/libraries/fancybox/jquery.fancybox.min.js');
        Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/functions.js');
    ?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KLMBFJNV');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KLMBFJNV"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="for_mobile_box">
<div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>

<div id="this-user-id" style="display: none;"><?= $id_user; ?></div>

<!-- Попап поделиться -->
<div id="share-popup" style="display: none;">
	<h3 class="popup-title">Поделиться видео</h3>
	<div class="social-media">
		<div class="social-media-item">
			<a href="https://vk.com/" target="_blanc">
				<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="35" cy="35" r="35" fill="#3C87F8"/>
					<path d="M19.0796 26.5898C20.1985 26.5898 21.9037 26.5898 22.8628 26.5898C23.3424 26.5898 23.7154 26.9096 23.8752 27.3358C24.3548 28.7213 25.4205 31.7585 26.6461 33.8366C28.2979 36.5542 29.3636 37.5666 30.0563 37.46C30.749 37.3002 30.5359 35.4885 30.5359 34.0498C30.5359 32.6111 30.6957 30.16 30.003 29.041L28.9373 27.4957C28.6709 27.1227 28.9373 26.6431 29.3636 26.6431H35.4381C36.0243 26.6431 36.5038 27.1227 36.5038 27.7088V35.4352C36.5038 35.4352 36.7702 36.8206 38.2622 35.3819C39.7542 33.9432 41.3528 31.2789 42.6849 28.5614L43.2178 27.2826C43.3776 26.9096 43.7506 26.6431 44.1769 26.6431H48.12C48.866 26.6431 49.3988 27.3891 49.1324 28.0818L48.7061 29.2008C48.7061 29.2008 47.2674 32.0782 45.7754 34.1031C44.2835 36.1812 43.9637 36.6607 44.1769 37.1936C44.39 37.7265 48.2266 41.2966 49.1857 43.0017C49.4521 43.4813 49.6653 43.9075 49.8784 44.2805C50.2514 44.9732 49.7186 45.8791 48.9193 45.8791H44.4433C44.0703 45.8791 43.6973 45.6659 43.5375 45.3462L43.1112 44.6535C43.1112 44.6535 40.3936 41.4564 38.7418 40.444C37.0367 39.4849 37.09 40.8703 37.09 40.8703V43.6944C37.09 44.8667 36.1308 45.8258 34.9585 45.8258H33.8928C33.8928 45.8258 28.0315 45.8258 23.3424 38.8454C19.6657 33.4104 18.4401 29.8935 18.0138 27.8687C17.9073 27.2293 18.3868 26.5898 19.0796 26.5898Z" fill="white"/>
				</svg>
			</a>
			<p class="social-name">Вконтакте</p>
		</div>

		<div class="social-media-item">
			<a href="https://ok.ru/" target="_blanc">
				<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="35" cy="35" r="35" fill="#F58220"/>
					<path d="M34.8207 21C31.3646 21 28.5156 23.8023 28.5156 27.3051C28.5156 30.7612 31.3179 33.6101 34.8207 33.6101C38.3235 33.6101 41.1258 30.8079 41.1258 27.3051C41.1258 23.8023 38.2768 21 34.8207 21ZM34.8207 29.4068C33.6531 29.4068 32.719 28.4727 32.719 27.3051C32.719 26.1375 33.6531 25.2034 34.8207 25.2034C35.9883 25.2034 36.9224 26.1375 36.9224 27.3051C36.9224 28.4727 35.9883 29.4068 34.8207 29.4068Z" fill="white"/>
					<path d="M42.5731 37.8601C40.9852 38.7475 39.2571 39.3546 37.529 39.6349L42.433 45.6597C42.9934 46.3603 43.1336 47.3411 42.6198 48.0883C41.8258 49.3026 40.1445 49.3493 39.3038 48.2752L34.7735 42.7173L30.2899 48.2752C29.8696 48.7889 29.3091 49.0224 28.702 49.0224C28.0948 49.0224 27.4876 48.7422 27.0673 48.1817C26.5536 47.4812 26.6003 46.3136 27.1607 45.613L32.018 39.5415C30.2899 39.2145 28.5618 38.6541 27.0206 37.7667C26.0398 37.2063 25.7129 35.9919 26.2733 34.9644C26.8338 33.9837 28.0948 33.6567 29.0756 34.2172C32.6251 36.2255 37.062 36.2255 40.6582 34.2639C41.639 33.7034 42.9 34.0771 43.4138 35.0579C43.9275 36.0853 43.5539 37.2997 42.5731 37.8601Z" fill="white"/>
				</svg>
			</a>
			<p class="social-name">ОК</p>
		</div>

		<div class="social-media-item">
			<a href="https://t.me/telegram" target="_blanc">
				<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="35" cy="35" r="35" fill="url(#paint0_radial_836_4886)"/>
					<path d="M43.9705 26.2387L21.8216 34.8066C20.9303 35.2056 20.6289 36.0046 21.6062 36.4383L27.2884 38.2497L41.027 29.7323C41.7771 29.1975 42.5451 29.3401 41.8843 29.9283L30.0846 40.6456L29.714 45.1812C30.0573 45.8815 30.6859 45.8847 31.0869 45.5367L34.3514 42.438L39.9425 46.6379C41.2411 47.4091 41.9476 46.9114 42.227 45.4979L45.8943 28.0786C46.275 26.3387 45.6257 25.5721 43.9705 26.2387Z" fill="white"/>
					<defs>
						<radialGradient id="paint0_radial_836_4886" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(58.8636 70) rotate(-121.535) scale(82.1285)">
							<stop stop-color="#4092FF"/>
							<stop offset="1" stop-color="#5EB6FF"/>
						</radialGradient>
					</defs>
				</svg>
			</a>
			<p class="social-name">Telegram</p>
		</div>

		<div class="social-media-item">
			<a href="https://web.whatsapp.com/" target="_blanc">
				<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="35" cy="35" r="35" fill="#67C15E"/>
					<g clip-path="url(#clip0_836_4876)">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M32.0874 28.1113C31.816 27.4612 31.6101 27.4365 31.1989 27.4199C31.0589 27.4118 30.9029 27.4037 30.7299 27.4037C30.1948 27.4037 29.6355 27.5601 29.2979 27.9057C28.8867 28.3255 27.8662 29.3048 27.8662 31.313C27.8662 33.3213 29.3307 35.2636 29.5283 35.5355C29.7341 35.8067 32.3836 39.9879 36.4977 41.692C39.7148 43.0253 40.6694 42.9017 41.4016 42.7455C42.4713 42.5152 43.8124 41.7246 44.15 40.7702C44.4873 39.8153 44.4873 39.0005 44.3884 38.8277C44.2897 38.6549 44.0181 38.5564 43.6068 38.3504C43.1956 38.1445 41.196 37.1569 40.8175 37.0252C40.4472 36.8854 40.0935 36.9348 39.8139 37.3299C39.4188 37.8814 39.0323 38.4412 38.7195 38.7785C38.4727 39.0418 38.0694 39.0749 37.7321 38.9349C37.2795 38.7459 36.0125 38.3009 34.4491 36.9101C33.2394 35.8321 32.4167 34.4907 32.1782 34.0874C31.9396 33.6759 32.1535 33.437 32.3427 33.215C32.5486 32.9597 32.7459 32.7788 32.9515 32.5399C33.1573 32.3013 33.2724 32.1779 33.4041 31.8979C33.5441 31.6264 33.4452 31.3464 33.3466 31.1406C33.2477 30.9343 32.425 28.926 32.0874 28.1113ZM35.9958 21C28.2779 21 22 27.2797 22 34.9998C22 38.0614 22.9874 40.901 24.6659 43.2055L22.9214 48.4072L28.3026 46.6874C30.5159 48.1523 33.1571 49 36.0042 49C43.7221 49 50 42.7199 50 35.0002C50 27.2801 43.7221 21.0004 36.0042 21.0004H35.9961L35.9958 21Z" fill="white"/>
					</g>
					<defs>
						<clipPath id="clip0_836_4876">
							<rect width="28" height="28" fill="white" transform="translate(22 21)"/>
						</clipPath>
					</defs>
				</svg>
			</a>
			<p class="social-name">Whatsapp</p>
		</div>

		<div class="social-media-item">
			<a href="https://mail.ru/" target="_blanc">
				<svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="35" cy="35" r="35" fill="#CCCCCC"/>
					<path fill-rule="evenodd" clip-rule="evenodd" d="M23.0445 28.4823L35.4997 37.4501L47.9554 28.482C47.71 27.072 46.4802 26 45 26H26C24.5197 26 23.2898 27.0722 23.0445 28.4823ZM48 30.5503L35.4997 39.5505L23 30.5507V41.1818C23 42.8387 24.3431 44.1818 26 44.1818H45C46.6569 44.1818 48 42.8387 48 41.1818V30.5503Z" fill="white"/>
				</svg>
			</a>
			<p class="social-name">Почта</p>
		</div>
	</div>
	<div class="popup-delimeter"></div>
	<p class="pop-up-text">
		Или просто скопируйте ссылку и отправляйте ее
	</p>
	<div class="copy-line">
		<input id="ref-text" type="text" readonly value="no-reff">
		<button id="copy-video-ref">Копировать</button>
	</div>
</div>
<!-- Попап поделиться -->

	<header>
		<div class="menu-logo">
			<div id="catalog_nav_btn">
				<svg width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 19H22M22 1H1M1 10H18" stroke="#1C1C1C" stroke-width="2" stroke-linecap="round"/>
				</svg>
			</div>
			<a class="head-logo" href="/">HUALIAN MACHINERY</a>
		</div>

		<form action="/search/" method="GET" class="head-search mark-class">
		<div style="display: none;" class="mobile-search-arrow mark-class">
			<svg class="mark-class" width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M9 1L1 9L9 17" stroke="#3D3D3D" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</div>

			<svg class="loopa" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="7.5" cy="7.5" r="6.7" stroke="#3D3D3D" stroke-width="1.6"/>
				<line x1="11.5657" y1="12.4343" x2="17.5657" y2="18.4343" stroke="#3D3D3D" stroke-width="1.6"/>
			</svg>
			<input value="<?= $_GET['product']; ?>" autocomplete="off" name="product" id="head-search" type="text" placeholder="Поиск по видео" class="mark-class">

			<div class="go-to-box" style="display: none;">
				<svg id="head-search-cross" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L15 15" stroke="#8F8F8F" stroke-linecap="round"/>
					<path d="M1 15L15 0.999999" stroke="#8F8F8F" stroke-linecap="round"/>
				</svg>

				<svg class="head-search-line" width="1" height="26" viewBox="0 0 1 26" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0.5 0V26" stroke="#EDF2F9"/>
				</svg>

				<svg id="head-search-arrow" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 9H19M19 9L11.5 1.5M19 9L11.5 16.5" stroke="#004EA4" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</div>

			<div class="head-search-vars mark-class hide">
			</div>
		</form>

		<div class="private-office">
			<svg style="display: none;" class="mobile-loopa" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="7.5" cy="7.5" r="6.7" stroke="#3D3D3D" stroke-width="1.6"/>
				<line x1="11.5657" y1="12.4343" x2="17.5657" y2="18.4343" stroke="#3D3D3D" stroke-width="1.6"/>
			</svg>


			<p class="about-registr mark-class <?= $check_auth? 'hide' : null; ?>">Что дает регистрация?</p>
			<div id="go-to-office" class="mark-class <?= $check_auth? 'hide' : null; ?>">
				<svg class="mark-class" width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="11" cy="6" r="5.2" stroke="#3D3D3D" stroke-width="1.6"/>
					<path d="M1 19.4999C7 14 15 14 21 19.4999" stroke="#3D3D3D" stroke-width="1.6" stroke-linecap="round"/>
				</svg>
				<span class="mark-class">Войти</span>
			</div>

			<div class="user mark-class <?= $check_auth? null : 'hide'; ?>" id="user-ofice">
				<div class="user-ava mark-class">
					<?php if($user_ava_id != ''): ?>
						<img class="mark-class" src="<?=\CFile::GetPath($user_ava_id); ?>">
					<?php else: ?>
						<span class="first-latter mark-class">
							<?= mb_substr($user_name, 0, 1, "UTF-8"); ?>
						</span>
					<?php endif; ?>
				</div>
				<span class="user-name mark-class"><?= $user_name; ?></span>
			</div>

			<div class="about-registr-box hide mark-class">
				<h2 class="registr-title mark-class">Что дает регистрация?</h2>
				<p class="registr-text mark-class">
					Регистрация позволяет вам смотреть видео, не доступные в обычной версии, сохрнять видео в избранное и просмотры в будущем, оставлять комментарии и многе другое.
				</p>
				<button class="buttons forms registr-button" id="header-registr">Регистрация</button>
			</div>

			<div class="form-box mark-class hide">
				<div class="close-line hide">
					<svg id="close-form-cross" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L17 17" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round"/>
						<path d="M1 17L17 0.999999" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round"/>
					</svg>
				</div>
				<div class="no-author mark-class <?= $check_auth? 'hide' : null; ?>">
				<!-- <div class="no-author mark-class"> -->
					<div class="come-in-form form-window mark-class hide">
						<!-- <h2 class="come-in-title mark-class">Войти</h2>
						<input id="come-in-form-email" type="text" class="come-in-input mark-class" placeholder="Почта">
						<input id="come-in-form-password" type="password" class="come-in-input mark-class" placeholder="Пароль">
						<p class="form-error hide mark-class"></p>
						<button class="buttons mark-class" id="come-in">Войти</button> -->

						<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth_form", Array(
								"FORGOT_PASSWORD_URL" => "",	// Страница забытого пароля
								"PROFILE_URL" => "",	// Страница профиля
								"REGISTER_URL" => "",	// Страница регистрации
								"SHOW_ERRORS" => "N",	// Показывать ошибки
								"COMPONENT_TEMPLATE" => ".default",
								"AJAX_MODE" => "Y"
							),
							false
						);?>

						<div class="option-line mark-class">
							<span class="registr-button mark-class">Регистрация</span>
							<svg class="mark-class" width="1" height="26" viewBox="0 0 1 26" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.5 1.00049V25.0005" stroke="#EDF2F9" stroke-linecap="round"/>
							</svg>
							<span class="remember-passw mark-class">Вспомнить пароль</span>
						</div>
					</div>

					<div class="register-form form-window mark-class hide">
						<h2 class="come-in-title mark-class">Регистрация</h2>
						<p class="explanation mark-class">Кем вы являетесь?</p>
						<div class="switch-box mark-class">
							<div class="switch-item active mark-class" id="natural-person">Физлицо</div>
							<div class="switch-item mark-class" id="entity">Юрлицо</div>
						</div>

						<!-- <input id="register-form-name" type="text" class="come-in-input mark-class" placeholder="Имя">++
						<input id="register-form-mail" type="text" class="come-in-input mark-class" placeholder="Почта">++
						<input id="register-form-pass" type="password" class="come-in-input mark-class" placeholder="Пароль">++
						<input id="registr-phone" type="text" class="come-in-input mark-class" placeholder="Телефон (по желанию)">++
						<input id="company-inn" type="number" class="come-in-input hide mark-class" placeholder="ИНН компании">
						<p class="form-error mark-class hide"></p>
						<button class="buttons forms mark-class" id="register">Регистрация</button> -->

						<!-- Пользовательские поля -->
						<!-- <input id="company-inn" type="number" class="come-in-input mark-class hide" placeholder="ИНН компании"> -->

						<?$APPLICATION->IncludeComponent(
							"bitrix:main.register",
							"registr_form",
							array(
								"AUTH" => "Y",
								"REQUIRED_FIELDS" => array(
								),
								"SET_TITLE" => "Y",
								"SHOW_FIELDS" => array(
									0 => "EMAIL",
									1 => "NAME",
									2 => "PERSONAL_PHONE",
								),
								"SUCCESS_PAGE" => "",
								"USER_PROPERTY" => array(
								),
								"USER_PROPERTY_NAME" => "",
								"USE_BACKURL" => "Y",
								"AJAX_MODE" => "Y",
								"COMPONENT_TEMPLATE" => "registr_form"
							),
							false
						);?>



						<div class="option-line mark-class">
							<span class="come-in-buttons mark-class">Войти</span>
							<svg class="mark-class" width="1" height="26" viewBox="0 0 1 26" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.5 1.00049V25.0005" stroke="#EDF2F9" stroke-linecap="round"/>
							</svg>
							<span class="remember-passw mark-class">Вспомнить пароль</span>
						</div>
					</div>

					<form class="remember-password hide form-window mark-class" enctype="multipart/form-data" method="post">
						<h2 class="come-in-title mark-class">Вспомнить пароль</h2>
						<p class="explanation mark-class">
							Вышлем новый временный пароль
							для вашей учетной записи
						</p>
						<input id="email-remember-password" type="text" class="come-in-input mark-class" placeholder="Почта">

						<p class="form-error mark-class hide"></p>

						<button class="buttons forms mark-class" id="send_pass">Отправить пароль</button>

						<div class="option-line mark-class">
							<span class="come-in-buttons mark-class">Войти</span>
							<svg class="mark-class" width="1" height="26" viewBox="0 0 1 26" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M0.5 1.00049V25.0005" stroke="#EDF2F9" stroke-linecap="round"/>
							</svg>
							<span class="registr-button mark-class">Регистрация</span>
						</div>
					</form>

					<div class="send-password-window hide form-window mark-class">
						<h2 class="come-in-title mark-class">Выслали новый пароль</h2>
						<p class="explanation mark-class">
							Отправили новый пароль, проверьте свой ящик и следуйте инструкции
						</p>
						<button class="buttons forms mark-class come-in-buttons" id="send_pass">Войти</button>
					</div>
				</div>

				<div class="author mark-class <?= $check_auth? null : 'hide'; ?>">
					<div class="menu-form-author mark-class form-window hide">
						<div class="user-main-info mark-class">
							<div class="user-round mark-class">
								<?php if($user_ava_id != ''): ?>
									<img class="obj-fit ava-img-option mark-class" src="<?=\CFile::GetPath($user_ava_id); ?>">
								<?php else: ?>
									<span class="first-latter mark-class">
										<?= mb_substr($user_name, 0, 1, "UTF-8"); ?>
									</span>
								<?php endif; ?>
							</div>

							<div class="name-mail mark-class">
								<h2 class="come-in-title mark-class"><?= $user_name; ?></h2>
								<p class="explanation mark-class">
									<?= $user_mail; ?>
								</p>
							</div>
						</div>

						<div class="delimeter mark-class"></div>

						<div class="seller hide mark-class">
							<svg class="mark-class" width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.71652 1.70933L8.71663 1.70966C8.71659 1.70955 8.71656 1.70944 8.71652 1.70933L8.7595 1.69445L8.71652 1.70933ZM9.66146 1.38209C9.44401 0.754183 8.556 0.75418 8.33854 1.38208L6.76546 5.92442L1.95933 6.01685C1.29497 6.02963 1.02056 6.87417 1.55053 7.27502L5.38444 10.1748L3.98717 14.7742C3.79402 15.41 4.51243 15.932 5.05743 15.5518L9 12.8016L12.9426 15.5518C13.4876 15.932 14.206 15.41 14.0128 14.7742L12.6156 10.1748L16.4495 7.27502C16.9794 6.87418 16.705 6.02963 16.0407 6.01685L11.2345 5.92442L9.66146 1.38209ZM8.82836 12.6819L8.82884 12.6822L8.82836 12.6819Z" fill="#BB5A13" stroke="white"/>
							</svg>
							<span class="seller-title mark-class">Оптовый продавец</span>
						</div>

						<div class="menu-form-author-item mark-class change-name-ava">Сменить имя и аватар</div>
						<div class="menu-form-author-item mark-class change-password-menu">Сменить пароль</div>
						<div class="menu-form-author-item mark-class" id="log-out-profile">Выйти</div>
					</div>

					<form class="change-name-ava-form mark-class form-window hide">
						<h2 class="come-in-title mark-class">Имя и аватар</h2>
						<div class="user-main-info mark-class">
							<div class="user-round mark-class">
								<span class="first-latter mark-class change-form">
									<?= mb_substr($user_name, 0, 1, "UTF-8"); ?>
								</span>
								<img class="obj-fit ava-img-option hide mark-class change-form" src="#">
							</div>
							<button class="mark-class" id="load-ava">Загрузить аватар</button>

							<div style="display: none;" class="mark-class">
								<input name="ava_file" class="mark-class" accept="image/*" type='file' id="file-input-ava" />
							</div>
						</div>

						<div class="delimeter mark-class"></div>

						<input name="new_name" id="change-name" type="text" class="come-in-input mark-class" placeholder="Имя">

						<input type="hidden" name="delimiter" value="Смена имени и аватара">
						<input type="hidden" name="user_id" value="<?= $id_user; ?>">

						<?php $id_ava = $GLOBALS['helper']->Return_User_By_ID($id_user)['PERSONAL_PHOTO']; ?>

						<input type="hidden" name="old-photo-id" value="<?= $id_ava; ?>">

						<p class="form-error mark-class hide"></p>

						<div class="mail-box come-in-input mark-class">
							<?= $USER->GetEmail(); ?>
						</div>

						<button class="buttons forms mark-class" id="change-ava-name">Сохранить изменения</button>

						<p class="explanation mark-class go-to-menu-auth">Вернуться назад</p>
					</form>

					<form class="change-password-form mark-class form-window hide">
						<h2 class="come-in-title mark-class">Сменить пароль</h2>

						<input id="old-password" type="password" class="come-in-input mark-class" placeholder="Старый пароль">

						<input id="new-password" type="password" class="come-in-input mark-class" placeholder="Новый пароль">

						<input id="repeat-password" type="password" class="come-in-input mark-class" placeholder="Повторите новый пароль">

						<p class="form-error mark-class hide"></p>

						<button class="buttons forms mark-class" id="change-password-button">Сохранить изменения</button>

						<p class="explanation mark-class go-to-menu-auth">Вернуться назад</p>
					</form>
				</div>
			</div>
		</div>

		<?php
			$menu = $GLOBALS['helper']->Return_All_Fields_Props(
				Array("IBLOCK_ID"=>15, "ACTIVE"=>"Y"),
				Array(),
				Array("sort"=>"asc"));
			//debug($menu);
		?>

		<div class="menu-box">
			<div class="menu">
				<div>
					<ul class="main-menu">
					<?php foreach ($menu as $menu_item): ?>
					<?php
						$ref = $menu_item['props']['MENU_ITEM_REF']['VALUE'];
						if(strlen($ref) == 1 && $GLOBALS['helper']->Check_Main_Page())
						{
							$bool = true;
						}
						else
						{
							$bool = $GLOBALS['helper']->Check_Page(str_replace('/', '', $ref));
						}
					?>
						<li>
							<a class="menu-reff <?= $bool? 'active' : null; ?>" href="<?= $ref; ?>">
								<?= $menu_item['props']['MENU_ITEM_ICON']['~VALUE']['TEXT']; ?>
								<span class="menu-name">
									<?= $menu_item['props']['MENU_ITEM_NAME']['VALUE']; ?>
								</span>
							</a>
						</li>
					<?php endforeach; ?>
					</ul>

					<div class="menu-delimeter"></div>

					<div class="catalog-vars">
						<h2 id="catalog-reff" class="catalog-title active">Каталог</h2>
						<h2 id="tag-reff" class="catalog-title">По тегам</h2>
					</div>

					<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.section.list",
						"main_sections",
						Array(
							"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
							"ADD_SECTIONS_CHAIN" => "N",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"CACHE_TIME" => "36000000",
							"CACHE_TYPE" => "A",
							"COUNT_ELEMENTS" => "N",
							"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
							"FILTER_NAME" => "sectionsFilter",
							"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
							"IBLOCK_ID" => "14",
							"IBLOCK_TYPE" => "catalog",
							"SECTION_CODE" => "",
							"SECTION_FIELDS" => array("",""),
							"SECTION_ID" => $_REQUEST["SECTION_ID"],
							"SECTION_URL" => "",
							"SECTION_USER_FIELDS" => array("",""),
							"SHOW_PARENT_NAME" => "Y",
							"TOP_DEPTH" => "2",
							"VIEW_MODE" => "LINE"
						)
					);?>

					<?php
						// $tegs = $GLOBALS['helper'] -> Return_List_Variants(14, 'TAG');
						$tegs = $GLOBALS['video']->Return_Tegs_For_Type_User();

						$visible = 8;//количество видимых пунктов меню тегов
						$len = count($tegs);
					?>

					<div class="hide this-tag"><?= $_GET['tag']; ?></div>

					<div class="teg-catalog hide">
						<ul class="tag-menu">
						<?php for ($j = 0; $j <= $visible-1; $j++): ?>
						<?php $name = $tegs[$j]; if (!$name) continue; ?>
							<li><a class="menu-reff" href="/search/?product=<?= urlencode('#' . $name) ?>">#<?= $name; ?></a></li>
						<?php endfor; ?>
						</ul>

						<?php $boolll = isset($tegs[$visible]); ?>

						<?php if($boolll): ?>
						<ul class="teg-menu-hide" style="display: none;">
							<?php for ($j = $visible; $j <= $len-1; $j++): ?>
							<?php $name = $tegs[$j]; ?>
								<li><a class="menu-reff" href="/catalog/?tag=<?= $name; ?>"><?= $name; ?></a></li>
							<?php endfor; ?>
						</ul>
						<?php endif; ?>

						<div id="more-tags" class="more-catalog-butt <?= $boolll? null : 'hide'; ?>">
							<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
								<path d="M12.25 0.75L6.75 6.25L1.25 0.75" stroke="#004EA4" stroke-linecap="round"></path>
							</svg>
							<span>Все теги</span>
						</div>
					</div>
				</div>

				<div class="menu-footer">
					<div class="menu-delimeter"></div>
					<div class="last-line">
						<a target="_blank" href="https://hmru.ru/" class="domen">
							© HMRU.RU
						</a>
						<div class="social-media">
							<a target="_blank" href="https://t.me/hualianmachinery">
								<svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M15.6199 0.170482L0.558719 6.29043C-0.0473645 6.57541 -0.252363 7.14617 0.412202 7.4559L4.27608 8.74976L13.6184 2.66591C14.1284 2.28396 14.6507 2.38582 14.2013 2.80595L6.17755 10.4612L5.92549 13.7009C6.15895 14.2011 6.58642 14.2034 6.85907 13.9548L9.07898 11.7414L12.8809 14.7413C13.7639 15.2922 14.2444 14.9367 14.4344 13.9271L16.9281 1.48471C17.187 0.241906 16.7455 -0.305672 15.6199 0.170482Z" fill="#7C7C7C"/>
								</svg>
							</a>

							<a target="_blank" href="https://vk.com/hualian">
								<svg width="23" height="15" viewBox="0 0 23 15" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M1.0027 0.864258C1.77194 0.864258 2.94413 0.864258 3.60349 0.864258C3.93316 0.864258 4.18958 1.08404 4.29947 1.37709C4.62915 2.32949 5.36177 4.41745 6.20428 5.84605C7.33983 7.71422 8.07245 8.41021 8.54865 8.33695C9.02485 8.22706 8.87833 6.98161 8.87833 5.99258C8.87833 5.00354 8.98822 3.31852 8.51202 2.54928L7.7794 1.48698C7.59625 1.23057 7.7794 0.900889 8.07245 0.900889H12.2484C12.6513 0.900889 12.981 1.23057 12.981 1.63351V6.94498C12.981 6.94498 13.1641 7.89738 14.1898 6.90835C15.2155 5.91931 16.3144 4.08777 17.2302 2.2196L17.5965 1.34046C17.7064 1.08404 17.9628 0.900889 18.2558 0.900889H20.9665C21.4793 0.900889 21.8456 1.41372 21.6625 1.88992L21.3694 2.65917C21.3694 2.65917 20.3804 4.63723 19.3547 6.02921C18.3291 7.45781 18.1093 7.78749 18.2558 8.15379C18.4023 8.5201 21.0398 10.9744 21.6991 12.1466C21.8823 12.4762 22.0288 12.7693 22.1753 13.0257C22.4317 13.5019 22.0654 14.1246 21.516 14.1246H18.439C18.1826 14.1246 17.9261 13.9781 17.8163 13.7583L17.5232 13.2821C17.5232 13.2821 15.655 11.0843 14.5195 10.3883C13.3473 9.72892 13.3839 10.6813 13.3839 10.6813V12.6228C13.3839 13.4286 12.7246 14.088 11.9187 14.088H11.1861C11.1861 14.088 7.15668 14.088 3.93316 9.28935C1.40564 5.55301 0.563126 3.13537 0.270079 1.7434C0.196818 1.30383 0.526495 0.864258 1.0027 0.864258Z" fill="#7C7C7C"/>
								</svg>
							</a>

							<a target="_blank" href="https://www.youtube.com/@hualian_machinery">
								<svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M17.7271 1.00658C18.0184 1.29787 18.2284 1.66031 18.3362 2.05789C18.7337 3.5256 18.7454 6.56968 18.7454 6.56968C18.7454 6.56968 18.7454 9.62576 18.3485 11.0818C18.2407 11.4793 18.0307 11.8418 17.7394 12.1331C17.4481 12.4244 17.0857 12.6343 16.6881 12.7422C15.2321 13.1394 9.3727 13.1394 9.3727 13.1394C9.3727 13.1394 3.5133 13.1394 2.0576 12.7419C1.66002 12.6341 1.29758 12.4241 1.00629 12.1328C0.715003 11.8415 0.505006 11.479 0.397168 11.0815C0 9.61376 0 6.56968 0 6.56968C0 6.56968 0 3.5256 0.38516 2.06961C0.492998 1.67203 0.702994 1.30959 0.994283 1.0183C1.28557 0.727012 1.64801 0.517015 2.04559 0.409177C3.50158 0.011716 9.36099 0 9.36099 0C9.36099 0 15.2201 0 16.6758 0.397461C17.0734 0.505299 17.4358 0.715296 17.7271 1.00658ZM12.3564 6.5699L7.49581 9.38522L7.49552 3.75457L12.3564 6.5699Z" fill="#7C7C7C"/>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="menu-shade"></div>
		</div>

		<div class="mobile-shade" style="display: none;"></div>
	</header>