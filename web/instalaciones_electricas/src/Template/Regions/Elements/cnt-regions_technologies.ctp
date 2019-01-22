<?php $class = ($active_tab != ConstantesTabs::TECHNOLOGIES) ? 'd-none' : '';?>

<div class="grid-container p-top-1 cnt-tabs <?php echo $class?>" id="cnt-technologies">
    <div class="grid-x grid-padding-x">

        <div class="large-10 cell">
            <h1><?= __('Technologies') ?></h1>
        </div>  

        <div class="large-12 cell p-top-1">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1"><?php echo __('Name')?></th>
                            <th class="ta-center"><?php echo __('Renewable') ?></th>
                            <th class="ta-center"><?php echo __('Power') ?></th>
                            <th class="ta-center"><?php echo __('Cap Ava') ?></th>
                            <th class="actions"><?php echo __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($region_technologies as $region_technology){ ?>
                        <tr>
                            <td class="p-left-1"><?php echo h($region_technology['Technology']['name']); ?></td>
                            <td class="ta-center"><?php echo ($region_technology['Technology']['renewable'] == ConstantesBooleanas::SI) ? __('YES') : __('NO') ?></td>
                            <td class="ta-center"><?php echo h($region_technology['RegionTechnology']['power']) ?></td>
                            <td class="ta-center"><?php echo h($region_technology['RegionTechnology']['cap_ava']) ?></td>
                            <td class="actions">
                                <?php
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="create"></ion-icon></span>',
                                    [
                                        'controller' => 'regions_technologies',
                                        'action' => 'edit',
                                        $region_technology['RegionTechnology']['id_region'],
                                        $region_technology['RegionTechnology']['id_technology']
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
                                        'data-title' => __('Are you sure you want to delete technology: {0} of region: {1}?', $region_technology['Technology']['name'], $region_technology->name),
                                        'data-text' => __('Changes can\'t be revert'),
                                        'data-url' => \Cake\Routing\Router::url([
                                            'controller' => 'regions_technologies',
                                            'action' => 'delete', 
                                        ], true),
                                        'data-url_redirect' => \Cake\Routing\Router::url([
                                            'controller' => 'regions',
                                            'action' => 'view',
                                            $region_technology->id
                                        ], true),
                                        'data-id' => $region_technology['RegionTechnology']['id_region'] . '/' . $region_technology['RegionTechnology']['id_technology']
                                    ]
                                );
                                ?>
                            </td>
                        </tr>

                    <?php
                    }?>
                    </tbody>
                </table>
                <?php //echo $this->element('Comun/paginator'); ?>
            </div>
        </div>

    </div>
</div>