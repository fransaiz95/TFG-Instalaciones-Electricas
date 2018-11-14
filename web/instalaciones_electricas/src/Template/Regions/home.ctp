<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Regions')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12">
            <?php echo $this->element('../Regions/Elements/search'); ?>
        </div>

        <div class="large-12 cell ta-right">
            <?php
            $url = ['controller' => 'regions' , 'action' => 'add'];
            $label = __('New Region');
            echo $this->element('Comun/btn_new_item', array('url' => $url, 'label' => $label)); ?>
        </div>

        <div class="large-12 cell ">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1"><?php echo $this->Paginator->sort('Regions.name', __('Name')); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Regions.id_country', __('Country'))?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Regions.dem_for', __('Dem for') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Regions.ren_for', __('Ren for') ); ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($regions as $region){ ?>
                        <tr>
                            <td class="p-left-1"><?php echo h($region->name) ?></td>
                            <td class="ta-center"><?php echo h($region->Countries['name']) ?></td>
                            <td class="ta-center"><?php echo h($region->dem_for) ?></td>
                            <td class="ta-center"><?php echo h($region->ren_for) ?></td>
                            <td class="actions">
                                <?php
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="eye"></ion-icon></span>', 
                                    [
                                        'controller' => 'regions',
                                        'action' => 'view',
                                        $region->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('View')
                                    ]
                                );
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="create"></ion-icon></span>',
                                    [
                                        'controller' => 'regions',
                                        'action' => 'edit',
                                        $region->id
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
                                        'controller' => 'regions',
                                        'action' => 'delete', 
                                        $region->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('Delete?'),
                                        'confirm' => __('Are you sure you want to delete region: {0}?', $region->name)
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
