<div class="grid-container" style="max-width: 80rem">

    <div class="grid-x grid-padding-x buttons-portal ta-center p-bottom-1">

        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/demand_forecast.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeScenarios'
                ), 
                array(
                    'escape' => false,
                    'class' => 'scenarios',
                    'title' => __('Demand forecast')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Demand forecast') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/fuel_cost.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeScenarios'
                ), 
                array(
                    'escape' => false,
                    'class' => 'scenarios',
                    'title' => __('Fuel cost')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Fuel cost') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/development_curve.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeScenarios'
                ), 
                array(
                    'escape' => false,
                    'class' => 'scenarios',
                    'title' => __('Development curve')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Development curve') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/reliability.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeScenarios'
                ), 
                array(
                    'escape' => false,
                    'class' => 'scenarios',
                    'title' => __('Reliability')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Reliability') ?>
            </div>
        </div>

    </div>

</div>