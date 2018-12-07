<?php $class = ($active_tab != ConstantesTabs::ARCS) ? 'd-none' : ''; ?>

<div class="grid-container p-top-1 cnt-tabs <?php echo $class?>" id="cnt-arcs">
    <div class="grid-x grid-padding-x">

        <div class="large-10 cell">
            <h1><?= __('Arcs') ?></h1>
        </div>  
        <?php
        $url = ['controller' => 'regions' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url)); ?>

        <div class="large-12 cell p-top-1">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1"><?php echo __('Origin region') ?></th>
                            <th class="ta-center"><?php echo __('Destination region') ?></th>
                            <th class="ta-center"><?php echo __('Distance') ?></th>
                            <th class="actions"><?php echo __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($region_arcs as $arc){ ?>
                        <tr>
                            <td class="p-left-1"><?php echo h($arc['name']); ?></td>
                            <td class="ta-center"><?php echo h($arc['Regions2']['name']) ?></td>
                            <td class="ta-center"><?php echo ($arc['Arcs']['distance']) . ' km' ?></td>
                            <td class="actions">
                            <?php
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="create"></ion-icon></span>',
                                    [
                                        'controller' => 'arcs',
                                        'action' => 'edit',
                                        $arc['Arcs']['id']
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
                                        'data-title' => __('Are you sure you want to delete arc between: {0} and: {1}?', $arc['name'], $arc['Regions2']['name']),
                                        'data-text' => __('Changes can\'t be revert'),
                                        'data-url' => \Cake\Routing\Router::url([
                                            'controller' => 'arcs',
                                            'action' => 'delete', 
                                        ], true),
                                        'data-url_redirect' => \Cake\Routing\Router::url([
                                            'controller' => 'regions',
                                            'action' => 'view',
                                            $arc['Arcs']['id_region_1']
                                        ], true),
                                        'data-id' => $arc['Arcs']['id']
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