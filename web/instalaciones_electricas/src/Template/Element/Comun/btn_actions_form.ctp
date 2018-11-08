<div class="btn-actions-form p-top-1">

	<?php echo
	$this->Form->button(
		'<span class="ion-icon"><ion-icon name="checkmark-circle-outline"></ion-icon></span>' . __(' Save') ,
		array(
			'class' => 'btn-save',
			'title' => __('Save')
		)
	);

	echo $this->Html->link( 
		'<span class="ion-icon"><ion-icon name="close-circle-outline"></ion-icon></span>' . __(' Cancel') , 
		( isset($url) ? $url : array() ), 
		array(
			'escape' => false,
			'class' => 'btn-cancel p-left-1',
			'title' => __('Cancel')
		)
	);
	?>

</div>