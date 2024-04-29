<div class="opts-box-video hide">
	<?php
		$later_ids = $GLOBALS['video'] -> Return_Id_Videos_Yes_No_Auth('watch_later', 'UF_WATCH_LATER');
		$bool = in_array($id_video, $later_ids);
	?>
	<div class="option-item watch-later <?= $bool?'hide':null; ?>" data-idvideo="<?= $id_video; ?>">
		<svg class="opt-box-svg" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M22.3741 8.33333C22.7794 9.48019 23 10.7143 23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C13.5656 1 15.0549 1.32709 16.4031 1.91667" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round"></path>
			<path d="M12 17V11.4538C12 11.1654 12.1245 10.8911 12.3415 10.7012L20 4" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round"></path>
		</svg>

		<p class="option-title">Смотреть позже</p>
	</div>

	<?php
		
		$ids_fav =  $GLOBALS['video'] -> Return_Id_Videos_Yes_No_Auth('my_favorites', 'UF_FAVORITES');
		//$bool = isset($sess_fav) and in_array($id_video, $sess_fav);
		$bool = in_array($id_video, $ids_fav);
	?>
	<div class="option-item add-favorites" data-idvideo="<?= $id_video; ?>">
		<svg class="opt-box-svg <?= $bool?'active':null; ?>" width="19" height="23" viewBox="0 0 19 23" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M18 21.4L18 2C18 1.44772 17.5523 1 17 1L2.5 0.999999C1.94772 0.999999 1.5 1.44771 1.5 2L1.5 21.421C1.5 21.6643 1.77428 21.8064 1.973 21.6661L10 16L17.52 21.64C17.7178 21.7883 18 21.6472 18 21.4Z" stroke="#3D3D3D" stroke-width="1.5" stroke-linecap="round"></path>
		</svg>

		<?php if($bool): ?>	
			<p class="option-title">В избранном</p>
		<?php else: ?>
			<p class="option-title">В избранное</p>
		<?php endif; ?>
	</div>

	<a class="option-item" data-fancybox="" data-src="#share-popup" href="javascript:;">
		<svg width="24" height="19" viewBox="0 0 24 19" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M1 18H0.2C0.2 18.3323 0.405455 18.63 0.71616 18.748C1.02687 18.8659 1.37811 18.7794 1.59859 18.5307L1 18ZM12.52 12.9474H13.32V12.1474H12.52V12.9474ZM12.52 17.1579H11.72V18.7316L12.9914 17.8042L12.52 17.1579ZM22.3333 10L22.8048 10.6463L23.6426 10.0352L22.8388 9.37993L22.3333 10ZM12.52 2L13.0255 1.37993L11.72 0.315677V2H12.52ZM12.52 6.21053L12.6027 7.00624L13.32 6.93173V6.21053H12.52ZM1.59859 18.5307C3.04762 16.8965 4.45611 15.7167 6.13696 14.9361C7.81754 14.1556 9.82882 13.7474 12.52 13.7474V12.1474C9.66451 12.1474 7.40912 12.5812 5.46305 13.485C3.51723 14.3886 1.93904 15.7351 0.401412 17.4693L1.59859 18.5307ZM11.72 12.9474V17.1579H13.32V12.9474H11.72ZM12.9914 17.8042L22.8048 10.6463L21.8619 9.35367L12.0486 16.5116L12.9914 17.8042ZM22.8388 9.37993L13.0255 1.37993L12.0145 2.62007L21.8278 10.6201L22.8388 9.37993ZM11.72 2V6.21053H13.32V2H11.72ZM12.4373 5.41481C8.26666 5.84805 5.17711 7.16108 3.13516 9.34888C1.08882 11.5414 0.2 14.4991 0.2 18H1.8C1.8 14.764 2.61785 12.2481 4.30484 10.4406C5.99623 8.6284 8.66667 7.41511 12.6027 7.00624L12.4373 5.41481Z" fill="#3D3D3D"/>
		</svg>

		<p class="option-title">Поделиться</p>
	</a>
</div>