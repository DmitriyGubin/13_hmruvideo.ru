<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?php 
$menu = $GLOBALS['helper']->Return_All_Fields_Props(
	Array("IBLOCK_ID"=>15, "ACTIVE"=>"Y", "PROPERTY_SHOW_FOTER_VALUE" => "YES"),
	Array(),
	Array("sort"=>"asc"));
?>

</div> <!-- class="for_mobile_box" -->

<footer class="mobile-footer wrap" style="display: none;">
	<ul class="footer-menu">
		<?php foreach ($menu as $menu_item): ?>
			<?php
			$ref = $menu_item['props']['MENU_ITEM_REF']['VALUE'];
			if(strlen($ref) == 1 && $GLOBALS['helper']->Check_Main_Page())
			{
				$bool = true;
			}
			else
			{
				$bool = $GLOBALS['helper']->Check_Page(str_replace('/', '', $ref));
			}
			?>
			<li>
				<a class="menu-reff-footer <?= $bool? 'active' : null; ?>" href="<?= $ref; ?>">
					<?= $menu_item['props']['MENU_ITEM_ICON']['~VALUE']['TEXT']; ?>
					<?= $menu_item['props']['MENU_ITEM_NAME']['VALUE']; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</footer>

<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH.'/js/site_template.js' ?>"></script>

</body>
</html> 