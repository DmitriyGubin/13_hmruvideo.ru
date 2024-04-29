var ref_text = document.querySelector("#ref-text");
/*********Обработчик опций к видео***************/
Option_Init();
function Option_Init()
{
	Add_Favorites('.button-line .favorites');
	Add_Watch_Later('.button-line .watch-later');
	Add_History('.video-item .video-box');
}

BX.addCustomEvent('onAjaxSuccess', function() 
{
	Option_Init();
	Init_Pop_Ups_After_Ajax();
});
/*********Обработчик опций к видео***************/

var videos = document.querySelectorAll('.history .video-item');
var num_videos = document.querySelector('.history #num-videos');
num_videos.innerHTML = videos.length;

/*******переключатель фильтров***********/
Swith_Filter();
/*******переключатель фильтров***********/


/*********************** Попап поделиться ***********************/
var butts_share = document.querySelectorAll('.button-line .share-video');
Insert_Button_Reffs_To_Popup(butts_share, ref_text);

function Init_Pop_Ups_After_Ajax()
{
	let share_buttons = document.querySelectorAll('[data-src="#share-popup"]');
	Insert_Button_Reffs_To_Popup(share_buttons, ref_text);

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
