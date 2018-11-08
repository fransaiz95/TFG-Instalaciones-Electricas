
<div class="grid-container p-1">

        <h1><?= __('Edit Region') ?></h1>
    
        <?php 
        echo $this->Form->create($region); ?>
        <div class="cnt-form">

            <div class="grid-x">
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'name',
                        [
                            'label' => __('Name'),
                        ]
                    );
                    ?>
                </div>

                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'id_country', 
                        [
                            'type' => 'select',
                            'class' => 'js-example-basic-single',
                            'multiple' => false,
                            'options' => $countries, 
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
                        'dem_for',
                        [
                            'label' => __('Dem for'),
                            'type' => 'number'
                        ]
                    );
                    ?>
                </div>

                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'ren_for',
                        [
                            'label' => __('Rem for'),
                            'type' => 'number'
                        ]
                    );
                    ?>
                </div>
            </div>

        </div>

        <?php
        $url = ['controller' => 'regions' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>
        
</div>