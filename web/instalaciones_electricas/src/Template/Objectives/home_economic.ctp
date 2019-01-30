<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Simulation'), ['controller' => 'home', 'action' => 'homeSimulation'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Objectives'), ['controller' => 'objectives', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Economic'), ['controller' => 'objectives', 'action' => 'homeEconomic'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<?php 
echo $this->Form->create(); ?>

<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Economic')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'objectives' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'ec_cost_new_plant',
                array(
                    'type' => 'checkbox',
                    'label' => __('Cost of investment in new plants.'),
                    'checked' => $session->read('Objectives.ec_cost_new_plant')
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'ec_cost_oper_maint_plant',
                array(
                    'type' => 'checkbox',
                    'label' => __('Cost of operation and maintenance in plants.'),
                    'checked' => $session->read('Objectives.ec_cost_oper_maint_plant')
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'ec_cost_generation',
                array(
                    'type' => 'checkbox',
                    'label' => __('Generation cost.'),
                    'checked' => $session->read('Objectives.ec_cost_generation')
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'ec_cost_new_lines',
                array(
                    'type' => 'checkbox',
                    'label' => __('Cost of investment in new lines.'),
                    'checked' => $session->read('Objectives.ec_cost_new_lines')
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'ec_cost_oper_maint_lines',
                array(
                    'type' => 'checkbox',
                    'label' => __('Cost of operation and maintenance of lines.'),
                    'checked' => $session->read('Objectives.ec_cost_oper_maint_lines')
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'ec_cost_import_fuel',
                array(
                    'type' => 'checkbox',
                    'label' => __('Fuel import cost.'),
                    'checked' => $session->read('Objectives.ec_cost_import_fuel')
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'ec_cost_public_politics',
                array(
                    'type' => 'checkbox',
                    'label' => __('Cost of public policies.'),
                    'checked' => $session->read('Objectives.ec_cost_public_politics')
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

