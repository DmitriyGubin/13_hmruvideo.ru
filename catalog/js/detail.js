
/**показать больше**/
Create_More_Items_System(1, 1, '#more-similar-box', '.play-video .similar-item', 'hide');

function Create_More_Items_System(number_initially_visible, delta_items, selector_button_parent, selector_item, hide_class)
{
	var all_elements = document.querySelectorAll(selector_item);
	var amount = all_elements.length;
	if(amount != 0)
	{
		if (amount  > number_initially_visible)
		{
			var j = 0;
			for (let item of all_elements)
			{
				j++;
				if(j > number_initially_visible)
				{
					item.classList.add(hide_class);
				}
			}

			var parent = document.querySelector(selector_button_parent);
			let button = document.createElement('button');
			button.id = 'more-similar';
			button.innerHTML = 'Показать еще';
			parent.appendChild(button);

			Click_Button_More_Items(delta_items, all_elements, button.id, 'hide');
		}
	}
}

function Click_Button_More_Items(num_records, elements_reff, id_button, hide_class)
{
	var button_id_selector = '#' + id_button;
	document.querySelector(button_id_selector).addEventListener("click", function(){
	    var num = 0;
	    for (let item of elements_reff)
	    {
	        if((item.classList.contains(hide_class)) && (num < num_records))
	        {
	            item.classList.remove(hide_class);
	            num++;
	        }
	    }
	    if (num == 0)
	    {
	        document.querySelector(button_id_selector).remove();
	    }
	});
}
/**показать больше**/


/*******чeрeдование классов кнопки svg избранное*****/

function Change_Button_Arrow_Text(button_reff, svg_reff, old_name, new_name, toggle_class)
{
	var button_text_reff = button_reff.querySelector('span');
	button_reff.addEventListener("click", function(){
		if(svg_reff.classList.contains(toggle_class))
		{
			button_text_reff.innerHTML = old_name;
		}
		else
		{
			button_text_reff.innerHTML = new_name;
		}
		svg_reff.classList.toggle(toggle_class);
	});
}

/*******чeрeдование классов кнопки svg избранное*****/


/*************Полное, краткое описание*****************/
var text_button_ref = document.querySelector('.play-video .more-text');
var short_text_ref = document.querySelector('.play-video .about-video-text.short');
var full_text_ref = document.querySelector('.play-video .about-video-text.full');
Change_Button_Arrow_Text(text_button_ref,
					   document.querySelector('.play-video .more-text svg'), 
					   'Полное описание', 'Скрыть', 'active-arrow');
text_button_ref.addEventListener('click', function(){
	short_text_ref.classList.toggle('hide');
	full_text_ref.classList.toggle('hide');
});
/*************Полное, краткое описание*****************/



/*********Отправка комментария*******************/
var desctop_button_send = document.querySelector('.play-video .line-arrow');
var mobile_button_send = document.querySelector('.play-video #send-comment');

First_Comments_Input_Init();

window.addEventListener('resize', function(){
	First_Comments_Input_Init();
});

function First_Comments_Input_Init()
{
	if(screen.width < 750)
	{
		Moble_Comments_Input();
	}
	else
	{
		Desctop_Comments_Input();
	}
}

function Moble_Comments_Input()
{
	desctop_button_send.classList.add('hide');
	Comment_Input_Rules('.play-video #send-comment', 'show');
}

function Desctop_Comments_Input()
{
	mobile_button_send.classList.add('hide');
	Comment_Input_Rules('.play-video .line-arrow', 'show_flex');
}

function Comment_Input_Rules(hide_button_selector, show_class_name)
{
	var coment_input = document.querySelector('.play-video #comment-video-input');
	var go_to_button = document.querySelector(hide_button_selector);
	coment_input.addEventListener('input', function(){
		go_to_button.classList.add(show_class_name);
		if(coment_input.value.length == 0)
		{
			go_to_button.classList.remove(show_class_name);
		}
	});
}
/*********Отправка комментария*******************/



/*******Скрываем, показываем на комментарии*********/
var text_arrow_reff = document.querySelector('.play-video .comments-show-hide');
var hide_show_box = document.querySelector('.hide-show-mobile-commentary-box');


Change_Button_Arrow_Text(text_arrow_reff,
					   document.querySelector('.play-video .comments-show-hide svg'), 
					   'Скрыть', 'Показать', 'active');
text_arrow_reff.addEventListener('click', function(){
		$(hide_show_box).slideToggle(300);
});
/*******Скрываем, показываем на комментарии*********/


/*******видео******/
var video = document.querySelector('#video-player');
var play_stop_ref = document.querySelector('.video-buts .play-stop');
var play_button_ref = document.querySelector('.video-buts .play-video-icon');
var stop_button_ref = document.querySelector('.video-buts .stop-video');
var current_time_ref = document.querySelector('.video-buts .current-video-time');
var all_video_time_ref = document.querySelector('.video-buts .all-video-time');

$(".polzunok-time").slider({
    min: 0,
    max: 100,
    value: 0,
    range: "min",
    animate: "fast",
    slide : function(event, ui) 
    {  
    	video.pause();
    	video.currentTime = video.duration*ui.value/100;
    	if(play_button_ref.classList.contains('hide'))
    	{
    		video.play();
    	}
    }    
});

//var b = new Intl.NumberFormat("ru").format($(".polzunok-time").slider("value"));

var no_nois_ref = document.querySelector('.video-buts .no-noise');
var middle_nois_ref = document.querySelector('.video-buts .middle-noise');
var high_nois_ref = document.querySelector('.video-buts .high-noise');
var all_noise = document.querySelectorAll('.video-buts .noise-level');
var radio_button_reff = document.querySelector('.play-video .main-radio');

radio_button_reff.addEventListener('click', No_Noise);

function Hide_All(ref)
{
	for(let item of ref)
	{
		item.classList.add('hide');
	}
}

function Search_Active_Noise_Id()
{
	for(let item of all_noise)
	{
		if(!item.classList.contains('hide'))
		{
			return item.id;
		}
	}
}


function No_Noise()
{
	Hide_All(all_noise);
	no_nois_ref.classList.toggle('no-noise');
	if(!no_nois_ref.classList.contains('no-noise'))
	{
		no_nois_ref.classList.remove('hide');
		$(".polzunok-volume").slider("value",0);
		video.volume = 0;
	}
	else
	{
		$(".polzunok-volume").slider("value",50);
		video.volume = 0.5;
		middle_nois_ref.classList.remove('hide');
	}
	
}


$(".polzunok-volume").slider({
    min: 0,
    max: 100,
    value: 50,
    range: "min",
    animate: "fast",
    slide : function(event, ui) 
    {  
    	video.volume = ui.value/100;
    	Hide_All(all_noise);
    	if(ui.value == 0)
    	{
    		no_nois_ref.classList.remove('hide');
    	}
    	else if(ui.value > 0 && ui.value <= 50)
    	{
    		middle_nois_ref.classList.remove('hide');
    	}
    	else
    	{
    		high_nois_ref.classList.remove('hide');
    	}
    	// console.log(ui.value);
    }    
});

play_stop_ref.addEventListener('click', function(){

	if(stop_button_ref.classList.contains('hide'))
	{
		video.play();
	}
	else
	{
		video.pause();
	}

	play_button_ref.classList.toggle('hide');
	stop_button_ref.classList.toggle('hide');
});

var full_screen_button_ref = document.querySelector('.video-buts .full-screen');
// var open_full_screen_ref = document.querySelector('.video-buts .open-full-screen');
// var close_full_screen_ref = document.querySelector('.video-buts .close-full-screen');

full_screen_button_ref.addEventListener('click', function(){
	this.classList.toggle('active');
	if(this.classList.contains('active'))
	{
		openFullscreen();
	}
	else
	{
		closeFullscreen();
	}
});

// $(document).on('keyup', function(e) {
//   console.log(e.key);
//   if (e.key == "Escape" && full_screen_button_ref.classList.contains('active'))
//   {
//   	full_screen_button_ref.classList.remove('active');
//   }
// });

document.addEventListener('fullscreenchange', ChangeFullScreen);
document.addEventListener('mozfullscreenchange', ChangeFullScreen);
document.addEventListener('MSFullscreenChange', ChangeFullScreen);
document.addEventListener('webkitfullscreenchange', ChangeFullScreen);
var time_wheel = document.querySelector('.polzunok-container-time .ui-slider .ui-slider-handle');
var video_box = document.querySelector('.play-video .video-box');
var counter = 0;

function ChangeFullScreen()
{
	counter++;
	if (full_screen_button_ref.classList.contains('active') && (counter%2 == 0))
	{
		full_screen_button_ref.classList.remove('active');
	}
	time_wheel.classList.toggle('hide');
	//video_box.classList.toggle('full-screen-mob');
	video_box.classList.toggle('no-padding');
}

function openFullscreen() 
{
  if (video_box.requestFullscreen) 
  {
    video_box.requestFullscreen();
  }
  else if (video.mozRequestFullScreen) 
  { /* Firefox */
    video.mozRequestFullScreen();
  } 
  else if (video.webkitRequestFullscreen) 
  { /* Chrome, Safari and Opera */
    video.webkitRequestFullscreen();
  } 
  else if (video.msRequestFullscreen) 
  { /* IE/Edge */
    video.msRequestFullscreen();
  }
}

function closeFullscreen()
{
	if (document.exitFullscreen)
	{
		document.exitFullscreen();
	} 
	else if (document.webkitExitFullscreen) 
	{
		document.webkitExitFullscreen();
	} 
	else if (document.mozCancelFullScreen) 
	{
		document.mozCancelFullScreen();
	} 
	else if (document.msExitFullscreen) 
	{
		document.msExitFullscreen();
	}
}

/**progress**/
video.ontimeupdate = progressUpdate;
video.addEventListener('loadedmetadata', function() {
	let date = new Date(null);
	date.setSeconds(video.duration);
    all_video_time_ref.innerHTML = date.toISOString().slice(14, 19);
    video.volume = 0.5;
    // console.log(date.toISOString());
});

function progressUpdate()
{
	let all_time = video.duration;
	let cur_time = video.currentTime;
	let percent = cur_time/all_time*100;
	//console.log(percent);
	$(".polzunok-time").slider("value",percent);

	let date = new Date(null);
	date.setSeconds(cur_time);
	current_time_ref.innerHTML = date.toISOString().slice(14, 19);
}

/**progress**/
/*******видео******/


/*******Отправка комментариев к видео***********/
var comm_input = document.querySelector('.play-video #comment-video-input');
var send_arrow = document.querySelector('.play-video .comment-arrow');
var num_comms = document.querySelector('.play-video #number-of-comments');
var all_comms = document.querySelectorAll('.play-video .commentary-item-wraper');
var comm_line = document.querySelectorAll('.play-video .comments-line');
var mobile_send_button = document.querySelector(".play-video #send-comment");
num_comms.innerHTML = all_comms.length + ' комментари' + Return_Ending(all_comms.length,'й','я','ев');

send_arrow.addEventListener('click', Send_Wrapper);
mobile_send_button.addEventListener('click', Send_Wrapper);

function Send_Wrapper()
{
	var text = (comm_input.value).trim();
	if (text != '')
	{
		var id_video = this.dataset.idvideo;
		var id_user = this.dataset.iduser;
		Send_Comment_Ajax(text,id_video,id_user);
	}
}

var insert_here = document.querySelector('.play-video .commentary-box');

function Send_Comment_Ajax(text,id_video,id_user)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Запись комментария',
			'text': text,
			'id_video': id_video,
			'id_user': id_user
		},
		dataType: "json",
		success: function(data){
			if (data.status == true)
			{
				let comment = '';
				if(data.ava == 'no-ava')
				{
					comment = `
						<div class="commentary-item">
							<div class="user-ava ava-box">
								<span class="first-latter">${data.name[0]}</span>
							</div>

							<div class="commentary-text-box">
								<div class="author-date">
									<span class="commentary-athor">${data.name}</span>
									<svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="2" cy="2" r="2" fill="#7F8692"></circle>
									</svg>
									<span class="commentary-date">${data.date}</span>
								</div>

								<div class="commentary-text">
									${text}
								</div>
							</div>
						</div>
					`;
				}
				else
				{
					comment = `
						<div class="commentary-item">
							<div class="user-ava ava-box">
								<img src="${data.ava}">
							</div>

							<div class="commentary-text-box">
								<div class="author-date">
									<span class="commentary-athor">${data.name}</span>
									<svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="2" cy="2" r="2" fill="#7F8692"></circle>
									</svg>
									<span class="commentary-date">${data.date}</span>
								</div>

								<div class="commentary-text">
									${text}
								</div>
							</div>
						</div>
					`;
				}

				//var comment_pars = new DOMParser().parseFromString(comment, "text/xml");
				var wrapper= document.createElement('div');
				wrapper.innerHTML=comment;
				insert_here.insertBefore(wrapper, insert_here.firstElementChild);
				//insert_here.appendChild(wrapper);
				comm_input.value = '';
				let new_value = parseInt(num_comms.innerHTML) + 1;
				num_comms.innerHTML = new_value + ' комментари' + Return_Ending(new_value,'й','я','ев');
				comm_line.classList.remove('hide');
			}
		}
	});
}



/*******Отправка комментариев к видео***********/



/*********Обработчик опций к видео***************/
Appearance_Optional_Box('.play-video .similar-item');

Add_Favorites('.option-item.add-favorites');
Add_Favorites('.play-video .fav-butt');

Add_Watch_Later('.option-item.watch-later');

Add_History('.play-video .poster-box');

/*********Обработчик опций к видео***************/ 

/*********************** Попап поделиться ***********************/
var elements = document.querySelectorAll('.play-video .similar-item');
var ref_text = document.querySelector("#ref-text");
Insert_Reffs_To_Popup(elements, ref_text);

var butts_share = document.querySelectorAll('.share-butts');
Insert_Button_Reffs_To_Popup(butts_share, ref_text);
/*********************** Попап поделиться ***********************/



/****************Попап вопросы****************/
$('[data-src="#quest-popup"]').fancybox({
    afterLoad : function(){
    		$("#quest-popup").removeClass('fadeOutDown animated');
            $("#quest-popup").addClass('fadeInUp animated');
        },
    beforeClose : function(){
    		$("#quest-popup").removeClass('fadeInUp animated');
            $("#quest-popup").addClass('fadeOutDown animated');
        }
	});

$("#pop-up-phone").mask("+7(999) 999-9999");


var send_quest_butt = document.querySelector("#send-pop-up-quest");
var check_auth_inp_val = document.querySelector('#check-auth-inp').value;
var error_send_quest = document.querySelector('#quest-popup .form-error');

var quest_mail = document.querySelector('#quest-popup #pop-up-mail');
var quest_phone = document.querySelector('#quest-popup #pop-up-phone');
var quest_mess = document.querySelector('#quest-popup #pop-up-mess');

send_quest_butt.addEventListener('click', Send_Quest)

async function Send_Quest(event)
{
	event.preventDefault();
	if(check_auth_inp_val == 0)//не авторизованный
	{
		var mass = ['#quest-popup #pop-up-mail','#quest-popup #pop-up-mess'];
		var err = await Validate_Forms(mass, 'pop-up-mail', '', '', '', '', '');
	}
	else//авторизованный
	{
		var mass = ['#quest-popup #pop-up-mess'];
		var err = await Validate_Forms(mass, '', '', '', '', '', '');
	}
	var bool = Interpreta_Validate(err,error_send_quest);
	if(bool)
	{
		Send_Quest_Ajax(quest_mail.value, quest_phone.value, quest_mess.value);
	}
}


var form_inps = document.querySelectorAll('#quest-popup .cleare')
function Cleare_Input(inputs_reff)
{
	for (let item of form_inps)
	{
		item.value = '';
	}
}

function Send_Quest_Ajax(mail, phone, mess)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Отправка вопроса на почту',
			'mail': mail,
			'phone': phone,
			'mess': mess
		},
		dataType: "json",
		success: function(data){
			if (data.status == true)
			{
				Cleare_Input(form_inps);
				document.querySelector("#quest-popup .fancybox-close-small").click();
			}
		}
	});
}
/****************Попап вопросы****************/

var go_to_ofice = document.querySelectorAll(".play-video .reff-top");

for(let item of go_to_ofice)
{
	item.addEventListener('click', function(){
		window.scrollTo({top: 0, behavior: 'smooth'});
	});
}



