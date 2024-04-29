
<?php $video_obj = $GLOBALS['video']; ?>
<div class="filters mark-class">
	<svg class="mark-class" width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M0.5 0.5H13.5" stroke="#3D3D3D" stroke-linecap="round"/>
		<path d="M2.5 5.5H11.5" stroke="#3D3D3D" stroke-linecap="round"/>
		<path d="M4.5 10.5H9.5" stroke="#3D3D3D" stroke-linecap="round"/>
	</svg>
	<span class="mark-class">Фильтры</span>

	<div class="filter-var-box mark-class hide">
		<!-- <div class="filter-var-box"> -->
			<div data-sortprop="SHOW_COUNTER" data-sorttype="DESC" class="filter-var-item mark-class <?= $video_obj->Check_Session_Sort('SHOW_COUNTER','DESC'); ?>">
				<span class="filt-prop-name mark-class">Самые просматриваемые</span>
				<svg class="mark-class" width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 4.5L5 8.5L12.5 1" stroke="#004EA4" stroke-linecap="round"/>
				</svg>
			</div>

			<div data-sortprop="PROPERTY_TIME_VIDEO" data-sorttype="ASC" class="filter-var-item mark-class <?= $video_obj->Check_Session_Sort('PROPERTY_TIME_VIDEO','ASC'); ?>">
				<span class="filt-prop-name mark-class">Длительность: сначала короткие</span>
				<svg class="mark-class" width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 4.5L5 8.5L12.5 1" stroke="#004EA4" stroke-linecap="round"/>
				</svg>
			</div>

			<div data-sortprop="PROPERTY_TIME_VIDEO" data-sorttype="DESC" class="filter-var-item mark-class <?= $video_obj->Check_Session_Sort('PROPERTY_TIME_VIDEO','DESC'); ?>">
				<span class="filt-prop-name mark-class">Длительность: сначала длинные</span>
				<svg class="mark-class" width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 4.5L5 8.5L12.5 1" stroke="#004EA4" stroke-linecap="round"/>
				</svg>
			</div>

			<div data-sortprop="CREATED" data-sorttype="DESC" class="filter-var-item mark-class <?= $video_obj->Check_Session_Sort('CREATED','DESC'); ?>">
				<span class="filt-prop-name mark-class">По дате: самые новые</span>
				<svg class="mark-class" width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 4.5L5 8.5L12.5 1" stroke="#004EA4" stroke-linecap="round"/>
				</svg>
			</div>

			<div data-sortprop="CREATED" data-sorttype="ASC" class="filter-var-item mark-class <?= $video_obj->Check_Session_Sort('CREATED','ASC'); ?>">
				<span class="filt-prop-name mark-class">По дате: самые старые</span>
				<svg class="mark-class" width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 4.5L5 8.5L12.5 1" stroke="#004EA4" stroke-linecap="round"/>
				</svg>
			</div>

			<div data-sortprop="PROPERTY_RATING_VIDEO" data-sorttype="DESC" class="filter-var-item mark-class <?= $video_obj->Check_Session_Sort('PROPERTY_RATING_VIDEO','DESC'); ?>">
				<span class="filt-prop-name mark-class">По популярности</span>
				<svg class="mark-class" width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 4.5L5 8.5L12.5 1" stroke="#004EA4" stroke-linecap="round"/>
				</svg>
			</div>
		</div>
	</div> 