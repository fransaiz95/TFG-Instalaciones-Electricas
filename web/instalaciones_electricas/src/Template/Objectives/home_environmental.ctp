<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Simulation'), ['controller' => 'home', 'action' => 'homeSimulation'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Objectives'), ['controller' => 'objectives', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Environmental'), ['controller' => 'objectives', 'action' => 'homeEnvironmental'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>
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
                'environmental_impact',
                array(
                    'type' => 'checkbox',
                    'label' => __('Impacto ambiental'),
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'emission_gases',
                array(
                    'type' => 'checkbox',
                    'label' => __('Emisión de gases de efecto invernadero'),
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'water_usage',
                array(
                    'type' => 'checkbox',
                    'label' => __('Consumo de agua'),
                )
            );
            ?>
        </div>
        <div class="large-12 p-1 input_field">
            <?php echo $this->Form->input(
                'water_withdrawal',
                array(
                    'type' => 'checkbox',
                    'label' => __('Retiro de agua'),
                )
            );
            ?>
        </div>
    </div>
</div>
