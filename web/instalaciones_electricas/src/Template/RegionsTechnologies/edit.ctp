<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Countries data'), ['controller' => 'home', 'action' => 'homeCountries'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Countries'), ['controller' => 'countries', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( $country['name'], ['controller' => 'countries', 'action' => 'view', $country['id']], ['class' => 'cf']); 
    $this->Breadcrumbs->add( $region['name'], ['controller' => 'regions', 'action' => 'view', $region['id']], ['class' => 'cf']); 
    $this->Breadcrumbs->add( $region['name'] . ' - ' . $technology->name, ['controller' => 'regions_technologies', 'action' => 'edit', $region->id, $technology->id], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<div class="grid-container p-1">

        <div class="grid-x">
            <div class="large-6 cell">
                <h1><?= __('Edit Region Technology') ?></h1>
            </div>  
            <div class="large-6 cell">
                <?php 
                $url = ['controller' => 'regions' , 'action' => 'view', $region['id']];
                echo $this->element('Comun/btn_back', array('url' => $url)); ?>
            </div>  
        </div>  
    
        <?php 
        echo $this->Form->create($region_technology); ?>
        <div class="cnt-form">

            <div class="grid-x">
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->hidden(
                        'id_region'
                    );
                    echo $this->Form->input(
                        ' ',
                        [
                            'label' => __('Region name'),
                            'readonly' => true,
                            'value' => $region->name,
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
                <div class="large-6 p-1 input_field">
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

                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'cap_ava',
                        [
                            'label' => __('Cap ava'),
                            'type' => 'number'
                        ]
                    );
                    ?>
                </div>
            </div>

        </div>

        <?php
        $url = ['controller' => 'regions' , 'action' => 'view', $region->id];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>
        
</div>