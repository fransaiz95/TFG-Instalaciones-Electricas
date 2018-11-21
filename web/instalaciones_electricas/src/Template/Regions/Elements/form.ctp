
        <?php 
        echo $this->Form->create($region); ?>

        <div class="grid-x cnt-form">
            <div class="large-6 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'name',
                    [
                        'label' => __('Name'),
                        'required' => true
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
                        'required' => false,
                        'empty' => false
                     ]
                );
                ?>
            </div>
            
            <div class="large-6 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'dem_for',
                    [
                        'label' => __('Dem for'),
                        'type' => 'number',
                        'required' => false,
                        'empty' => true
                    ]
                );
                ?>
            </div>

            <div class="large-6 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'ren_for',
                    [
                        'label' => __('Ren for'),
                        'type' => 'number',
                        'required' => false,
                        'empty' => true
                    ]
                );
                ?>
            </div>
        </div>


        <?php
        $url = ['controller' => 'regions' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>