function Appearance_Optional_Box(boxes_selector)//Появление опцонного блока
{
	var video_boxes = document.querySelectorAll(boxes_selector);

	if(video_boxes.length != 0)
	{
		for(let item of video_boxes)
		{
			item.querySelector('.video-option').addEventListener('click', function() {
				let opt_box = item.querySelector('.opts-box-video');
				opt_box.classList.toggle('hide');
				Click_Out_Something(opt_box, 'hide', 'mark-class');
			});
		}
	}
}

async function Add_To_Section_Ajax(id_video, section_name)
{
	let response = await $.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Добавление видео в секцию',
			'id_video': id_video,
			'section_name': section_name
		},
		dataType: "json",
		success: function(data){
			if (data.status == true)
			{
				//console.log(data.test);
			}
		}
	});
}

async function Delete_From_Section_Ajax(id_video, section_name)
{
	let response = await $.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Удаление видео из секции',
			'id_video': id_video,
			'section_name': section_name
		},
		dataType: "json",
		success: function(data){
			if (data.status == true)
			{
				//console.log(data);
			}
		}
	});
}

async function Delete_Video_From_Section(section_name)
{
	var videos =  document.querySelectorAll(".history .video-item");
	var num_items = videos.length;
	var history_box = document.querySelector(".history");
	var noitem_box = document.querySelector(".no-tems");
	var num_items_video = document.querySelector("#num-items-video");

	if(num_items != 0)
	{
		for (let item of videos)
		{
			/*****меняем название кнопки убрать ии истории***/
			if(screen.width < 750)
			{
				let button_remove_text_reff = item.querySelector('.remoove-history span');
				button_remove_text_reff.innerHTML = 'Удалить';
			}
			/*****меняем название кнопки убрать ии истории***/

			let remove_button = item.querySelector('.remoove-history');
			remove_button.addEventListener('click',async function(){
				Delete_From_Section_Ajax(this.dataset.idvideo, section_name);
				item.remove();
				num_items--;
				num_items_video.innerHTML = num_items;
				if(num_items == 0)
				{
					history_box.classList.add('hide');
					noitem_box.classList.add('show_flex');
				}
			})
		}
	}
}

function Cleare_All_Items(section_name)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Очистить всё из секции',
			'section_name': section_name
		},
		dataType: "json",
		success: function(data){
			if (data.status == true)
			{
				document.querySelector(".history").classList.add('hide');
				document.querySelector(".no-tems").classList.add('show_flex');
			}
		}
	});
}

function Clear_List_Window(section_name)
{
	/**********очистить историю************/
	var desctop_clear_button = document.querySelector(".clear-history.desctop");
	var check_box_desctop = desctop_clear_button.querySelector(".check-clear-box");
	desctop_clear_button.addEventListener("click", function(){
		check_box_desctop.classList.toggle('hide');
		Click_Out_Something(check_box_desctop, 'hide', 'mark-class');
	});

	var mobile_clear_button = document.querySelector(".clear-history.mobile");
	var check_box_mobile = mobile_clear_button.querySelector(".check-clear-box");
	mobile_clear_button.addEventListener("click", function(){
		check_box_mobile.classList.toggle('hide');
		Click_Out_Something(check_box_mobile, 'hide', 'mark-class');
	});
	/**********очистить историю************/

	var clear_buttons = document.querySelectorAll('.check-clear-hist-yes');

	for(let item of clear_buttons)
	{
		item.addEventListener('click', () => Cleare_All_Items(section_name));
	}
}

async function Add_Favorites(button_selector)
{
	var buttons = document.querySelectorAll(button_selector);
	for(let item of buttons)
	{
		item.addEventListener('click',async function(){
			let id_video = item.dataset.idvideo;
			let svg_ref = item.querySelector('svg');
			let variant = Change_Button_Svg_Text(item, svg_ref,'В избранное', 'В избранном', 'active');
			if(variant == 'save')
			{
				Add_To_Section_Ajax(id_video, 'my_favorites');
			}
			if(variant == 'delete')
			{
				Delete_From_Section_Ajax(id_video, 'my_favorites');
			}
		});
	}	
}

async function Add_Watch_Later(button_selector)
{
	var buttons = document.querySelectorAll(button_selector);
	for(let item of buttons)
	{
		item.addEventListener('click',async function(){
			let id_video = item.dataset.idvideo;
			item.remove();
			Add_To_Section_Ajax(id_video, 'watch_later');
		});
	}	
}

function Change_Button_Svg_Text(button_reff, svg_reff, old_name, new_name, toggle_class)
{
	var variant;
	var button_text_reff = button_reff.querySelector('.option-title');
	if(svg_reff.classList.contains(toggle_class))
	{
		button_text_reff.innerHTML = old_name;
		variant = 'delete';
	}
	else
	{
		button_text_reff.innerHTML = new_name;
		variant = 'save';
	}
	svg_reff.classList.toggle(toggle_class);

	return variant;
}

async function Add_History(reffs_selector)
{
	var elements = document.querySelectorAll(reffs_selector);
	for(let item of elements)
	{
		item.addEventListener('click',async function(){
			let id_video = item.dataset.idvideo;
			Add_To_Section_Ajax(id_video, 'history');
		});
	}
}

function Insert_Reffs_To_Popup(elements_reffs, insert_here_reff)//Попап поделиться
{
	for (let item of elements_reffs)
	{
		let reff = item.querySelector('.video-box').href;
		let share_button = item.querySelector('[data-src="#share-popup"]');
		share_button.addEventListener('click', function(){
			insert_here_reff.value = reff;
		});
	}
}

function Insert_Button_Reffs_To_Popup(button_reffs, insert_here_reff)//Попап поделиться
{
	for (let item of button_reffs)
	{
		let reff = item.dataset.ref;
		item.addEventListener('click', function(){
			insert_here_reff.value = reff;
		});
	}
}

function Delete_All_Active(catigory_refs)
{
	for (let item of catigory_refs)
	{
		item.classList.remove('active');
	}
}

function Swith_Filter()
{
	var filter_button_ref = document.querySelector(".catalog .filters");
	var filter_var_box_ref = document.querySelector(".catalog .filter-var-box");
	var filter_variants_ref = document.querySelectorAll(".catalog .filter-var-item");

	filter_button_ref.addEventListener("click", function(){
		filter_var_box_ref.classList.toggle('hide');
		Click_Out_Something(filter_var_box_ref, 'hide', 'mark-class');
	});

	for (let item of filter_variants_ref) 
	{
		item.addEventListener("click", function(){
			Delete_All_Active(filter_variants_ref);
			item.classList.toggle('active');
			Set_Sort(item.dataset.sortprop, item.dataset.sorttype);
		});
	}
}

function Set_Sort(sort_prop, sort_type)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Установка сортировки',
			'sort_prop': sort_prop,
			'sort_type': sort_type
		},
		dataType: "json",
		success: function(dataa){
			if (dataa.status == true)
			{
				document.querySelector('#set-sort').click();
			}
		}
	});
}

function Click_Out_Something(hide_box_ref, hide_class, mark_class)
{
	if(!hide_box_ref.classList.contains(hide_class))
	{
		document.onclick = function (e) {
			let all_classes = e.target.className;
			//console.log(all_classes);
			if (!all_classes.includes(mark_class))
			{
				hide_box_ref.classList.add(hide_class);
			}
		};
	}
}

function Return_Ending(number,one,two,three)
{
	var str = String(number);
	var len = str.length;
	if(len == 1)
	{
		str = '0'+str;
		len = 2;
	}
	$bool = (str[len-1] == '2') || (str[len-1] == '3') || (str[len-1] == '4');
	if(str[len-1] == '1' && str[len-2] != '1')
	{
		return one;
	}
	else if($bool && str[len-2] != '1')
	{
		return two;
	}
	else
	{
		return three;
	}
}







 