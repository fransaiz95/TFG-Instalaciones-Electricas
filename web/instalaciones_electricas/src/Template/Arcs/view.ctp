<div class="grid-container" >
    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <h1><?= __('Arc') ?></h1>
        </div>  
        <div class="large-6 medium-6 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Origin Region:') ?>
            </span>
            <?php echo $arcs['Regions']['name']; ?>
        </div>

        <div class="large-6 medium-6 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Destination Region:') ?>
            </span>
            <?php echo $arcs['Regions2']['name']; ?>
        </div>

        <div class="large-6 medium-6 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Distance:') ?>
            </span>
            <?php 
            echo $arcs['distance']; ?>
        </div>

        <div class="large-6 medium-6 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Number of lines:') ?>
            </span>
            <?php 
            echo $arcs['ArcsTypelines']['num_lines']; ?>
        </div>
    </div>
</div>

<div class="grid-container" >
    <div class="grid-x grid-padding-x p-top-1">
        <div class="large-12 cell">
            <h1><?= __('Typeline') ?></h1>
        </div>  
        <div class="large-4 medium-4 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Lin cap:') ?>
            </span>
            <?php echo $arcs['Typelines']['lin_cap']; ?>
        </div>

        <div class="large-4 medium-4 cell p-top-1">
            <span class="titles-view">
                <?php echo __('New Line Cos:') ?>
            </span>
            <?php echo $arcs['Typelines']['new_line_cos']; ?>
        </div>

        <div class="large-4 medium-4 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Man Lin Cos:') ?>
            </span>
            <?php 
            echo $arcs['Typelines']['man_lin_cos']; ?>
        </div>

        <div class="large-4 medium-4 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Flo Cos:') ?>
            </span>
            <?php 
            echo $arcs['Typelines']['flo_cos']; ?>
        </div>

        <div class="large-4 medium-4 cell p-top-1">
            <span class="titles-view">
                <?php echo __('New Lim Emp:') ?>
            </span>
            <?php 
            echo $arcs['Typelines']['new_lim_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Man Lim Emp:') ?>
            </span>
            <?php 
            echo $arcs['Typelines']['man_lim_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Flo Emp:') ?>
            </span>
            <?php 
            echo $arcs['Typelines']['flo_emp']; ?>
        </div>

        <div class="large-4 medium-4 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Eff Lin:') ?>
            </span>
            <?php 
            echo $arcs['Typelines']['eff_lin']; ?>
        </div>
        </div>
    </div>
</div>

<!-- // Type line a la que pertenece el arc -->

