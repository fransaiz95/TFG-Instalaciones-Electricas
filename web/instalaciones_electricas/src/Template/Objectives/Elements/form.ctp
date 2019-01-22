
        <?php 
        echo $this->Form->create($fuel); ?>

        <div class="grid-x cnt-form">
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
                    'fue_cos',
                    [
                        'label' => __('Fue cos'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-6 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'production',
                    [
                        'label' => __('Production'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>
        </div>


        <?php
        $url = ['controller' => 'fuels' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>