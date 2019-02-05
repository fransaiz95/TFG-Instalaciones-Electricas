<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Countries data'), ['controller' => 'home', 'action' => 'homeCountries'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<div class="grid-container" style="max-width: 80rem">

    <div class="grid-x grid-padding-x buttons-portal ta-center p-bottom-1">

        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/country_region.png',array('class'=>'')), 
                array(
                    'controller' => 'countries',
                    'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'countries',
                    'title' => __('Country')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Country') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/rangerenewable.png',array('class'=>'')), 
                array(
                    'controller' => 'rangerenewables',
                    'action' => 'technologies'
                ), 
                array(
                    'escape' => false,
                    'class' => 'countries',
                    'title' => __('Renewable source')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Renewable source') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/rangemeteos.png',array('class'=>'')), 
                array(
                    'controller' => 'rangemeteos',
                    'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'countries',
                    'title' => __('Climate')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Climate') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/current_system.png',array('class'=>'')), 
                array(
                    'controller' => 'rangedemands',
                    'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'countries',
                    'title' => __('Demand')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Demand') ?>
            </div>
        </div>

    </div>

</div>