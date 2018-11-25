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
            <?php echo $typeline['lin_cap']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('New line cos:') ?>
            </span>
            <?php 
            echo $typeline['new_line_cos']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Man lin cos:') ?>
            </span>
            <?php 
            echo $typeline['man_lin_cos']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Flo cos:') ?>
            </span>
            <?php 
            echo $typeline['flo_cos']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('New lim emp:') ?>
            </span>
            <?php 
            echo $typeline['new_lim_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Man lim emp:') ?>
            </span>
            <?php 
            echo $typeline['man_lim_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Flo emp:') ?>
            </span>
            <?php 
            echo $typeline['flo_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Eff lin:') ?>
            </span>
            <?php 
            echo $typeline['eff_lin']; ?>
        </div>


    </div>
</div>