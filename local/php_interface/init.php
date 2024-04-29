<?php 

define('IBLOCK_TAGS_ID', 17);

/*Проверка If-Modified-Since и вывод 304 Not Modified */
AddEventHandler('main', 'OnEpilog', array('CBDPEpilogHooks', 'CheckIfModifiedSince'));
class CBDPEpilogHooks
{
    public static function CheckIfModifiedSince()
    {
        GLOBAL $lastModified;

        if ($lastModified)
        {
            header("Cache-Control: public");
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastModified) . ' GMT');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lastModified) {
                $GLOBALS['APPLICATION']->RestartBuffer();CHTTP::SetStatus('304 Not Modified');
                exit();
            }
        }
    }
}

function debug($data)
{
	echo '<pre>'.print_r($data, 1).'</pre>';
}

/******авторизация по почте***********/
AddEventHandler("main", "OnBeforeUserLogin", "DoBeforeUserLoginHandler");
function DoBeforeUserLoginHandler(&$arFields)
{
    $userLogin = $_POST["USER_LOGIN"];
    if (isset($userLogin))
    {
        $isEmail = strpos($userLogin,"@");
        if ($isEmail>0)
        {
            $arFilter = Array("EMAIL"=>$userLogin);
            $rsUsers = CUser::GetList(($by="id"), ($order="desc"), $arFilter);
            if($res = $rsUsers->Fetch())
            {
				if($res["EMAIL"]==$arFields["LOGIN"])
                $arFields["LOGIN"] = $res["LOGIN"];
            }
        }
    }
}
/******авторизация по почте***********/

?>