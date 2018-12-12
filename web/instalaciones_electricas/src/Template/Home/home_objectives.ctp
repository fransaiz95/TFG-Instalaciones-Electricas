<div class="grid-container" style="max-width: 80rem">

    <div class="grid-x grid-padding-x buttons-portal ta-center p-bottom-1">

        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/economic.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeObjectives'
                ), 
                array(
                    'escape' => false,
                    'class' => 'objectives',
                    'title' => __('Economic')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Economic') ?>
            </div>
        </div>
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/enviromental.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeObjectives'
                ), 
                array(
                    'escape' => false,
                    'class' => 'objectives',
                    'title' => __('Environmental')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Environmental') ?>
            </div>
        </div>
        <div class="large-4 medium-4 cell p-top-1">
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/social.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeObjectives'
                ), 
                array(
                    'escape' => false,
                    'class' => 'objectives',
                    'title' => __('Social')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Social') ?>
            </div>
        </div>

    </div>

</div>