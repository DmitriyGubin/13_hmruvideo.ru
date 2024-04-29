<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component  foreach ($arResult['SECTIONS'] as &$arSection)*/
$this->setFrameMode(true);

/**********Поправка для разных типов пользователей***********/ 
if($GLOBALS['user_type'] != 'ALL')
{
	$sec_name_url = [];
	foreach ($arResult['SECTIONS'] as $key => $item) 
	{
		$sec_name_url[$key]['NAME'] = $item['NAME'];
		$sec_name_url[$key]['URL'] = $item['SECTION_PAGE_URL'];
	}
	
	$arResult['SECTIONS'] = [];
	
	$parent_secs =  $GLOBALS['video'] -> Parent_Sections_For_Type_User();
	foreach ($parent_secs as $key => $sec_name) 
	{
		$arResult['SECTIONS'][$key]['NAME'] = $sec_name;
		foreach ($sec_name_url as $item) 
		{
			if($item['NAME'] == $sec_name)
			{
				$arResult['SECTIONS'][$key]['SECTION_PAGE_URL'] = $item['URL'];
				break;
			}
		}
	}

	//debug($parent_secs);
}
/**********Поправка для разных типов пользователей***********/


//debug($arResult['SECTIONS']);

$visible = 1;//количество видимых пунктов меню
$len = count($arResult['SECTIONS']);
?>

<div class="catigory-catalog">
<ul class="catalog-menu">
<?php for ($j = 0; $j <= $visible-1; $j++): ?>
	<li>
		<a class="menu-reff" href="<?= $arResult['SECTIONS'][$j]['SECTION_PAGE_URL']; ?>">
			<?= $arResult['SECTIONS'][$j]['NAME']; ?>
		</a>
	</li>
<?php endfor; ?>
</ul>


<?php $bool = isset($arResult['SECTIONS'][$visible]); ?>

<?php if($bool): ?>
	<ul class="catalog-menu-hide" style="display: none;">
		<?php for ($j = $visible; $j <= $len-1; $j++): ?>
			<li>
				<a class="menu-reff" href="<?= $arResult['SECTIONS'][$j]['SECTION_PAGE_URL']; ?>">
					<?= $arResult['SECTIONS'][$j]['NAME']; ?>
				</a>
			</li>
		<?php endfor; ?>
	</ul>
<?php endif; ?>

<div id="more-catalog" class="more-catalog-butt <?= $bool? null : 'hide'; ?>">
	<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M12.25 0.75L6.75 6.25L1.25 0.75" stroke="#004EA4" stroke-linecap="round"/>
	</svg>
	<span>Все категории</span>
</div>
</div>



