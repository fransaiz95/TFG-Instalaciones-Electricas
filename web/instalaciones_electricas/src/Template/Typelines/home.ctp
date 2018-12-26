<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Typelines')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'home_technologies'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>

        <div class="large-12 cell ta-right">
            <?php
            $url = ['controller' => 'typelines' , 'action' => 'add'];
            $label = __('New Typeline');
            echo $this->element('Comun/btn_new_item', array('url' => $url, 'label' => $label)); ?>
        </div>

        <div class="large-12 cell ">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1 ta-center"><?php echo $this->Paginator->sort('Typelines.lin_cap', __('Line cap')); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Typelines.tension', __('Eff lin') ); ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($typelines as $typeline){?>
                        <tr>
                            <td class="p-left-1 ta-center"><?php echo h($typeline->lin_cap) . ' MW' ?></td>
                            <td class="ta-center"><?php echo h($typeline->tension) . ' kV'?></td>
                            <td class="actions">
                                <?php
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="eye"></ion-icon></span>', 
                                    [
                                        'controller' => 'typelines',
                                        'action' => 'view',
                                        $typeline->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('View')
                                    ]
                                );
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="create"></ion-icon></span>',
                                    [
                                        'controller' => 'typelines',
                                        'action' => 'edit',
                                        $typeline->id
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
                                        'data-title' => __('Are you sure you want to delete typeline with line cap: {0}?', $typeline->lin_cap),
                                        'data-text' => __('Changes can\'t be revert'),
                                        'data-url' => \Cake\Routing\Router::url([
                                            'controller' => 'typelines',
                                            'action' => 'delete', 
                                        ], true),
                                        'data-url_redirect' => \Cake\Routing\Router::url([
                                            'controller' => 'typelines',
                                            'action' => 'home', 
                                        ], true),
                                        'data-id' => $typeline->id
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
