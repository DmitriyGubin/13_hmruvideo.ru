/*********Обработчик опций к видео***************/
Appearance_Optional_Box('div.video-item');

Add_Favorites('.option-item.add-favorites');
Add_Watch_Later('.option-item.watch-later');

Add_History('.video-item .video-box');
/*********Обработчик опций к видео***************/

/*********************** Попап поделиться ***********************/
var elements = document.querySelectorAll('.video-item');
var ref_text = document.querySelector("#ref-text");
Insert_Reffs_To_Popup(elements, ref_text);
/*********************** Попап поделиться ***********************/