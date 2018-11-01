
<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <?php 
            echo $this->Form->create($country); ?>
            <fieldset>
                <h1><?= __('Add Country') ?></h1>
                <?php
                    echo $this->Form->input('name');
                ?>
            </fieldset>
            <?= 
            $this->Form->button(
                __('Submit'),
                array(
                    'class' => 'success button'
                )
            ) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>