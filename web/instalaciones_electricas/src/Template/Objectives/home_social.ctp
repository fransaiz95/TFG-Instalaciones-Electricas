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
                    'label' => __('Empleos en plantas de generación'),
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
                    'label' => __('Empleo en construcción de plantas'),
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
                    'label' => __('Desmantelamiento de plantas'),
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
                    'label' => __('Operación y mantenimiento en plantas'),
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
                    'label' => __('Empleo generado en producción y transporte de combustible'),
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
                    'label' => __('Empleo en línea de transmisión'),
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
                    'label' => __('Empleo en instalaciones en nuevas líneas'),
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
                    'label' => __('Empleo en operación en líneas'),
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
                    'label' => __('Empleo en mantenimiento en líneas'),
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
                    'label' => __('Costos sociales'),
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
                    'label' => __('Coste para pública'),
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
                    'label' => __('Coste en accidentes producidos'),
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
                    'label' => __('Coste energía para usuario'),
                )
            );
            ?>
        </div>
    </div>
</div>
