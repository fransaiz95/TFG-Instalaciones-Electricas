<?php echo $this->Html->script('objectives.js'); ?>

<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Simulation'), ['controller' => 'home', 'action' => 'homeSimulation'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Objectives'), ['controller' => 'objectives', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Social'), ['controller' => 'objectives', 'action' => 'homeSocial'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<?php 
echo $this->Form->create(); ?>

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
                'so_generation_plants',
                array(
                    'type' => 'checkbox',
                    'id' => 'check-employee-1-js',
                    'label' => __('Jobs in generation plants.'),
                    'checked' => $session->read('Objectives.so_generation_plants')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_employment_contruc',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-1-js',
                    'label' => __('Employment in plant construction.'),
                    'checked' => $session->read('Objectives.so_employment_contruc')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_dismantling_plants',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-1-js',
                    'label' => __('Dismantling of plants.'),
                    'checked' => $session->read('Objectives.so_dismantling_plants')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_maintenance_plants',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-1-js',
                    'label' => __('Plant\'s operations and maintenances.'),
                    'checked' => $session->read('Objectives.so_maintenance_plants')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_generated_transport',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-1-js',
                    'label' => __('Employment generated in fuel production and transportation.'),
                    'checked' => $session->read('Objectives.so_generated_transport')
                )
            );
            ?>
        </div>


        <div class="large-12 input_field p-top-1 p-left-1">
            <?php echo $this->Form->input(
                'so_employment_transmission',
                array(
                    'type' => 'checkbox',
                    'id' => 'check-employee-2-js',
                    'label' => __('Employment on transmission line.'),
                    'checked' => $session->read('Objectives.so_employment_transmission')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_employment_installation',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-2-js',
                    'label' => __('Employment in installations on new lines.'),
                    'checked' => $session->read('Objectives.so_employment_installation')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_employment_operation',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-2-js',
                    'label' => __('Employment in operation on lines.'),
                    'checked' => $session->read('Objectives.so_employment_operation')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_employment_maintenance',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-2-js',
                    'label' => __('Employment in line maintenance.'),
                    'checked' => $session->read('Objectives.so_employment_maintenance')
                )
            );
            ?>
        </div>


        <div class="large-12 p-top-1 input_field p-left-1">
            <?php echo $this->Form->input(
                'so_social_cost',
                array(
                    'type' => 'checkbox',
                    'id' => 'check-employee-3-js',
                    'label' => __('Social costs.'),
                    'checked' => $session->read('Objectives.so_social_cost')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_cost_public',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-3-js',
                    'label' => __('Cost to the public.'),
                    'checked' => $session->read('Objectives.so_cost_public')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_accidents_produced',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-3-js',
                    'label' => __('Cost of accidents produced.'),
                    'checked' => $session->read('Objectives.so_accidents_produced')
                )
            );
            ?>
        </div>
        <div class="large-12 input_field p-left-5">
            <?php echo $this->Form->input(
                'so_cost_energy',
                array(
                    'type' => 'checkbox',
                    'class' => 'check-employee-3-js',
                    'label' => __('Cost of energy for the user.'),
                    'checked' => $session->read('Objectives.so_cost_energy')
                )
            );
            ?>
        </div>
    </div>

    <?php
    $url = ['controller' => 'objectives' , 'action' => 'home'];
    echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

</div>

<?php echo $this->Form->end() ?>
