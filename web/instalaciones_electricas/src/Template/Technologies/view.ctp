<div class="grid-container" >
    <div class="grid-x grid-padding-x">

        <div class="large-10 cell ta-left">
            <h1><?= __('Technology') ?></h1>
        </div>
        <?php 
        $url = ['controller' => 'technologies' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Name:') ?>
            </span>
            <?php echo $technology['name']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Renowable:') ?>
            </span>
            <?php 
            echo ($technology['renowable'] == ConstantesBooleanas::SI) ? __('YES') : __('NO'); ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Wat Wit:') ?>
            </span>
            <?php 
            echo $technology['wat_wit']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Genco Pri:') ?>
            </span>
            <?php 
            echo $technology['genco_pri']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Cap:') ?>
            </span>
            <?php 
            echo $technology['cap']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('New Cap Cos:') ?>
            </span>
            <?php 
            echo $technology['new_cap_cos']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Man Cos:') ?>
            </span>
            <?php 
            echo $technology['man_cos']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Man Cos New Cap:') ?>
            </span>
            <?php 
            echo $technology['man_cos_new_cap']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Gen Cos New Cap:') ?>
            </span>
            <?php 
            echo $technology['gen_cos_new_cap']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Life Time:') ?>
            </span>
            <?php 
            echo $technology['life_time']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Ghg Emi:') ?>
            </span>
            <?php 
            echo $technology['ghg_emi']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Inv Cap Emp:') ?>
            </span>
            <?php 
            echo $technology['inv_cap_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Man Cap Emp:') ?>
            </span>
            <?php 
            echo $technology['man_cap_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Dec Cam Emp:') ?>
            </span>
            <?php 
            echo $technology['dec_cam_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Om Cap Emp:') ?>
            </span>
            <?php 
            echo $technology['om_cap_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Fue Çap Emp:') ?>
            </span>
            <?php 
            echo $technology['fue_cap_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Wat Con:') ?>
            </span>
            <?php 
            echo $technology['wat_con']; ?>
        </div>

    </div>
</div>