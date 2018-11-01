
<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <h1><?= __('Region') ?></h1>
            <?php
                echo $this->Form->input('', array(
                    'value' => $region->name
                ));
            ?>
        </div>
    </div>
</div>