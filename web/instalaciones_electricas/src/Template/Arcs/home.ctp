<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Arcs')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12">
            <?php echo $this->element('../Arcs/Elements/search'); ?>
        </div>

        <div class="large-12 cell ta-right">
            <?php
            $url = ['controller' => 'arcs' , 'action' => 'add'];
            $label = __('New Arc');
            // echo $this->element('Comun/btn_new_item', array('url' => $url, 'label' => $label)); ?>
        </div>

        <div class="large-12 cell ">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1"><?php echo $this->Paginator->sort('Arcs.id_region_1', __('Origin Region')); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Arcs.id_region_2', __('Destination Region') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Arcs.distance', __('Distance') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('ArcsTypelines.num_lines', __('Number of lines') ); ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($arcs as $arc){ ?>
                        <tr>
                            <td class="p-left-1"><?php echo h($arc['Regions']['name']) ?></td>
                            <td class="ta-center"><?php echo h($arc['Regions2']['name']) ?></td>
                            <td class="ta-center"><?php echo h($arc->distance) ?></td>
                            <td class="ta-center"><?php echo h($arc['ArcsTypelines']['num_lines']) ?></td>
                            <td class="actions">
                                <?php
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="eye"></ion-icon></span>', 
                                    [
                                        'controller' => 'arcs',
                                        'action' => 'view',
                                        $arc->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('View')
                                    ]
                                );
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="create"></ion-icon></span>',
                                    [
                                        'controller' => 'arcs',
                                        'action' => 'edit',
                                        $arc->id
                                    ],
                                    [
                                        'escape' => false,
                                        'style' => 'padding-left:4px;',
                                        'title' => __('Edit')
                                    ]
                                );
                                echo $this->Form->postLink( 
                                    '<span class="c-primary"><ion-icon name="trash"></ion-icon></span>',
                                    [
                                        'controller' => 'arcs',
                                        'action' => 'delete', 
                                        $arc->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('Delete?'),
                                        'confirm' => __('Are you sure you want to delete arc between: {0} and {1}?', $arc['Regions']['name'], $arc['Regions2']['name'])
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
