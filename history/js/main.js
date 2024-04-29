/*******обработчик карточек video*****/
Delete_Video_From_Section('history');

/**********очистить историю************/
Clear_List_Window('history');
Add_Favorites('.button-line .favorites');

/*********************** Попап поделиться ***********************/
var ref_text = document.querySelector("#ref-text");
var butts_share = document.querySelectorAll('.button-line .share-video');
Insert_Button_Reffs_To_Popup(butts_share, ref_text);

