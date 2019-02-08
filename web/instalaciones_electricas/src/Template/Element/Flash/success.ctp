<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message success"><?= $message ?>
    <?php echo $this->Html->image('/img/icons/close.png',array('class' => 'close-flash-icon-js', 'title' => __('Close')))?>
</div>
