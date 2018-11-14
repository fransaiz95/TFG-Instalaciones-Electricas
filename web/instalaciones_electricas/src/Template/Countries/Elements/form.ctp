
        <?php 
        echo $this->Form->create($country); ?>

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
        </div>

        <?php
        $url = ['controller' => 'countries' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>