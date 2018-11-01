<div class="grid-container">

    <div class="grid-x grid-padding-x buttons-portal ta-center">

        <div class="large-3 medium-3 cell p-top-1 ta-center">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/countries.png',array('class'=>'')), 
                array(
                    'controller' => 'countries',
                    'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'countries',
                    'title' => __('Countries')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Countries') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/regions.png',array('class'=>'')), 
                array(
                    'controller' => 'regions',
                    'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'regions',
                    'title' => __('Regions')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Regions') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/fuels.png',array('class'=>'')), 
                array(
                    // 'controller' => 'fuels',
                    // 'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'fuels',
                    'title' => __('Fuels')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Fuels') ?>
            </div>
        </div>
        <div class="large-3 medium-3 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/technologies.png',array('class'=>'')), 
                array(
                    // 'controller' => 'technologies',
                    // 'action' => 'home'
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

    </div>

</div>