<div class="grid-container" style="max-width: 80rem">

    <div class="grid-x grid-padding-x buttons-portal ta-center p-bottom-1">

        <div class="large-3 medium-3 cell p-top-1">
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
                    'controller' => 'home',
                    'action' => 'homeCountries'
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
                    'controller' => 'home',
                    'action' => 'homeCountries'
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
                    'controller' => 'home',
                    'action' => 'homeCountries'
                ), 
                array(
                    'escape' => false,
                    'class' => 'countries',
                    'title' => __('Current system')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Current system') ?>
            </div>
        </div>

    </div>

</div>