<?php echo $this->Html->script('objectives.js'); ?>

<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Simulation'), ['controller' => 'home', 'action' => 'homeSimulation'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Objectives'), ['controller' => 'objectives', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Social'), ['controller' => 'objectives', 'action' => 'homeSocial'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Social')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'objectives' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12 input_field p-left-1 p-top-1">
            <?php echo $this->Form->input(
                'cost_new_plant',
                array(
                    'type' => 'checkbox',
                    'id' => 'check-employee-1-js',
                    'label' => __('Jobs in generation plants.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_oper_maint_plant',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-1-js',
                    'label' => __('Employment in plant construction.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_generation',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-1-js',
                    'label' => __('Dismantling of plants.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_new_lines',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-1-js',
                    'label' => __('Plant\'s operations and maintenances.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_new_lines',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-1-js',
                    'label' => __('Employment generated in fuel production and transportation.'),
                )
            );
            ?>
        </div>


        <div class="large-12 input_field p-top-1 p-left-1">
            <?php echo $this->Form->input(
                'cost_new_plant',
                array(
                    'type' => 'checkbox',
                    'id' => 'check-employee-2-js',
                    'label' => __('Employment on transmission line.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_oper_maint_plant',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-2-js',
                    'label' => __('Employment in installations on new lines.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_generation',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-2-js',
                    'label' => __('Employment in operation on lines.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_new_lines',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-2-js',
                    'label' => __('Employment in line maintenance.'),
                )
            );
            ?>
        </div>


        <div class="large-12 p-top-1 input_field p-left-1">
            <?php echo $this->Form->input(
                'cost_new_plant',
                array(
                    'type' => 'checkbox',
                    'id' => 'check-employee-3-js',
                    'label' => __('Social costs.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_oper_maint_plant',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-3-js',
                    'label' => __('Cost to the public.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_generation',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-3-js',
                    'label' => __('Cost of accidents produced.'),
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'cost_new_lines',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-3-js',
                    'label' => __('Cost of energy for the user.'),
                )
            );
            ?>
        </div>
    </div>
</div>
