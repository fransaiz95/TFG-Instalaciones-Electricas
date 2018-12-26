<div class="grid-container" >
    <div class="grid-x grid-padding-x">

        <div class="large-10 cell ta-left">
            <h1><?= __('Typeline') ?></h1>
        </div>
        <?php 
        $url = ['controller' => 'typelines' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Lin cap:') ?>
            </span>
            <?php echo h($typeline['lin_cap']) . ' MW'; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Tension:') ?>
            </span>
            <?php 
            echo h($typeline['tension']) . ' kV'; ?>
        </div>

    </div>
</div>