/***********************Главная страница*************************/
/*********Слайдеры************/
First_Sliders_Init();

window.addEventListener('resize', function(){
	First_Sliders_Init();
});

function First_Sliders_Init()
{
	if(screen.width < 750)
	{
		Moble_Sliders_Init();
	}
	else
	{
		Desctop_Sliders_Init();
	}
}

function Moble_Sliders_Init()
{
	$('.top-video-slider').slick({
		dots: false,
		infinite: true,
		slidesToShow: 1,
		  // centerMode: true,
		  variableWidth: true
		});

	$('.recommend-slider').slick({
		dots: true,
		infinite: true,
		slidesToShow: 1,
			// centerMode: true,
		  	// variableWidth: true
		  });
}

function Desctop_Sliders_Init()
{
	var slides = document.querySelectorAll('.recommend .recommend-slide');

	if(slides.length > 3)
	{
		$('.recommend-slider').slick({
			dots: false,
			infinite: false,
			slidesToShow: 3,
			slidesToScroll: 1,
			prevArrow: '<div class="prev-photo"><svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.999999L2 9L10 17" stroke="white" stroke-width="1.6" stroke-linecap="round"/></svg></div>',
			nextArrow: '<div class="next-photo"><svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 17L9 9L1 0.999999" stroke="white" stroke-width="1.6" stroke-linecap="round"/></svg></div>'
		});
	}
}

/*********Слайдеры************/

/*********************** Попап поделиться ***********************/
var elements = document.querySelectorAll('.video-item');
var ref_text = document.querySelector("#ref-text");
Insert_Reffs_To_Popup(elements, ref_text);
/*********************** Попап поделиться ***********************/

/*********Обработчик опций к видео***************/
Appearance_Optional_Box('div.video-item');

Add_Favorites('.option-item.add-favorites');
Add_Watch_Later('.option-item.watch-later');

Add_History('.video-item .video-box');

/*********Обработчик опций к видео***************/ 