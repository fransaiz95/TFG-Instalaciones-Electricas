<?php echo $this->element('Comun/tabs_home');  ?>

<div class="grid-container" >
    <div class="grid-x grid-padding-x">
        <div class="large-12 cell">
            <h1><?= __('Country') ?></h1>
        </div>  
        <div class="large-3 medium-3 cell p-top-1">
            <span class="titles-view">
                <?php echo __('Name:') ?>
            </span>
            <?php echo $country['name']; ?>
        </div>
    </div>
</div>

<?php $class = ($active_tab != ConstantesTabs::REGIONS) ? 'd-none' : '';?>

<div class="grid-container cnt-tabs <?php echo $class?>" id="cnt-regions">
    <div class="grid-x grid-padding-x">

        <div class="large-10 cell">
            <h1><?= __('Regions') ?></h1>
        </div>  
        <?php 
        $url = ['controller' => 'countries' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url)); ?>

        <div class="large-12">
            <?php echo $this->element('../Countries/Elements/search_regions'); ?>
        </div>

        <div class="large-12 cell p-top-1">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1"><?php echo __('Name')?></th>
                            <th class="ta-center"><?php echo __('Country') ?></th>
                            <th class="ta-center"><?php echo __('Dem For') ?></th>
                            <th class="ta-center"><?php echo __('Ren For') ?></th>
                            <th class="actions"><?php echo __('Actions') ?></th>
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



