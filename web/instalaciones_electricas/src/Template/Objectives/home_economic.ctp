<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Simulation'), ['controller' => 'home', 'action' => 'homeSimulation'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Objectives'), ['controller' => 'objectives', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Economic'), ['controller' => 'objectives', 'action' => 'homeEconomic'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>
<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Economic')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'objectives' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-4 p-1 input_field p-form">
            <?php echo $this->Form->input(
                'cost_new_plant',
                array(
                    'type' => 'checkbox',
                    'label' => __('Coste de inversión en nuevas plantas'),
                )
            );
            ?>
        </div>
        <div class="large-4 p-1 input_field p-form">
            <?php echo $this->Form->input(
                'cost_oper_maint_plant',
                array(
                    'type' => 'checkbox',
                    'label' => __('Coste de operación y mantenimiento en plantas'),
                )
            );
            ?>
        </div>
        <div class="large-4 p-1 input_field p-form">
            <?php echo $this->Form->input(
                'cost_generation',
                array(
                    'type' => 'checkbox',
                    'label' => __('Coste de generación'),
                )
            );
            ?>
        </div>
        <div class="large-4 p-1 input_field p-form">
            <?php echo $this->Form->input(
                'cost_new_lines',
                array(
                    'type' => 'checkbox',
                    'label' => __('Coste de inversión en nuevas líneas'),
                )
            );
            ?>
        </div>
        <div class="large-4 p-1 input_field p-form">
            <?php echo $this->Form->input(
                'cost_oper_maint_lines',
                array(
                    'type' => 'checkbox',
                    'label' => __('Coste de operación y mantenimiento de líneas'),
                )
            );
            ?>
        </div>
        <div class="large-4 p-1 input_field p-form">
            <?php echo $this->Form->input(
                'cost_import_fuel',
                array(
                    'type' => 'checkbox',
                    'label' => __('Coste de importación de combustible'),
                )
            );
            ?>
        </div>
        <div class="large-4 p-1 input_field p-form">
            <?php echo $this->Form->input(
                'cost_public_politics',
                array(
                    'type' => 'checkbox',
                    'label' => __('Coste de políticas públicas'),
                )
            );
            ?>
        </div>
    </div>
</div>
