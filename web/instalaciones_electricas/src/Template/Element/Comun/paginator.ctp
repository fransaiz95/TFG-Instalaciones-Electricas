<?php
if($this->Paginator->numbers() != false){ ?>
	<div class="wrapper">
		<ul class="pagination">
			<?php echo $this->Paginator->prev(__('Prev')) ?>
			<?php echo $this->Paginator->numbers() ?>
			<?php echo $this->Paginator->next(__('Next')) ?>
		</ul>
	</div>
<?php    
}?>