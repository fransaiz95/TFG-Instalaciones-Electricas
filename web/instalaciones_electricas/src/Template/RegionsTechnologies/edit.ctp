
<div class="grid-container p-1">

        <h1><?= __('Edit Region Technology') ?></h1>
    
        <?php 
        echo $this->Form->create($region_technology); ?>
        <div class="cnt-form">

            <div class="grid-x">
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->hidden(
                        'id_region'
                    );
                    echo $this->Form->input(
                        ' ',
                        [
                            'label' => __('Region name'),
                            'readonly' => true,
                            'value' => $region->name
                        ]
                    );
                    ?>
                </div>

                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->hidden(
                        'id_technology'
                    );
                    echo $this->Form->input(
                        ' ',
                        [
                            'label' => __('Region name'),
                            'readonly' => true,
                            'value' => $technology->name
                        ]
                    );
                    ?>
                </div>
            </div>

            <div class="grid-x">
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'power',
                        [
                            'label' => __('Power'),
                            'type' => 'number',
                        ]
                    );
                    ?>
                </div>

                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'cap_ava',
                        [
                            'label' => __('Cap ava'),
                            'type' => 'number'
                        ]
                    );
                    ?>
                </div>
            </div>

        </div>

        <?php
        $url = ['controller' => 'regions' , 'action' => 'view', $region->id];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>
        
</div>