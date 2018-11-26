
        <?php 
        echo $this->Form->create($technology); ?>

        <div class="grid-x cnt-form">
            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'name',
                    [
                        'label' => __('Name'),
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 p-form">
                <?php
                echo $this->Form->input(
                    'renewable',
                    array(
                        'type' => 'checkbox',
                        'label' => __('Renewable')
                    )
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'wat_wit',
                    [
                        'label' => __('Wat Wit'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'genco_pri',
                    [
                        'label' => __('Genco Pri'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'cap',
                    [
                        'label' => __('Cap'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'new_cap_cos',
                    [
                        'label' => __('New Cap Cos'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'man_cos',
                    [
                        'label' => __('Man Cos'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'man_cos_new_cap',
                    [
                        'label' => __('Man Cos New Cap'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'gen_cos',
                    [
                        'label' => __('Gen Cos'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'gen_cos_new_cap',
                    [
                        'label' => __('Gen Cos New Cap'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'life_time',
                    [
                        'label' => __('Life Time'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'ghg_emi',
                    [
                        'label' => __('Ghg Emi'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'inv_cap_emp',
                    [
                        'label' => __('Inv Cap Emp'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'man_cap_emp',
                    [
                        'label' => __('Man Cap Emp'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'dec_cam_emp',
                    [
                        'label' => __('Dec Cam Emp'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'om_cap_emp',
                    [
                        'label' => __('Om Cap Emp'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'fue_cap_emp',
                    [
                        'label' => __('Fue Cap Emp'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'wat_con',
                    [
                        'label' => __('Wat Con'),
                        'type' => 'number'
                    ]
                );
                ?>
            </div>

        </div>


        <?php
        $url = ['controller' => 'technologies' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>