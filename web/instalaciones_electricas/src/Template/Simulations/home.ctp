<?php echo $this->Html->script('simulations.js', array('block' => 'script'));?>

<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Users'), ['controller' => 'users', 'action' => 'home'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<?php $current_user = $Auth->user(); ?>

<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Simulations')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'home-simulation'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12">
            <?php //echo $this->element('../Users/Elements/search'); ?>
        </div>

        <div class="large-12 cell ta-right">
            <?php
            echo $this->Html->link( 
                '<span class="ion-icon"><ion-icon name="add-circle"></ion-icon></span>' . __('Generate Simulation'), 
                [], 
                [
                    'escape' => false,
                    'class' => 'btn-new',
                    'id' => 'generate_simulation-js',
                    'title' => __('Generate Simulation'),
                    'data-url' => \Cake\Routing\Router::url([
                        'controller' => 'simulations',
                        'action' => 'generateZip', 
                    ], true),
                ]
            );?>
        </div>

        <div class="large-12 cell ">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1"><?php echo $this->Paginator->sort('Simulations.simulation_name', __('Simulation Name')); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Simulations.creation_date', __('Creation date'))?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Simulations.id_user', __('User') ); ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($simulations as $simulation){ 
                        ?>
                        <tr>
                            <td class="p-left-1"><?php echo h($simulation->simulation_name) ?></td>
                            <td class="ta-center"><?php echo h($simulation->creation_date->format('Y-m-d H:i:s')) ?></td>
                            <td class="ta-center"><?php echo h($simulation->Users['name'] . ' ' . $simulation->Users['surname']) ?></td>
                            <td class="actions">
                                <?php
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="cloud-download"></ion-icon></span>',
                                    [
                                        'controller' => 'simulations',
                                        'action' => 'download',
                                        $simulation->id
                                    ],
                                    [
                                        'escape' => false,
                                        'style' => 'padding-left:4px;',
                                        'title' => __('Download'),
                                    ]
                                );
                                // echo $this->Html->link( 
                                //     '<span class="c-primary"><ion-icon name="cloud-download"></ion-icon></span>',
                                //     [],
                                //     [
                                //         'escape' => false,
                                //         'class' => 'download_simulation-js',
                                //         'style' => 'padding-left:4px;',
                                //         'title' => __('Download'),
                                //         'data-title' => __('Do you want to download simulation: {0} ?'), $simulation->simulation_name,
                                //         'data-url' => \Cake\Routing\Router::url([
                                //             'controller' => 'simulations',
                                //             'action' => 'download',
                                //         ], true),
                                //         'data-id' => $simulation->id
                                //     ]
                                // );
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="trash"></ion-icon></span>',
                                    [], 
                                    [
                                        'escape' => false,
                                        'class' => 'delete-js',
                                        'title' => __('Delete?'),
                                        'data-title' => __('Are you sure you want to delete simulation: {0}?', $simulation->simulation_name),
                                        'data-text' => __('Changes can\'t be revert'),
                                        'data-url' => \Cake\Routing\Router::url([
                                            'controller' => 'simulations',
                                            'action' => 'delete', 
                                        ], true),
                                        'data-url_redirect' => \Cake\Routing\Router::url([
                                            'controller' => 'simulations',
                                            'action' => 'home', 
                                        ], true),
                                        'data-id' => $simulation->id
                                    ]
                                );
                                ?>
                            </td>
                        </tr>

                    <?php
                    }?>
                    </tbody>
                </table>
                <?php echo $this->element('Comun/paginator'); ?>
            </div>
        </div>
    </div>
</div>
