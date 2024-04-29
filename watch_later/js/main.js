/*******обработчик карточек video*****/
Delete_Video_From_Section('watch_later');

/**********очистить историю************/
Clear_List_Window('watch_later');
Add_Favorites('.button-line .favorites');
Add_History('.video-item .video-box');

/****************перетаскивание элементов списка************/
if(screen.width > 750)
{
	$('.histiory-box').sortable({
		update: Update_Sort
	});
}

function Update_Sort()
{
	var elements = document.querySelectorAll('.history .video-box');
	var ids = [];
	var j = 0;
	for(let item of elements)
	{
		ids[j] = item.dataset.idvideo;
		j++;
	}
	//console.log(ids);
	//Записывай через Ajax
	Change_Watch_Later_Ids(ids);
}

function Change_Watch_Later_Ids(ids)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Изменение последовательности смотреть пойзже',
			'ids': JSON.stringify(ids)
		},
		dataType: "json",
		success: function(data){
			if (data.status == true)
			{
				//console.log(data.id);
			}
		}
	});
}

/****************перетаскивание элементов списка************/


/*********************** Попап поделиться ***********************/
var ref_text = document.querySelector("#ref-text");
var butts_share = document.querySelectorAll('.button-line .share-video');
Insert_Button_Reffs_To_Popup(butts_share, ref_text);