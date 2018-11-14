<div class="large-2 cell ta-right">
	<?php
	echo $this->Html->link( 
		'<span class="ion-icon"><ion-icon name="add-circle"></ion-icon></span>' . $label, 
		( isset($url) ? $url : array() ), 
		array(
			'escape' => false,
			'class' => 'btn-new',
			'title' => $label
		)
	);
	?>
</div>