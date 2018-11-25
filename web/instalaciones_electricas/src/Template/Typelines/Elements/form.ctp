
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
                    'new_line_cos',
                    [
                        'label' => __('New line cos'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'man_lin_cos',
                    [
                        'label' => __('Man lin cos'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'flo_cos',
                    [
                        'label' => __('Flo cos'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'new_lim_emp',
                    [
                        'label' => __('New lim emp'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'man_lim_emp',
                    [
                        'label' => __('Man lim emp'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'flo_emp',
                    [
                        'label' => __('Flo emp'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'eff_lin',
                    [
                        'label' => __('Eff lin'),
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