<div class="grid-container" style="max-width: 80rem">

    <div class="grid-x grid-padding-x buttons-portal ta-center p-bottom-1">

        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/countries.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeCountries'
                ), 
                array(
                    'escape' => false,
                    'class' => 'countries',
                    'title' => __('Countries data')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Countries data') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/technologies.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeTechnologies',
                ), 
                array(
                    'escape' => false,
                    'class' => 'technologies',
                    'title' => __('Technologies')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Technologies') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/objectives.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeObjectives'
                ), 
                array(
                    'escape' => false,
                    'class' => 'objectives',
                    'title' => __('Objectives')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Objectives') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/scenarios.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeScenarios'
                ), 
                array(
                    'escape' => false,
                    'class' => 'scenarios',
                    'title' => __('Scenarios')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Scenarios') ?>
            </div>
        </div>
    </div>

</div>