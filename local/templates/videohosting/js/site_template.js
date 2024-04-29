var auth_user_id = document.querySelector('#this-user-id').innerHTML;

 /**Блок высоты меню***/
 var menu = document.querySelector('header .menu');
 var $w = $(window);

//высота окна с учётом скрола
var scrollHeight = Math.max(
			document.body.scrollHeight, document.documentElement.scrollHeight,
			document.body.offsetHeight, document.documentElement.offsetHeight,
			document.body.clientHeight, document.documentElement.clientHeight
			);

setTimeout(function() {
		Calc_Menu_Height();
}, 500);

function checkStrIsTag(str)
{
	return Array.from(str)[0] === '#';
}

function Calc_Menu_Height()
{
	if(screen.width < 750)
	{
		var delta = 57;
	}
	else
	{
		var delta = 65;
	}

	scrollHeight = Math.max(
			document.body.scrollHeight, document.documentElement.scrollHeight,
			document.body.offsetHeight, document.documentElement.offsetHeight,
			document.body.clientHeight, document.documentElement.clientHeight
			) - delta; 

	window.addEventListener('scroll', function(){
		menu.style.minHeight = scrollHeight + 'px';

		if($w.scrollTop() == 0)
		{
			menu.style.minHeight = '';
		}

	}); 
}
/**Блок высоты меню***/

/*Появление меню*/
var menu_box = document.querySelector("header .menu-box");
var catalog_nav_button = document.querySelector("#catalog_nav_btn");
catalog_nav_button.addEventListener('click', function() {
	menu_box.classList.toggle('active');
	Calc_Menu_Height();
	Click_To_Shade();
});
/*Появление меню*/

if(screen.width > 1000)
{
	var main_wraper = document.querySelector(".main-wraper");
	catalog_nav_button.addEventListener('click', function() {
		menu.classList.toggle('no-active');
		main_wraper.classList.toggle('margin-left-wrap');
	});
}

function Click_To_Shade()
{
	document.onclick = function (e) {
		if (e.target.className == "menu-shade")
		{
			menu_box.classList.remove('active');
		}
	};
}

/*Появление всех категорий оборудования меню*/

function Show_More_Items(more_catalog_title, more_catalog_arrow, name, hide_box)
{
	more_catalog_arrow.classList.toggle('active');

	if(more_catalog_arrow.classList.contains('active'))
	{
		more_catalog_title.innerHTML = 'Скрыть';
	}
	else
	{
		more_catalog_title.innerHTML = name;
	}
	$(hide_box).slideToggle(300);
}

var hide_box = document.querySelector('header .catalog-menu-hide');
var more_catalog_title = document.querySelector("header #more-catalog span");
var more_catalog_arrow = document.querySelector("header #more-catalog svg");
document.querySelector("#more-catalog").addEventListener('click', () => 
	Show_More_Items(more_catalog_title, more_catalog_arrow, 'Все категории', hide_box));


var hide_boxx = document.querySelector('header .teg-menu-hide');
var more_catalog_titlee = document.querySelector("header #more-tags span");
var more_catalog_arroww = document.querySelector("header #more-tags svg");
document.querySelector("#more-tags").addEventListener('click', () => 
	Show_More_Items(more_catalog_titlee, more_catalog_arroww, 'Все теги', hide_boxx));


/*Появление всех категорий оборудования меню*/

/**************Попап на регистрацию**************/
function Show_Hide_Something(button_selector, box_selector, hide_class_name)
{
	var box = document.querySelector(box_selector);
	var button = document.querySelector(button_selector);
	button.addEventListener('click', function() {
		box.classList.toggle(hide_class_name);
		Click_Out_Something(box, 'hide', 'mark-class');
	});
}

var form_box_ref = document.querySelector("header .form-box");

First_Come_In_Box_Init();

window.addEventListener('resize', function(){
	First_Come_In_Box_Init();
});

function First_Come_In_Box_Init()
{
	if(screen.width < 750)
	{
		form_box_ref.classList.add('position-fixed-mobile-window');
	}
	else
	{
		form_box_ref.classList.remove('position-fixed-mobile-window');
	}
}

Show_Hide_Something(".private-office .about-registr", ".private-office .about-registr-box", "hide");

/**************Попап на регистрацию**************/

/*********Мобильный поиск лупа**********/
var head_search = document.querySelector('header .head-search');
document.querySelector('header .mobile-loopa').addEventListener('click', function() {
	head_search.classList.add('active');
});

document.querySelector('header .mobile-search-arrow').addEventListener('click', function() {
	head_search.classList.remove('active');
});

/*********Мобильный поиск лупа**********/

/********поисковая строка*****************/
var max_num_words = 100; //максимальное количество слов в поисковом окне
var number_letters = 3;//ели количество букв в инпуте больше этого числа, то будет поиск в БД
var go_cleare_box = document.querySelector("header .go-to-box");
var head_search_input = document.querySelector("#head-search");
var head_search_cross = document.querySelector("#head-search-cross");
var head_search_vars = document.querySelector("header .head-search-vars");

head_search_input.addEventListener('input', Control_Search_Input);

var head_search_form = document.querySelector("header .head-search");
var head_search_arrow = document.querySelector("#head-search-arrow");
head_search_arrow.addEventListener('click', function(){
	head_search_form.submit();
});

function Control_Search_Input()  
{
	var str = head_search_input.value.trim();
	var num_lett = str.length;

	if(num_lett != 0)
	{
		go_cleare_box.classList.add('show_flex');
	}
	
	if(num_lett == 0)
	{
		go_cleare_box.classList.remove('show_flex');
	}

	if(num_lett > number_letters || checkStrIsTag(str))
	{
		Serch_Products(str);
	}

	if(num_lett <= number_letters)
	{
		head_search_vars.classList.add('hide');
	}
}

function Serch_Products(product_name)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Поиск товаров в базе',
			'product_name': product_name
		},
		dataType: "json",
		success: function(data){
			if (data.status == true)
			{
				let counter = 0;
				let tegs = '';
				for(let item of data.tags)
				{
					counter++;
					if(counter > max_num_words)
					{
						break;
					}
					tegs = tegs + `
						<div class="head-search-vars-item">${item.NAME}</div>
					`;
				}
				for(let item of data.videos)
				{
					counter++;
					if(counter > max_num_words)
					{
						break;
					}
					tegs = tegs + `
						<div class="head-search-vars-item">${item.NAME}</div>
					`;
				}
				head_search_vars.innerHTML = tegs;
				head_search_vars.classList.remove('hide');
				var head_search_vars_items = document.querySelectorAll("header .head-search-vars .head-search-vars-item");
				Fill_Input(head_search_vars_items, head_search_input);
				Click_Out_Something(head_search_vars, 'hide', 'mark-class');
			}
		}
	});
}

head_search_input.addEventListener('focus', function(){
	if(this.value.length > number_letters || checkStrIsTag(this.value))
	{
		go_cleare_box.classList.add('show_flex');
		Serch_Products(this.value);
	}
});

head_search_cross.addEventListener('click', function(){
	head_search_input.value = '';
	go_cleare_box.classList.remove('show_flex');
	head_search_vars.classList.add('hide');
});

function Fill_Input(vars_reff, input_reff)
{
	for(let item of vars_reff)
	{
		item.addEventListener('click', function(){
			input_reff.value = item.innerHTML;
			head_search_vars.classList.remove('show');

			input_reff?.form.submit();
		});
	}
}

/********поисковая строка*****************/


/***********логика личного кабинета*************/
var form_box = document.querySelector("header .form-box");
var come_in_form_email_ref = document.querySelector("header #come-in-form-email");
var come_in_form_passw_ref = document.querySelector("header #come-in-form-password");
var error_come_in_form_ref = document.querySelector("header .come-in-form .form-error");

var form_windows = document.querySelectorAll("header .form-window");
var go_to_office_button = document.querySelector("header #go-to-office");
var go_to_avatar_button = document.querySelector("header #user-ofice");
var registr_buttons = document.querySelectorAll("header .registr-button");
var registr_window = document.querySelector("header .register-form");
var comein_buttons = document.querySelectorAll("header .come-in-buttons");
var remember_pass_buttons = document.querySelectorAll("header .remember-passw");
var remember_password_window = document.querySelector("header .remember-password");
var mobile_shade = document.querySelector("header .mobile-shade");
var body_ref = document.querySelector("body");

mobile_shade.addEventListener('click', Close_Mobile_Forms);
document.querySelector('header #close-form-cross').addEventListener('click', Close_Mobile_Forms);

function Close_Mobile_Forms()
{
	body_ref.classList.remove('overflow-hidden');
	form_box.classList.add('hide');
	setTimeout(function() {
		$(mobile_shade).slideToggle(300);
	}, 100);
}

$("#registr-phone").mask("+7(999) 999-9999");


var come_in_form_win = document.querySelector("header .come-in-form");
var profile_menu_win = document.querySelector("header .menu-form-author");

var mobile_shade_heigh = scrollHeight - 40; 
mobile_shade.style.height = mobile_shade_heigh + 'px';

go_to_office_button.addEventListener('click',() => Hide_Show_Personal_Area(come_in_form_win));
go_to_avatar_button.addEventListener('click',() =>  Hide_Show_Personal_Area(profile_menu_win));


function Hide_Show_Personal_Area(main_window_ref)
{
	Close_All_Comin_Window();
	main_window_ref.classList.remove('hide');
	if(screen.width < 750)
	{
		body_ref.classList.toggle('overflow-hidden');
		if(form_box.classList.contains('hide'))
		{
			$(mobile_shade).slideToggle(300);

			 setTimeout(function() {
					form_box.classList.toggle('hide');
			 }, 400);
		}
		else
		{
			form_box.classList.toggle('hide');
			 setTimeout(function() {
					$(mobile_shade).slideToggle(300);
			 }, 100);
		}	 
	}
	else
	{
		form_box.classList.toggle('hide');
	}
	Click_Out_Something(form_box, 'hide', 'mark-class');
}

Switch_Windows(registr_buttons, registr_window);
Switch_Windows(comein_buttons, come_in_form_win);
Switch_Windows(remember_pass_buttons, remember_password_window);

// function Copy_To_Bitrix_Input(my_input_ref, bitrix_input_selector)
// {
// 	my_input_ref.addEventListener('input', function(){
// 		document.querySelector(bitrix_input_selector).value = this.value;
// 	});

// 	my_input_ref.addEventListener('focus', function(){
// 		document.querySelector(bitrix_input_selector).value = this.value;
// 	});
// }

var come_in_buts = document.querySelectorAll('#bitrix-auth-form .come-in-button-form');
for(let item of come_in_buts)
{
	item.addEventListener('click', Come_In);
}

async function Come_In(event)
{
	var mass = ['header #come-in-form-email','header #come-in-form-password'];
	var err = await Validate_Forms(mass, 'come-in-form-email', '', '', '', '', '');

	var bool = Interpreta_Validate(err,error_come_in_form_ref);
	
	if(!bool)
	{
		event.preventDefault();
	}
	else
	{
		Validate_Email_Password();
	}
}

function Validate_Email_Password()
{
	BX.addCustomEvent('onAjaxSuccess', function() 
	{
		var log_out_butt = document.querySelectorAll('#bitrix-auth-form [name="logout_butt"]');

		var error_come_in_form_ref = document.querySelector("header .come-in-form .form-error");
		var come_in_form_email_ref = document.querySelector("header #come-in-form-email");
		var come_in_form_passw_ref = document.querySelector("header #come-in-form-password");

		if(log_out_butt.length == 0)
		{
			error_come_in_form_ref.classList.remove('hide');
			error_come_in_form_ref.innerHTML = 'Не правильный логин или пароль';
			come_in_form_email_ref.classList.add('error');
			come_in_form_passw_ref.classList.add('error');
		}
		else
		{
			form_box_ref.classList.add('hide');
			location.reload();
		}
	});
}

/*******регистрация**********/
var natural_person = document.querySelector("header #natural-person");
var entity = document.querySelector("header #entity");
var company_inn = document.querySelector("header #company-inn");
var registr_phone = document.querySelector("header #registr-phone");

natural_person.addEventListener('click', function(){
	this.classList.add('active');
	entity.classList.remove('active');
	company_inn.classList.add('hide');
	registr_phone.placeholder = 'Телефон (по желанию)';
});

entity.addEventListener('click', function(){
	this.classList.add('active');
	natural_person.classList.remove('active');
	company_inn.classList.remove('hide');
	registr_phone.placeholder = 'Телефон';
});


document.querySelector('header #header-registr').addEventListener('click', function(){
	Close_All_Comin_Window();
	registr_window.classList.remove('hide');
	form_box.classList.remove('hide');

	setTimeout(function() {
		Click_Out_Something(form_box, 'hide', 'mark-class');
	}, 100);
});

var error_register_form_ref = document.querySelector('.register-form .form-error');

if(document.querySelectorAll("#register").length != 0)
{
	document.querySelector("#register").addEventListener('click', Registration);
}

var login_ref = document.querySelector('.register-form #this-login');
var repeat_passw_ref = document.querySelector('.register-form #confirm-pass');
var name_ref = document.querySelector('.register-form #register-form-name');
var register_passw_ref = document.querySelector('.register-form #register-form-pass');


async function Registration(event)
{
	if(natural_person.classList.contains('active'))
	{
		//console.log('физлицо');  
		var mass = ['header #register-form-mail',
					'header #register-form-pass',
					'header #register-form-name'
					];
		var err = await Validate_Forms(mass, 'register-form-mail', 'register-form-pass', '', '', '', '');
	}

	if(entity.classList.contains('active'))
	{
		//console.log('юрлицо');
		var mass = ['header #register-form-mail',
		'header #register-form-pass',
		'header #registr-phone',
		'header #company-inn',
		'header #register-form-name'
		];
		var err = await Validate_Forms(mass, 'register-form-mail', 'register-form-pass', 'company-inn', '', '', '');
	}

	// console.log('ошибки');
	// console.log(err);

	var bool = Interpreta_Validate(err,error_register_form_ref);

	let date = new Date();
	var login_unique = name_ref.value + date.getTime();//для уникальности логина
	login_ref.value = login_unique;
	repeat_passw_ref.value = register_passw_ref.value;

	if(!bool)
	{
		event.preventDefault();
	}
	else
	{
		if(entity.classList.contains('active'))
		{
			BX.addCustomEvent('onAjaxSuccess', function() 
			{
				Add_User_To_Diller_Group(login_unique); 
			});
		}

		if(natural_person.classList.contains('active'))
		{
			BX.addCustomEvent('onAjaxSuccess', function() 
			{
				Add_User_To_Retail_Group(login_unique);
			});
		}

		form_box.classList.add('hide');

		setTimeout(function() {
				location.reload();
		 }, 500);	
	}
}

function Add_User_To_Diller_Group(login)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Добавление пользователя в группу диллеров',
			'inn': company_inn.value,
			'login': login
		},
		dataType: "json",
		success: function(data){
			if (data.status == true)
			{
				//console.log('добавили ИНН');
			}
		}
	});
}

function Add_User_To_Retail_Group(login)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Добавление пользователя в группу клиенты розница',
			'login': login
		},
		dataType: "json",
		success: function(data){
			if (data.status == true)
			{
				
			}
		}
	});
}

/*******регистрация**********/

/******Вспомнить пароль***********/
var error_password_form_ref = document.querySelector('.remember-password .form-error');
document.querySelector("#send_pass").addEventListener('click', Remember_Password);
var send_password_window = document.querySelector('header .send-password-window');
var email_input = document.querySelector('header #email-remember-password');

async function Remember_Password()
{
	event.preventDefault();

	var mass = ['header #email-remember-password'];
	var err = await Validate_Forms(mass, 'email-remember-password', '', '', '', '', '');
	var bool = Interpreta_Validate(err,error_password_form_ref);

	if(bool)
	{
		Remember_Passw(email_input.value);
	}
}

function Remember_Passw(mail)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Вспомнить пароль',
			'mail': mail
		},
		dataType: "json",
		success: function(data){

			if (data.status == true)
			{
				Clear_Form(remember_password_window, error_password_form_ref);
				remember_password_window.classList.add('hide');
				send_password_window.classList.remove('hide');
				error_password_form_ref.classList.add('hide');
			}
			else
			{
				error_password_form_ref.classList.remove('hide');
				error_password_form_ref.innerHTML = 'Такой почты нет в базе данных';
			}
		}
	});
}

/******Вспомнить пароль***********/

function Clear_Form(form_ref, form_error_ref)
{
	var inputs = form_ref.querySelectorAll('input');
	for(let item of inputs)
	{
		item.value = '';
	}
	form_error_ref.classList.add('hide');
}

function Switch_Windows(buttons_refs, window_ref)
{
	for(let item of buttons_refs)
	{
		item.addEventListener('click', function(){
			Close_All_Comin_Window();
			window_ref.classList.remove('hide');
		});
	}
}

// function Check_Password_Db(password)//если есть пароль в базе данных, то возвращает true
// {
// 	var bool;

// 	$.ajax({
// 		type: "POST",
// 		url: '/ajax/common.php',
// 		data: {
// 			'delimiter': 'Проверка пароля в базе',
// 			'password' : password
// 		},
// 		dataType: "json",
// 		success: function(data){

// 			if (data.status == true)
// 			{
// 				// console.log('есть');
// 				bool = true;
// 			}
// 			else
// 			{
// 				// console.log('нет');
// 				bool = false;
// 			}
// 		}
// 	});

// 	return bool;
// }

async function Validate_Forms(arr, email_id, passw_id, inn_id, old_password_id, repeat_password_id, file_ava_id)
{
	var err= [0,0]; //1-количество ошибок, 2 - код ошибки (-1==email, ... )
	var pattern_mail = /\S+@\S+\.\S+/;//для почты
	var pattern_passw = /(?=^.{6,}$)(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[^A-Za-z0-9]).*/;//для пароля

	for (let item of arr)
	{
		let inp_value = $(item).val();
		let main_bool = (inp_value == '');
		let inp_id = $(item).attr("id");

		if(inp_id == email_id)
		{
			if(main_bool)
			{
				bool = main_bool;
			}
			else
			{	
				bool = (!pattern_mail.test(inp_value));

				if(bool)
				{
					err[1] = -1;//код ошибки почта, не верный формат
				} 
				// else 
				// {
				// 	let responsee = await $.ajax({
				// 			type: "POST",
				// 			url: '/ajax/common.php',
				// 			data: {
				// 				'delimiter': 'Проверка почты на уникальность',
				// 				'mail' : inp_value
				// 			},
				// 			dataType: "json",
				// 			success: function(data){
				// 			}
				// 	});

				// 	console.log(777);
				// 	console.log(responsee.status);

				// 	if(responsee.status)
				// 	{
				// 		bool = responsee.status;
				// 		err[1] = -11;//код ошибки почта, уже есть такая 
				// 	} 
				// }
			}
		}
		else if(inp_id == passw_id)
		{
			if(main_bool)
			{
				bool = main_bool;
			}
			else
			{
				bool = (!pattern_passw.test(inp_value));
				if(bool)
				{
					err[1] = -2;//код ошибки пароля
				}
				// else
				// {
				// 	err[1] = 0;
				// }
			}
		}
		else if(inp_id == inn_id)
		{
			if(main_bool)
			{
				bool = main_bool;
			}
			else
			{
				bool = (inp_value.length != 10);
				if(bool)
				{
					err[1] = -3;//код ошибки инн
				}
				// else
				// {
				// 	err[1] = 0;
				// }
			}
		}
		else if(inp_id == old_password_id)
		{
			if(main_bool)
			{
				bool = main_bool;
			}
			else
			{
				let response = await $.ajax({
					type: "POST",
					url: '/ajax/common.php',
					data: {
						'delimiter': 'Проверка пароля в базе',
						'password' : inp_value
					},
					dataType: "json",
					success: function(data){

						if (data.status == true)
						{
							// console.log('есть');
							bool = false;
						}
						else
						{
							// console.log('нет');
							bool = true;
						}
					}
				});
				
				if(bool)
				{
					err[1] = -4;//код ошибки проверка пароля в базе
				}
			}
		}
		else if(inp_id == repeat_password_id)
		{
			if(main_bool)
			{
				bool = main_bool;
			}
			else
			{
				let first_input_value = document.querySelector('header #' + passw_id).value;
				bool = (inp_value != first_input_value);
				if(bool)
				{
					err[1] = -5;//код ошибки подтверждение пароля
				}
				// else
				// {
				// 	err[1] = 0;
				// }
			}
		}
		else if(inp_id == file_ava_id)
		{
			// console.log(777);
			var inp_files_ref = document.querySelector('#'+file_ava_id);
			if(inp_files_ref.files.length == 0)
			{
				continue;
			}
			else
			{
				var [file] = inp_files_ref.files;
				let max_img_size = 20*1048576;//в байтах
				bool = (file.size > max_img_size) || ((file.type).indexOf('image') == -1);
				if(bool)
				{
					err[1] = -6;//код ошибки подтверждение пароля
				}
				// else
				// {
				// 	err[1] = 0;
				// }
			}
		}
		else 
		{
			bool = main_bool;
		}

		if (bool)
		{
			err[0]++;
			$(item).addClass("error");
		} 
		else 
		{
			$(item).removeClass("error");
		}
	}

	return err;
}

function Interpreta_Validate(err_mass,err_ref)
{
	if(err_mass[1] == -1)
	{
		err_ref.classList.remove('hide');
		err_ref.innerHTML = 'Заполните почту корректно';
		return false;
	}
	else if(err_mass[1] == -11)
	{
		err_ref.classList.remove('hide');
		err_ref.innerHTML = 'Такая почта уже есть в базе данных, введите другую';
		return false;
	}
	else if(err_mass[1] == -2)
	{
		err_ref.classList.remove('hide');
		err_ref.innerHTML = 'Пароль должен состоять минимум из 6 символов,'+ 
							'содержать цифру,'+ 
							'содержать заглавную и строчную буквы английского алфавита,'+
							'содержать cимвол, не являющийся буквенно-цифровым';
		return false;
	}
	else if(err_mass[1] == -3)
	{
		err_ref.classList.remove('hide');
		err_ref.innerHTML = 'ИНН должен состоять из 10 цифр';
		return false;
	}
	else if(err_mass[1] == -4)
	{
		err_ref.classList.remove('hide');
		err_ref.innerHTML = 'Ввели не правильный старый пароль';
		return false;
	}
	else if(err_mass[1] == -5)
	{
		err_ref.classList.remove('hide');
		err_ref.innerHTML = 'Не правильно подтвердили пароль';
		return false;
	}
	else if(err_mass[1] == -6)
	{
		err_ref.classList.remove('hide');
		err_ref.innerHTML = 'Размер файла должен быть меньше 20 мб и он должен быть в формате изображения';
		return false;
	}
	else if(err_mass[0] > 0)
	{
		err_ref.classList.remove('hide');
		err_ref.innerHTML = 'Заполните все поля';
		return false;
	}
	else if(err_mass[0] == 0 && err_mass[1] == 0)
	{
		err_ref.classList.add('hide');
		return true;
	}
}

function Close_All_Comin_Window()
{
	for(let win of form_windows)
	{
		win.classList.add('hide');
	}
}

/***********логика личного кабинета*************/

/*************для авторизованого пользователя*************/
var change_name_ava_button = document.querySelectorAll("header .change-name-ava");
var change_name_ava_form = document.querySelector("header .change-name-ava-form");
var go_to_menu_auth_buttons = document.querySelectorAll("header .go-to-menu-auth");
var change_password_buttons = document.querySelectorAll("header .change-password-menu");
var change_password_form = document.querySelector('header .change-password-form');

Switch_Windows(change_name_ava_button, change_name_ava_form);
Switch_Windows(go_to_menu_auth_buttons, profile_menu_win);
Switch_Windows(change_password_buttons, change_password_form);

var error_name_ava_form_ref = document.querySelector('header .change-name-ava-form .form-error');


document.querySelector('header #change-ava-name').addEventListener('click', Change_Ava_Name);

async function Change_Ava_Name(event)
{
	event.preventDefault();
	var mass = ['header #change-name', 'header #file-input-ava'];
	var err = await Validate_Forms(mass, '', '', '', '', '', 'file-input-ava');
	var bool = Interpreta_Validate(err,error_name_ava_form_ref);
	
	if(bool)
	{
		Change_Ava_Name_Ajax();
	}
}

var name_change_ava_form = document.querySelector('header #change-name');
var user_name = document.querySelector('header .user-name');

function Change_Ava_Name_Ajax()
{
	var formData = new FormData(change_name_ava_form);
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		// data: {
		// 	'delimiter': 'Смена имени и аватара',
		// 	'user_id' : user_id,
		// 	'new_name': name_change_ava_form.value,
		// 	'ava_img' : file_ava_input.value
		// },
		data: formData,
        processData: false,
        contentType: false,
		dataType: "json",
		success: function(data){

			if (data.status == true)
			{
				// user_name.innerHTML = name_change_ava_form.value;
				Clear_Form(change_name_ava_form, error_name_ava_form_ref);
				form_box.classList.add('hide');
				location.reload();
				//console.log(data);
			}
		}
	});
}


document.querySelector('header #change-password-button').addEventListener('click', Change_Password);

var error_change_pass_form_ref = document.querySelector('header .change-password-form .form-error');
var new_password_ref = document.querySelector('header #new-password');

async function Change_Password(event)
{
	event.preventDefault();

	var mass = ['header #old-password',
				'header #new-password',
				'header #repeat-password'
	];

	var err = await Validate_Forms(mass, '', 'new-password', '', 'old-password', 'repeat-password', '');

	//console.log(err);

	var bool = Interpreta_Validate(err, error_change_pass_form_ref);
	
	if(bool)
	{
		Change_Password_Ajax(new_password_ref.value);
	}
}

function Change_Password_Ajax(new_password)
{
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Изменение пароля',
			'new_password' : new_password
		},
		dataType: "json",
		success: function(data){

			if (data.status == true)
			{
				Clear_Form(change_password_form, error_change_pass_form_ref);
				form_box.classList.add('hide');
			}
		}
	});
}

document.querySelector('header #load-ava').addEventListener('click', Load_Ava);
var file_ava_input = document.querySelector('header #file-input-ava');
var name_first_latter = document.querySelector('header .first-latter.change-form');
var ava_img = document.querySelector('header .ava-img-option.change-form');

function Load_Ava(event)
{
	event.preventDefault();
	file_ava_input.click();

	file_ava_input.onchange = evt => {
		const [file] = file_ava_input.files;
		if (file) 
		{
		  name_first_latter.classList.add('hide');
		  ava_img.src = URL.createObjectURL(file);
		  ava_img.classList.remove('hide');
		}
	}
}

/**выход из сессии**/
document.querySelector('header #log-out-profile').addEventListener('click', function(){
	$.ajax({
		type: "POST",
		url: '/ajax/common.php',
		data: {
			'delimiter': 'Выход из профиля',
		},
		dataType: "json",
		success: function(data){

			if (data.status == true)
			{
				location.reload();
			}
		}
	});
});
/**выход из сессии**/

/*************для авторизованого пользователя*************/


/*********************** Попап поделиться ***********************/

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


/***********копирование в буфер обмена**********/
document.getElementById("copy-video-ref").onclick = function() {
    var text = document.getElementById("ref-text").value;
    copyTextToClipboard(text);
}

async function copyTextToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        console.log('Text copied to clipboard');
    } catch (err) {
        console.error('Error in copying text: ', err);
    }
}
/***********копирование в буфер обмена**********/

/*********************** Попап поделиться ***********************/

/***Каталог, по тегам****/

var elements = document.querySelectorAll('header .catalog-title');
Switch(elements, 'active');

function Delete_All_Active_class(elements_reff, modify_class)
{
	for(let itemm of elements_reff)
	{
		itemm.classList.remove(modify_class);
	}
}

function Switch(elements_reff, modify_class)
{
	for(let item of elements_reff)
	{
	   item.addEventListener("click", function(){
	   		Delete_All_Active_class(elements_reff, modify_class);
		    item.classList.add(modify_class);
		});
	}
}

var catalog_button = document.querySelector('header #catalog-reff');
var tags_button = document.querySelector('header #tag-reff');
var catalog_box = document.querySelector('header .catigory-catalog');
var tags_box = document.querySelector('header .teg-catalog');

catalog_button.addEventListener('click', function(){
	tags_box.classList.add('hide');
	catalog_box.classList.remove('hide');
});

tags_button.addEventListener('click', function(){
	tags_box.classList.remove('hide');
	catalog_box.classList.add('hide');
});

/***Каталог, по тегам****/


/***Обработчик фильтр по тегам******/
// var tag = document.querySelector('header .hide.this-tag').innerHTML;

// function Input_Bitrix_Select(option_name,options_selector)
// {
// 	var bitrix_opts = document.querySelectorAll(options_selector);
// 	for(let option of bitrix_opts)
// 	{
// 		if(option.innerHTML == option_name)
// 		{
// 			option.selected = true;
// 		}
// 	}
// }

// if(tag != '')
// {
// 	Input_Bitrix_Select(tag,'[name="arrFilter_pf[TAG]"] option');
// 	document.querySelector('#set-this-filter').click();
// }
/***Обработчик фильтр по тегам******/ 






































