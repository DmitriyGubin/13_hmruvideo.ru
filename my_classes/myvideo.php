<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

class Myvideo extends Myhelper// $GLOBALS['video'] - объект
{
	private $user_id;

	public function __construct()
	{
		//$this->user_id = CUser::GetID();
		$user_obj = new CUser;
		$this->user_id = $user_obj->GetID();
	}

	public function Get_User_ID()
	{
		return $this->user_id;
	}

	public function Create_Auth_Rules()//$GLOBALS['user_type']
	{
		if($this->user_id == 0)
		{
			return 'NOT_REGISTER';
		}
		else
		{
			$user_obj = new CUser;
			$arGroups = $user_obj->GetUserGroupArray();
			if(in_array(1, $arGroups))//админ
			{
				return 'ALL';//всё видео
			}
			else if(in_array(7, $arGroups))
			{
				return 'RETAIL';
			}
			else if(in_array(8, $arGroups))
			{
				return 'DEALERS';
			}
			else if(in_array(9, $arGroups))
			{
				return 'MANAGERS';
			}
			else
			{
				return 'ALL';//всё видео
			}
		}
	}

	public function Make_Video_Filter_For_User($filter)
	{
		$user_type = $this->Create_Auth_Rules();
		if($user_type == 'ALL') 
		{
			return $filter;
		}
		else
		{
			$prop_user = 'PROPERTY_'.$user_type.'_VALUE';
			$filter[$prop_user] = 'YES';
			return $filter;
		}
	}

	public function Return_Videos_For_Type_User()
	{
		//$all_tags = $this->Return_List_Variants(14, 'TAG');
		$user_type = $this->Create_Auth_Rules();
		if($user_type == 'ALL')
		{
			$filter = Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y");
		}
		else
		{
			$prop_user = 'PROPERTY_'.$user_type.'_VALUE';
			$filter = Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", $prop_user => 'YES');
		}
		$videos = $this->Return_All_Fields_Props($filter,Array(),Array());
		return $videos;
	}

	public function Return_Section_Videos_For_Type_User($sec_id)//проверить
	{
		$sub_sect = $this->Return_All_Sections(
				Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "SECTION_ID" => $sec_id),
				Array("ID")
			);
		$sub_sect_ids = [];
		foreach ($sub_sect as $item) 
		{
			$sub_sect_ids[] =  $item['ID'];
		}

		if(count($sub_sect_ids) == 0)
		{
			//$sub_sect_ids = $sec_id;
			return 'no';
		}

		$user_type = $this->Create_Auth_Rules(); 
		if($user_type == 'ALL')
		{
			$filter = Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "SECTION_ID" =>$sub_sect_ids);
		}
		else
		{
			$prop_user = 'PROPERTY_'.$user_type.'_VALUE';
			$filter = Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", $prop_user => 'YES', "SECTION_ID" =>$sub_sect_ids);
		}
		$videos = $this->Return_All_Fields_Props($filter,Array(),Array());
		return $videos;
	}

	public function Return_Tegs_For_Type_User()
	{
		$videos = $this->Return_Videos_For_Type_User();
		$tegs = [];
		foreach ($videos as $item) 
		{
            foreach ($item['props']['TAG']['VALUE'] as $tag) {
                $tegs[] = $tag;
            }
		}
		$tegs = array_unique($tegs);

        $tagsResult = [];

        if ($tegs) {
            $dbRes = CIBlockElement::GetList(['SORT' => 'ASC', 'NAME' => 'ASC'], ['IBLOCK_ID' => IBLOCK_TAGS_ID, 'ACTIVE' => 'Y', 'ID' => $tegs]);
            while ($arRes = $dbRes->Fetch()) {
                $tagsResult[] = $arRes['NAME'];
            }
        }

        $tegs = $tagsResult;

		$res_tegs = [];
		foreach ($tegs as $item) 
		{
			if($item != '')
			{
				$res_tegs[] = $item;
			}
		}
		return $res_tegs;
	}

	public function Parent_Sections_For_Type_User()
	{
		$videos = $this->Return_Videos_For_Type_User();
		$iblock_sec_ids = [];
		foreach ($videos as $item) 
		{
			$iblock_sec_ids[] = $item['fields']['IBLOCK_SECTION_ID'];
		}

		$iblock_sec_ids = array_unique($iblock_sec_ids);
		$res_secs = [];
		foreach ($iblock_sec_ids as $item) 
		{
			$res_secs[] = $this->Return_Parent_Section_Name(14,$item);
		}
		$res_secs = array_unique($res_secs);
		$res_secs = array_values($res_secs);
		return $res_secs;
	}

	public function Sections_For_Type_User($sec_id)//проверить
	{
		$videos = $this->Return_Section_Videos_For_Type_User($sec_id);

		$iblock_sec_ids = [];

		if($videos == 'no')
		{
			return $iblock_sec_ids;
		}

		foreach ($videos as $item) 
		{
			$iblock_sec_ids[] = $item['fields']['IBLOCK_SECTION_ID'];
		}

		$sub_sects_ids = array_unique($iblock_sec_ids);
		$sub_sects_ids = array_values($sub_sects_ids);
		
		/***************/
		$sub_sects = $this->Return_All_Sections(
			Array("IBLOCK_ID"=>14, "ACTIVE"=>"Y", "SECTION_ID" => $sec_id),
			Array("ID", "NAME", "SECTION_PAGE_URL")
		);

		$sub_sects_new = [];
		foreach ($sub_sects_ids as $key => $id) 
		{
			foreach ($sub_sects as $item) 
			{
				if($item['ID'] == $id)
				{
					$sub_sects_new[$key]['ID'] = $item['ID'];
					$sub_sects_new[$key]['NAME'] = $item['NAME'];
					$sub_sects_new[$key]['SECTION_PAGE_URL'] = $item['SECTION_PAGE_URL'];
					break;
				}
			}
		}

		return $sub_sects_new; 
	}

	public function Add_Video_To_Section($section_name, $id_video)
	{
		if($this->user_id == 0)//для не авторизованного пользователя
		{
			if(!isset($_SESSION[$section_name]))
			{
				$_SESSION[$section_name] = [];
			}

			$_SESSION[$section_name][] = $id_video;
			//$_SESSION[$section_name] = array_unique($_SESSION[$section_name]);//на всякий)))
		}
		else//для авторизованного
		{
			if($section_name == 'my_favorites')
			{
				$this->Add_Id_To_List($this->user_id, $id_video, 'UF_FAVORITES');
			}

			if($section_name == 'watch_later')
			{
				$this->Add_Id_To_List($this->user_id, $id_video, 'UF_WATCH_LATER');
			}

			if($section_name == 'history')
			{
				$this->Add_Id_To_List($this->user_id, $id_video, 'UF_HISTORY');
			}
		}
	}

	private function Add_Id_To_List($user_id, $video_id, $bitrix_prop_code)
	{
		$str = $this->Return_User_By_ID($user_id)[$bitrix_prop_code];
		$str_new = $str.$video_id.';';

		$user = new CUser;
		$fields = Array(
			  $bitrix_prop_code     => $str_new
			  );

		$user->Update($user_id, $fields);
	}

	public function Delete_Video_From_Section($section_name, $id_video)
	{
		if($this->user_id == 0)//для не авторизованного пользователя
		{
			if(count($_SESSION[$section_name]) > 0)
			{
				$num = -1;
				foreach ($_SESSION[$section_name] as $key => $value) 
				{
					if($value == $id_video)
					{
						$num = $key;
						break;
					}
				}

				if($num != -1)
				{
					unset($_SESSION[$section_name][$num]);
				}
			}
		}
		else//для авторизованного
		{
			if($section_name == 'my_favorites')
			{
				$this->Delete_Id_From_List($this->user_id, 'UF_FAVORITES', $id_video);
			}

			if($section_name == 'watch_later')
			{
				$this->Delete_Id_From_List($this->user_id, 'UF_WATCH_LATER', $id_video);
			}

			if($section_name == 'history')
			{
				$this->Delete_Id_From_List($this->user_id, 'UF_HISTORY', $id_video);
			}
		}
	}

	private function Delete_Id_From_List($user_id, $bitrix_prop_code, $id_video)
	{
		$str = $this->Return_User_By_ID($user_id)[$bitrix_prop_code];
		$find_this = $id_video.';';
		$str_new = str_replace($find_this, '', $str);

		$user = new CUser;
		$fields = Array(
			  $bitrix_prop_code     => $str_new
			  );

		$user->Update($user_id, $fields);
	}

	public function Delete_All_Video_From_Section($section_name)
	{
		if($this->user_id == 0)//для не авторизованного пользователя
		{
			$_SESSION[$section_name] = [];
		}
		else//для авторизованного
		{
			if($section_name == 'my_favorites')
			{
				$this-> Delete_All_Id_From_List($this->user_id, 'UF_FAVORITES');
			}

			if($section_name == 'watch_later')
			{
				$this-> Delete_All_Id_From_List($this->user_id, 'UF_WATCH_LATER');
			}

			if($section_name == 'history')
			{
				$this-> Delete_All_Id_From_List($this->user_id, 'UF_HISTORY');
			}
		}
	}

	private function Delete_All_Id_From_List($user_id, $bitrix_prop_code)
	{
		$user = new CUser;
		$fields = Array(
			  $bitrix_prop_code     => ''
			  );

		$user->Update($user_id, $fields);
	}

	public function Return_Id_Videos_Yes_No_Auth($session_code, $bitrix_section_code)
	{
		if($this->user_id == 0)//для не авторизованного пользователя)
		{
			$ids = $_SESSION[$session_code];
		}
		else//для авторизованого
		{
			$ids = $this->Return_Ids_Video_From_Section($this->user_id, $bitrix_section_code);
		}

		if($ids == '')
		{
			$ids = Array();
		}

		return $ids;
	}

	public function Check_Session_Sort($prop_code, $type_sort)
	{
		$bool = (($_SESSION['prop_sort'] == $prop_code) and ($_SESSION['type_sort'] == $type_sort));
		if($bool)
		{
			return 'active';
		}
		else
		{
			return null;
		}
	}

	public function Change_Sequence($videos_arr,$ids_arr)
	{
		$sort_video = [];
		$reverse_id = array_reverse($ids_arr);
		foreach ($reverse_id as $id)
		{
			foreach ($videos_arr as $item) 
			{
				if($item['ID'] == $id)
				{
					$sort_video[] = $item;
					break;
				}
			}
		}
		return $sort_video;
	}

	private	function Mass_To_String($arr)
	{
		$str = '';
		foreach ($arr as $item) 
		{
			$str = $str.$item.';';
		}
		return $str;
	}

	public function Change_Watch_Later_Ids($ids)
	{
		$ids_rev = array_reverse($ids);
		if($this->user_id == 0)//для не авторизованного пользователя)
		{
			$_SESSION['watch_later'] = $ids_rev;
		}
		else//для авторизованого
		{
			$str = $this->Mass_To_String($ids_rev);
			$user = new CUser;
			$fields = Array(
				  'UF_WATCH_LATER'     => $str
				  );

			$user->Update($this->user_id, $fields);
		}

		return true;
	}
}

?>