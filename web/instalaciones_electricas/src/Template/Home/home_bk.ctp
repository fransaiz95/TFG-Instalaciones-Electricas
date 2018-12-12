<div class="grid-container" style="max-width: 80rem">

    <div class="grid-x grid-padding-x buttons-portal ta-center p-bottom-1">

        <div class="large-4 medium-4 cell p-top-1">
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
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/regions.png',array('class'=>'')), 
                array(
                    'controller' => 'regions',
                    'action' => 'home',
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
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/fuels.png',array('class'=>'')), 
                array(
                    'controller' => 'fuels',
                    'action' => 'home'
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
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/technologies.png',array('class'=>'')), 
                array(
                    'controller' => 'technologies',
                    'action' => 'home'
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
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/arcs.png',array('class'=>'')), 
                array(
                    'controller' => 'arcs',
                    'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'arcs',
                    'title' => __('Arcs')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Arcs') ?>
            </div>
        </div>
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/typelines.png',array('class'=>'')), 
                array(
                    'controller' => 'typelines',
                    'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'typelines',
                    'title' => __('Typelines')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Typelines') ?>
            </div>
        </div>
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/rangedemand.png',array('class'=>'')), 
                array(
                    'controller' => 'rangedemands',
                    'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'range',
                    'title' => __('Range demands')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Range demands') ?>
            </div>
        </div>
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/rangemeteos.png',array('class'=>'')), 
                array(
                    // 'controller' => 'rangemeteos',
                    // 'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'range',
                    'title' => __('Range meteos')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Range meteos') ?>
            </div>
        </div>
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/rangerenewable.png',array('class'=>'')), 
                array(
                    // 'controller' => 'rangerenewables',
                    // 'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'range',
                    'title' => __('Range renewables')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Range renewables') ?>
            </div>
        </div>

    </div>

</div>