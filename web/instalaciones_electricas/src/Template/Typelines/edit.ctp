
<div class="grid-container p-1">

    <div class="grid-x">
        <div class="large-10 cell ta-left">
            <h1><?= __('Edit Typeline') ?></h1>
        </div>
        <?php 
        $url = ['controller' => 'typelines' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
    </div>

    <?php echo $this->element('../Typelines/Elements/form'); ?>

</div>