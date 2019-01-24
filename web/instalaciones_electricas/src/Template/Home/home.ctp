<?php $user = $Auth->user(); ?>

<div class="grid-container" style="max-width: 80rem">

    <div class="grid-x grid-padding-x buttons-portal ta-center p-bottom-1">

        <?php $columns = ($user['id_role'] == ConstantesRoles::ADMIN) ? 'large-3 medium-3 cell p-top-1' : 'large-4 medium-4 cell p-top-1';?>

        <div class=<?php echo $columns?> >
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
        <div class=<?php echo $columns?> >
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
        <div class=<?php echo $columns?>>
            <?php
            echo $this->Html->link( 
                $this->Html->image('/img/portal/simulation.png',array('class'=>'')), 
                array(
                    'controller' => 'home',
                    'action' => 'homeSimulation'
                ), 
                array(
                    'escape' => false,
                    'class' => 'simulation',
                    'title' => __('Simulation')
                )
            );
            ?>
            <div class="large-12 medium-12 cell div-font">
                <?php echo __('Simulation') ?>
            </div>
        </div>

        <?php if($user['id_role'] == ConstantesRoles::ADMIN){?>
            <div class=<?php echo $columns?> >
                <?php
                echo $this->Html->link( 
                    $this->Html->image('/img/portal/users.png',array('class'=>'')), 
                    array(
                        'controller' => 'users',
                        'action' => 'home'
                    ), 
                    array(
                        'escape' => false,
                        'class' => 'users',
                        'title' => __('Users')
                    )
                );
                ?>
                <div class="large-12 medium-12 cell div-font">
                    <?php echo __('Users') ?>
                </div>
            </div>
        <?php
        }?>
    </div>

</div>