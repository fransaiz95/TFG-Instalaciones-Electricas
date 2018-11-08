<div class="large-2 cell ta-right">
	<?php
	echo $this->Html->link( 
		'<span class="ion-icon"><ion-icon name="ios-arrow-back"></ion-icon></span>' . __(' Back'), 
		( isset($url) ? $url : array() ), 
		array(
			'escape' => false,
			'class' => 'btn-back',
			'title' => __('Back')
		)
	);
	?>
</div>