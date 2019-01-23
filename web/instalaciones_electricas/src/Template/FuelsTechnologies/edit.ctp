<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Technologies'), ['controller' => 'home', 'action' => 'homeTechnologies'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Fuels'), ['controller' => 'fuels', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( $fuel['name'], ['controller' => 'fuels', 'action' => 'view', $fuel['id']], ['class' => 'cf']); 
    $this->Breadcrumbs->add( $fuel->name . ' - ' . $technology->name, ['controller' => 'fuels_technologies', 'action' => 'edit', $fuel->id, $technology->id], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<div class="grid-container p-1">

        <div class="grid-x">
            <div class="large-6 cell">
                <h1><?= __('Edit Fuel Technology') ?></h1>
            </div>  
            <div class="large-6 cell">
                <?php 
                $url = ['controller' => 'fuels' , 'action' => 'view', $fuel['id']];
                echo $this->element('Comun/btn_back', array('url' => $url)); ?>
            </div>  
        </div>  
    
        <?php 
        echo $this->Form->create($fuel_technology); ?>
        <div class="cnt-form">

            <div class="grid-x">
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->hidden(
                        'id_fuel'
                    );
                    echo $this->Form->input(
                        ' ',
                        [
                            'label' => __('Fuel name'),
                            'readonly' => true,
                            'value' => $fuel->name,
                            'required' => true
                        ]
                    );
                    ?>
                </div>

                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->hidden(
                        'id_technology'
                    );
                    echo $this->Form->input(
                        ' ',
                        [
                            'label' => __('Technology name'),
                            'readonly' => true,
                            'value' => $technology->name,
                            'required' => true
                        ]
                    );
                    ?>
                </div>
            </div>

            <div class="grid-x">
                <div class="large-4 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'power',
                        [
                            'label' => __('Power'),
                            'type' => 'number',
                        ]
                    );
                    ?>
                </div>

                <div class="large-4 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'perc_con',
                        [
                            'label' => __('Perc con'),
                            'type' => 'number'
                        ]
                    );
                    ?>
                </div>

                <div class="large-4 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'fue_con',
                        [
                            'label' => __('Fue con'),
                            'type' => 'number'
                        ]
                    );
                    ?>
                </div>
            </div>

        </div>

        <?php
        $url = ['controller' => 'fuels' , 'action' => 'view', $fuel->id];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>
        
</div>