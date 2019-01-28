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
                <?php $title = __('Name of the region.')?>
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->hidden(
                        'id_region'
                    );
                    echo $this->Form->input(
                        ' ',
                        [
                            'label' => __('Region name') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                            'readonly' => true,
                            'value' => $region->name,
                            'required' => true,
                            'escape' => false
                        ]
                    );
                    ?>
                </div>

                <?php $title = __('Name of the technology.')?>
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->hidden(
                        'id_technology'
                    );
                    echo $this->Form->input(
                        ' ',
                        [
                            'label' => __('Technology name') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                            'readonly' => true,
                            'value' => $technology->name,
                            'required' => true,
                            'escape' => false
                        ]
                    );
                    ?>
                </div>
            </div>

            <div class="grid-x">
                <?php $title = __('Installed power in each region. (MW)')?>
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'power',
                        [
                            'label' => __('Power') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                            'type' => 'number',
                            'escape' => false
                        ]
                    );
                    ?>
                </div>

                <?php $title = __('Available capacity by region and by technology. (MW)')?>
                <div class="large-6 p-1 input_field">
                    <?php
                    echo $this->Form->input(
                        'cap_ava',
                        [
                            'label' => __('Cap ava') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                            'type' => 'number',
                            'escape' => false
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