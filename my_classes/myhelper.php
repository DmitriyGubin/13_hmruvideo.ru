<?php  
//namespace My_classes;

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

//use Bitrix\Main\UserTable\CUser;

class Myhelper
{
	public function Return_User_By_ID($id)
	{
		$rsUser = CUser::GetByID($id);
		$arUser = $rsUser->Fetch();
		return $arUser;
	}

	protected function Add_User_To_Group($group_id, $user_id)
	{
		$arGroups = CUser::GetUserGroup($user_id);
		$arGroups[] = $group_id;
		CUser::SetUserGroup($user_id, $arGroups);
	}

	public function Add_User_To_Retail_Group($user_id)//группа клиенты розница
	{
		$this -> Add_User_To_Group(7,$user_id);
	}

	public function Add_User_To_Diller_Group($user_id)//группа Клиенты диллеры
	{
		$this -> Add_User_To_Group(8,$user_id);
	}

	public function Return_Ids_Video_From_Section($id_user, $bitrix_section_code)
	{
		$str_id = $this->Return_User_By_ID($id_user)[$bitrix_section_code];
		$mass_id = explode(';', $str_id);
		$mass_len = count($mass_id);
		if($mass_id[$mass_len - 1] == '')
		{
			array_pop($mass_id);
		}
		return $mass_id;
	}

	public function Return_User_By_Login($login)
	{
		$rsUser = CUser::GetByLogin($login);
		$arUser = $rsUser->Fetch();
		return $arUser;
	}

	public function Return_All_Users($Filter,$Additional_opts)
	{
		$res = CUser::GetList(
		            ($by="id"),//поле для сортировки
		            ($order="desc"),
		            $Filter,
		            $Additional_opts
		        );

		$result = [];
		while($line = $res->Fetch())
		{
			$result[] = $line;
		}
		return $result;
	}

	public function Check_Mail($email)
	{
		$users = $this->Return_All_Users(Array(), Array());

		foreach ($users as $person) 
		{
			if($person['EMAIL'] == $email)
			{
				return true;
			}
		}
		return false;
	}

	public function Return_User_By_Mail($mail)
	{
		$users = $this->Return_All_Users(Array(), Array());

		foreach ($users as $person) 
		{
			if($person['EMAIL'] == $mail)
			{
				return $person;
			}
		}
		
		return false;
	}

	public function Сut_Text($text, $number_letters)
	{
		if(mb_strlen($text,"UTF-8") > $number_letters)
		{
			return mb_substr($text, 0, $number_letters, "UTF-8").'...';
		}
		else
		{
			return $text;
		}
	}

	public function Return_All($Filter,$Select,$Sort)
	{
		if(CModule::IncludeModule("iblock"))
		{ 
			$res = CIBlockElement::GetList(
		            $Sort, //сортировка данных
		            $Filter, //фильтр данных
		            false, //группировка данных
		            false, // постраничная навигация
		            $Select
		        );

			$result = [];
			while($ob = $res->GetNextElement())
			{
				$result[] = $ob->GetFields();
			}
			return $result;
		}
		else
		{
			return 'Error';
		}
	}

	public function Return_All_Fields_Props($Filter,$Select,$Sort)
	{
		if(CModule::IncludeModule("iblock"))
		{ 
			$res = CIBlockElement::GetList(
		            $Sort, //сортировка данных
		            $Filter, //фильтр данных
		            false, //группировка данных
		            false, // постраничная навигация
		            $Select
		        );

			$result = [];
			$j=0;
			while($ob = $res->GetNextElement())
			{
				$result[$j]['fields'] = $ob->GetFields();
				$result[$j]['props'] = $ob->GetProperties();
				$j++;
			}
			return $result;
		}
		else
		{
			return 'Error';
		}
	}

	public function Check_Main_Page()
	{
		$this_url = $_SERVER['REQUEST_URI'];
		$one_var = ($this_url[0] == '/') && ($this_url[1] == '');
		$two_var = ($this_url[0] == '/') && ($this_url[1] == '?');
		$bool = $one_var || $two_var;
		return $bool;
	}

	public function Check_Page($url_part)
	{
		$this_url = $_SERVER['REQUEST_URI'];
		$bool = (strpos($this_url, $url_part) != false);
		return $bool;
	}

	public function Return_All_Sections($Filter,$Select)
	{
		if(CModule::IncludeModule("iblock"))
		{ 
			$res = CIBlockSection::GetList(
	                Array(),
	                $Filter,
	                false,
	                $Select,
	                false
	            );

			$result = [];
			while($ob = $res->GetNextElement())
			{
				$result[] = $ob->GetFields();
			}
			return $result;
		}
		else
		{
			return 'Error';
		}
	}

	public function Return_Sections_Path($iblock_id,$iblock_sect_id)
	{
		$branch = CIBlockSection::GetNavChain($iblock_id,$iblock_sect_id);
		$result = [];
		while($ob = $branch->GetNextElement())
		{
			$result[] = $ob->GetFields();
		}
		return $result;
	} 

	public function Return_Parent_Section_Name($iblock_id,$iblock_sect_id)
	{
 		return $this->Return_Sections_Path($iblock_id,$iblock_sect_id)[0]['NAME'];
	}
 
	public function Return_Ending($number,$one,$two,$three)
	{
		$str = (string)$number;
		$len = strlen($str);
		if($len == 1)
		{
			$str = '0'.$str;
			$len = 2;
		}
		$bool = ($str[$len-1] == '2') || ($str[$len-1] == '3') || ($str[$len-1] == '4');
		if($str[$len-1] == '1' && $str[$len-2] != '1')
		{
			return $one;
		}
		else if($bool && $str[$len-2] != '1')
		{
			return $two;
		}
		else
		{
			return $three;
		}
	}

	public function Date_Converter($date)
	{
		$video_date = MakeTimeStamp($date, "YYYY.MM.DD");
		$date_now = time();
		$delta = $date_now - $video_date;
		$day_sec = 86400;//количество секунд в дне
		if($delta <= $day_sec)
		{
			return 'сегодня';
		}
		else if($delta <= $day_sec*2)
		{
			return 'вчера';
		}
		else if($delta <= $day_sec*3)
		{
			return 'позавчера';
		}
		else if($delta <= $day_sec*14)
		{
			return 'неделю назад';
		}
		else if($delta <= $day_sec*30)
		{
			return '2 недели назад';
		}
		else if($delta <= $day_sec*30*6)
		{
			return 'месяц назад';
		}
		else if($delta <= $day_sec*366)
		{
			return '6 месяцев назад';
		}
		else
		{
			return 'год назад';
		}
	}

	public function Return_List_Variants($iblock_id, $prop_code)
	{
		if(CModule::IncludeModule("iblock"))
		{
			$property_enums = CIBlockPropertyEnum::GetList(
				Array(), 
				Array("IBLOCK_ID"=>$iblock_id, "CODE"=>$prop_code)
			);

		  $props = [];//получаем список возможных свойств
		  while($enum_fields = $property_enums->GetNext())
		  {
		  	$props[] = $enum_fields['VALUE'];
		  }
		  return $props;
		}
		else
		{
			return 'Error';
		}
	}

	public function Id_Sections_Two_Level_Catalog($iblock_section_id)
	{
		$sects_path = $this -> Return_Sections_Path(14,$iblock_section_id);
		$parent_sect_id = $sects_path[0]['ID'];

		$sub_sects = $this -> Return_All_Sections(
			Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "SECTION_ID" => $parent_sect_id),
			Array("ID", "NAME")
		);
		$sub_sects_ids = [];
		foreach ($sub_sects as $value) 
		{
			$sub_sects_ids[] = $value['ID'];
		}

		$sub_sects_ids[] = $parent_sect_id;

		return $sub_sects_ids;
	}
}


?>