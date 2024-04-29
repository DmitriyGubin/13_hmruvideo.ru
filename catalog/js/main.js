/***********????????????????**************/
//var set_sort_butt = document.querySelector('#set-sort');
// var set_sort_butt = document.querySelector('#all-catalog');
// set_sort_butt.click();
/***********????????????????**************/

/*********Слайдеры************/
First_Sliders_Init();

window.addEventListener('resize', function(){
	First_Sliders_Init();
});

function First_Sliders_Init()
{
	if(screen.width < 750)
	{
		$('.catigory-mobile-slider').slick({
		dots: false,
		infinite: true,
		  // centerMode: true,
		variableWidth: true,
		arrows : false,
		infinite: false
		});
	}
}

/*********Слайдеры************/

/*******переключатель категорий***********/
//var catigories = document.querySelectorAll(".catigory .catigory-item");

//Swich_Catigory(catigories);

function Swich_Catigory(catigory_refs)
{
	for (let item of catigory_refs) 
	{
		item.addEventListener("click",function(){
			let id_section = item.dataset.idsection;
			//Change_Section(id_section);
			Delete_All_Active(catigory_refs);
			item.classList.toggle('active');
		});
	}
}

async function Change_Section(id_section)
{
	let response = await $.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Переключание секций каталога',
			'id_section': id_section
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
/*******переключатель категорий***********/

/*******переключатель фильтров***********/
Swith_Filter();
/*******переключатель фильтров***********/

/*********************** Попап поделиться ***********************/
var ref_text = document.querySelector("#ref-text");
var elements = document.querySelectorAll('.video-item');
Insert_Reffs_To_Popup(elements, ref_text);

function Init_Pop_Ups_After_Ajax()
{
	let share_buttons = document.querySelectorAll('[data-src="#share-popup"]');
	if(share_buttons.length != 0)
	{
		$('[data-src="#share-popup"]').fancybox({
	    afterLoad : function(){
	    		$("#share-popup").removeClass('fadeOutDown animated');
	            $("#share-popup").addClass('fadeInUp animated');
	        },
	    beforeClose : function(){
	    		$("#share-popup").removeClass('fadeInUp animated');
	            $("#share-popup").addClass('fadeOutDown animated');
	        }
		});
	}
}
/*********************** Попап поделиться ***********************/

/*********Обработчик опций к видео***************/
Video_Options_Init();


function Video_Options_Init()
{
	Appearance_Optional_Box('div.video-item');

	Add_Favorites('.option-item.add-favorites');
	Add_Watch_Later('.option-item.watch-later');

	Add_History('.video-item .video-box');
}

/*********Обработчик опций к видео***************/ 

BX.addCustomEvent('onAjaxSuccess', function() 
{
	First_Sliders_Init();
	Swith_Filter();
	Video_Options_Init();
	var elements = document.querySelectorAll('.video-item');
	Insert_Reffs_To_Popup(elements, ref_text);
	Init_Pop_Ups_After_Ajax(); 
});