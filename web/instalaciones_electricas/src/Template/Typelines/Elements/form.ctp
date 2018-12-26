
        <?php 
        echo $this->Form->create($typeline); ?>

        <div class="grid-x cnt-form">
            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'lin_cap',
                    [
                        'label' => __('Line cap'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'tension',
                    [
                        'label' => __('Tension'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>
        </div>


        <?php
        $url = ['controller' => 'typelines' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>