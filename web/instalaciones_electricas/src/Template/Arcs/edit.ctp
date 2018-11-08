
<div class="grid-container p-1">

        <h1><?= __('Edit Region Technology') ?></h1>
    
        <?php 
        echo $this->Form->create($arc); ?>
        <div class="cnt-form">

            <div class="grid-x">
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->hidden(
                        'id_region_1'
                    );
                    echo $this->Form->input(
                        ' ',
                        [
                            'label' => __('Origin region'),
                            'readonly' => true,
                            'value' => $arc_with_regions[0]['Regions']['name']
                        ]
                    );
                    ?>
                </div>

                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'id_region_2', 
                        [
                            'type' => 'select',
                            'class' => 'js-example-basic-single',
                            'multiple' => false,
                            'options' => $regions, 
                            'empty' => false
                        ]
                    );
                    ?>
                </div>
            </div>

            <div class="grid-x">
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'distance',
                        [
                            'label' => __('Power'),
                            'type' => 'number',
                        ]
                    );
                    ?>
                </div>

            </div>

        </div>

        <?php
        $url = ['controller' => 'regions' , 'action' => 'view', $arc->id_region_1];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>
        
</div>