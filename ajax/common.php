<?php
//session_start();

require_once($_SERVER["DOCUMENT_ROOT"]."/my_classes/myhelper.php");//подключаем класс, без autoloal (не так много классов)

require_once($_SERVER["DOCUMENT_ROOT"]."/my_classes/myvideo.php");

//use \My_classes\Helper;

// поключаем модуль инфоблоков
CModule::IncludeModule('iblock');

$user = new CUser;//класс битрикса
$id_user = $USER->GetID();

$helper = new Myhelper;
$video = new Myvideo;

foreach ($_POST as $key => $value) 
{
	$_POST[$key] = trim($value);
}

$arResult = array('status' => false);

$delimeter = $_POST['delimiter'];

if($delimeter == 'Выход из профиля')
{
	$USER->Logout();
	$arResult['status'] = true;
}

if($delimeter == 'Проверка почты на уникальность')
{
	$arResult['status'] = $helper->Check_Mail($_POST['mail']);
}

if($delimeter == 'Добавление пользователя в группу диллеров')
{
	$fields = Array(
	  "UF_INN_COMPANY" => $_POST['inn']
	  );

	$user_id = $helper->Return_User_By_Login($_POST['login'])['ID'];

	if($user->Update($user_id, $fields))
	{
		//$helper->Add_User_To_Diller_Group($user_id);
		$helper->Add_User_To_Retail_Group($user_id);
		$arResult['status'] = true; 
	}
}

if($delimeter == 'Добавление пользователя в группу клиенты розница')
{
	$user_id = $helper->Return_User_By_Login($_POST['login'])['ID'];
	$helper->Add_User_To_Retail_Group($user_id);
	$arResult['status'] = true;
}

if($delimeter == 'Вспомнить пароль')
{
	// $PROP = array();
	// $PROP['PASSW'] = 'passw';
	// $PROP['EMAIL_TO'] = 'testgubin@mail.ru';
	// if(CEvent::Send("FORGOT_PASSWORD", "s1", $PROP))
	// {
	// 	$arResult['status'] = true;
	// }

	$password = '1Ab@%$'.time().'-'.mt_rand();
	$to      = $_POST['mail'];
	$subject = 'Информационное сообщение сайта HUALIAN';
	$headers = 'From: hualian@bitrix406.timeweb.ru';
	$body = 'Ваш временный пароль для сайта: '.$password;

	$fields = Array(
	  "PASSWORD"          => $password
	 );

	$user_id = $helper->Return_User_By_Mail($to)['ID'];

	if(mail( $to, $subject, $body, $headers ))
	{
		$user->Update($user_id, $fields);
		$arResult['status'] = true;
	}
}

if($delimeter == 'Смена имени и аватара')
{
	$new_name = $_POST['new_name'];
	$user_id = $_POST['user_id'];
	$old_file_id = $_POST['old-photo-id'];


	// $arr_file = array(
	//   "name" =>$_FILES['ava_file']['name'],
	//   "size" =>$_FILES['ava_file']['size'],
	//   "tmp_name" =>$_FILES['ava_file']['tmp_name'],
	//   "type" => "",
	//   "old_file" => "",
	//   "del" => "Y",
	//   "MODULE_ID" => ""
	// );
	// $fid = CFile::SaveFile($arr_file, "patch");


	/*******************/
	$fileId = CFile::SaveFile($_FILES["ava_file"],'avatar');
    $arFile = CFile::MakeFileArray ($fileId);
    $arFile['del'] = "Y";
    $arFile['old_file'] = $old_file_id;
	/*******************/

	$fields = Array(
	  "NAME"              => $new_name,
	  "LOGIN"             => $new_name.(time()*1000),
	  "PERSONAL_PHOTO" => $arFile
	 );

	if($user->Update($user_id, $fields))
	{
		$arResult['status'] = true;
		//$arResult['file'] = $arFile;
		if($old_file_id != '')
		{
			CFile::Delete($old_file_id);
			unlink(CFile::MakeFileArray($old_file_id)['tmp_name']);//удаление с сервера
		}
	}
}

if($delimeter == 'Проверка пароля в базе')
{
	$user_password_hash = $helper->Return_User_By_ID($id_user)['PASSWORD'];

	if(\Bitrix\Main\Security\Password::equals($user_password_hash, $_POST['password']))
	{
		$arResult['status'] = true;
	}
}

if($delimeter == 'Изменение пароля')
{
	$fields = Array(
	  "PASSWORD"          => $_POST['new_password']
	  );
	if($user->Update($id_user, $fields))
	{
		$arResult['status'] = true;
	}
}

if($delimeter == 'Добавление видео в секцию')
{
	$video -> Add_Video_To_Section($_POST['section_name'], $_POST['id_video']);
	$arResult['status'] = true;
}

if($delimeter == 'Удаление видео из секции')
{
	$video -> Delete_Video_From_Section($_POST['section_name'], $_POST['id_video']);
	$arResult['status'] = true;
}

if($delimeter == 'Очистить всё из секции')
{
	$video -> Delete_All_Video_From_Section($_POST['section_name']);
	$arResult['status'] = true;
}

// if($delimeter == 'Переключание секций каталога')
// {
// 	$_SESSION['id_section'] = $_POST['id_section'];
// 	$arResult['status'] = true;
// }

if($delimeter == 'Запись комментария')
{
	$PROP = array();
	$PROP['COMMENTARY_TEXT'] = $_POST['text'];
	$PROP['USER_ID'] = $_POST['id_user'];
	$PROP['VIDEO_ID'] = $_POST['id_video'];

	$datee = date_create();
	date_modify($datee, '4 hour');
	$date = date_format($datee, 'd.m.Y H:i:s');

	$el = new CIBlockElement;

	$arElem = Array(
		"IBLOCK_SECTION_ID" => false,
		"IBLOCK_ID"      => 16,
		"NAME"           => 'Новый комментарий от '.$date,
		"ACTIVE"         => "Y",
		"PROPERTY_VALUES"=> $PROP
	);

	if($comm_id = $el->Add($arElem))
	{
		$this_user = $helper->Return_User_By_ID($id_user);
		$id_ava = $this_user['PERSONAL_PHOTO'];
		$user_name = $user -> GetFirstName();

		if($id_ava != '')
		{
			$arResult['ava'] = \CFile::GetPath($id_ava);
		}
		else
		{
			$arResult['ava'] = 'no-ava';
		}

		$arResult['name'] = $user_name;
		$arResult['date'] = date_format($datee, 'd.m.Y');
		$arResult['status'] = true;
	}
}

if($delimeter == 'Установка сортировки')
{
	$_SESSION['prop_sort'] = $_POST['sort_prop'];
	$_SESSION['type_sort'] = $_POST['sort_type'];
	$arResult['status'] = true;
}

if($delimeter == 'Поиск товаров в базе')
{
    $tags = [];

	$user_type = $video->Create_Auth_Rules();
	if($user_type == 'ALL')
	{
		$filter = Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "?NAME"=>$_POST['product_name']);
	}
	else
	{
		$prop_user = 'PROPERTY_'.$user_type.'_VALUE';
		$filter = Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "?NAME"=>$_POST['product_name'], $prop_user => 'YES');
	}

	$like_videos = $helper -> Return_All($filter,
		Array("ID", "IBLOCK_ID", "NAME"),
		Array()
	);

	if(count($like_videos) > 0)
	{
		$arResult['status'] = true;
		$arResult['videos'] = $like_videos;
        $arResult['tags'] = [];
	}

    if (mb_substr($_POST['product_name'], 0, 1) === '#') {
        unset($filter['?NAME']);

        $dbRes = CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => IBLOCK_TAGS_ID, 'ACTIVE' => 'Y']);
        while ($arRes = $dbRes->Fetch()) {
            if (str_starts_with(mb_strtolower($arRes['NAME']), mb_substr(mb_strtolower($_POST['product_name']), 1))) {
                $tags[] = [
                    'ID' => $arRes['ID'],
                    'NAME' => '#' . $arRes['NAME'],
                ];
            }
        }

        $arResult['videos'] = [];
        $arResult['tags'] = $tags;

        if ($tags) {
            $arResult['status'] = true;
        }
    }
}

if($delimeter == 'Изменение последовательности смотреть пойзже')
{
	$arr = json_decode($_POST['ids']);
	if($video -> Change_Watch_Later_Ids($arr))
	{
		$arResult['status'] = true;
	}
}

if($delimeter == 'Отправка вопроса на почту')
{
	$PROP = array();
	$PROP['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	$PROP['MAIL'] = $_POST['mail'];
	$PROP['PHONE'] = $_POST['phone'];
	$PROP['MESSAGE'] = $_POST['mess'];

	if(CEvent::Send("NEW_QUESTION", "s1", $PROP))
	{
		$arResult['status'] = true;
	}
}

echo json_encode($arResult);

?>