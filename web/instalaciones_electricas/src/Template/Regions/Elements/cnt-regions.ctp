<div class="grid-container" >
    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <h1><?= __('Region') ?></h1>
        </div>  
        <div class="large-3 medium-3 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Name:') ?>
            </span>
            <?php echo $region['name']; ?>
        </div>

        <div class="large-3 medium-3 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Country:') ?>
            </span>
            <?php 
            echo $region['Countries']['name']; ?>
        </div>

        <div class="large-3 medium-3 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Dem for:') ?>
            </span>
            <?php 
            echo $region['dem_for']; ?>
        </div>

        <div class="large-3 medium-3 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Ren for:') ?>
            </span>
            <?php 
            echo $region['ren_for']; ?>
        </div>
    </div>
</div>