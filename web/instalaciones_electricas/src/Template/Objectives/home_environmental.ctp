<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Simulation'), ['controller' => 'home', 'action' => 'homeSimulation'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Objectives'), ['controller' => 'objectives', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Environmental'), ['controller' => 'objectives', 'action' => 'homeEnvironmental'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<?php 
echo $this->Form->create(); ?>

<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Environmental')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'objectives' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'en_environmental_impact',
                array(
                    'type' => 'checkbox',
                    'label' => __('Environmental impact.'),
                    'checked' => $session->read('Objectives.en_environmental_impact')
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'en_emission_gases',
                array(
                    'type' => 'checkbox',
                    'label' => __('Emission of greenhouse gases.'),
                    'checked' => $session->read('Objectives.en_emission_gases')
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'en_water_usage',
                array(
                    'type' => 'checkbox',
                    'label' => __('Water consumption.'),
                    'checked' => $session->read('Objectives.en_water_usage')
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'en_water_withdrawal',
                array(
                    'type' => 'checkbox',
                    'label' => __('Water withdrawal.'),
                    'checked' => $session->read('Objectives.en_water_withdrawal')
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
