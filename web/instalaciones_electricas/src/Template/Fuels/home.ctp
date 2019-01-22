<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Technologies'), ['controller' => 'home', 'action' => 'homeTechnologies'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Fuels'), ['controller' => 'fuels', 'action' => 'home'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Fuels')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'home_technologies'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12">
            <?php echo $this->element('../Fuels/Elements/search'); ?>
        </div>

        <div class="large-12 cell ta-right">
            <?php
            $url = ['controller' => 'fuels' , 'action' => 'add'];
            $label = __('New Fuel');
            echo $this->element('Comun/btn_new_item', array('url' => $url, 'label' => $label)); ?>
        </div>

        <div class="large-12 cell ">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1"><?php echo $this->Paginator->sort('Fuels.name', __('Name')); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Fuels.fue_cos', __('Fue cos') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Fuels.production', __('Production') ); ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($fuels as $fuel){ ?>
                        <tr>
                            <td class="p-left-1"><?php echo h($fuel->name) ?></td>
                            <td class="ta-center"><?php echo h($fuel->fue_cos) ?></td>
                            <td class="ta-center"><?php echo h($fuel->production) ?></td>
                            <td class="actions">
                                <?php
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="eye"></ion-icon></span>', 
                                    [
                                        'controller' => 'fuels',
                                        'action' => 'view',
                                        $fuel->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('View')
                                    ]
                                );
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="create"></ion-icon></span>',
                                    [
                                        'controller' => 'fuels',
                                        'action' => 'edit',
                                        $fuel->id
                                    ],
                                    [
                                        'escape' => false,
                                        'style' => 'padding-left:4px;',
                                        'title' => __('Edit')
                                    ]
                                );
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="trash"></ion-icon></span>',
                                    [], 
                                    [
                                        'escape' => false,
                                        'class' => 'delete-js',
                                        'title' => __('Delete?'),
                                        'data-title' => __('Are you sure you want to delete fuel: {0}?', $fuel->name),
                                        'data-text' => __('Changes can\'t be revert'),
                                        'data-url' => \Cake\Routing\Router::url([
                                            'controller' => 'fuels',
                                            'action' => 'delete', 
                                        ], true),
                                        'data-url_redirect' => \Cake\Routing\Router::url([
                                            'controller' => 'fuels',
                                            'action' => 'home', 
                                        ], true),
                                        'data-id' => $fuel->id
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
