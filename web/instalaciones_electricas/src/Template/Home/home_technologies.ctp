<div class="grid-container" style="max-width: 80rem">

    <div class="grid-x grid-padding-x buttons-portal ta-center p-bottom-1">

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
                    'title' => __('Generation technologies')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Generation technologies') ?>
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
                    'class' => 'technologies',
                    'title' => __('Types of lines')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Types of lines') ?>
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
                    'class' => 'technologies',
                    'title' => __('Fuels')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Fuels') ?>
            </div>
        </div>

    </div>

</div>