<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("тестовый");

// $to      = 'gubindmitry91@mail.ru';
// $subject = 'Информационное сообщение сайта HUALIAN';
// $headers = 'From: hualian@bitrix406.timeweb.ru';
// $body = 'сообщение';
// mail( $to, $subject, $body, $headers );

?>

<style type="text/css">
	header .menu-box
	{
		display: none !important;
	}
</style>

<div class="wrap">
	<?php 
		// function Create_Img_Path($path)
		// {
		// 	if($path == '')
		// 	{
		// 		return SITE_TEMPLATE_PATH.'/img/no-photo.png';
		// 	}
		// }

		// debug($GLOBALS['user_type']);
		//$show = $GLOBALS['video']->Return_Videos_For_Type_User();
		//debug(Sections_For_Type_Userr(101));

		function Search_Video_Rules($prop_mass)//$arResult['PROPERTIES']
		{
			$mass_var = [
				'RETAIL' => $prop_mass['RETAIL']['VALUE'],
				'DEALERS' => $prop_mass['DEALERS']['VALUE'],
				'MANAGERS' => $prop_mass['MANAGERS']['VALUE'],
				'NOT_REGISTER' => $prop_mass['NOT_REGISTER']['VALUE']
			];

			$res_mas = [];
			foreach ($mass_var as $key => $value) 
			{
				if($value == 'YES')
				{
					$res_mas[] = $key;
				}
			}

			return $res_mas;
		}

		
	?>

		<!-- <img src="<?= Create_Img_Path(''); ?>"> -->
	</div>

	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>