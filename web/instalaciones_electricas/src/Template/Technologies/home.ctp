<?php echo $this->Html->script('technologies.js'); ?>

<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Technologies')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12">
            <?php echo $this->element('../Technologies/Elements/search'); ?>
        </div>

        <div class="large-12 cell ta-right">
            <?php
            $url = ['controller' => 'technologies' , 'action' => 'add'];
            $label = __('New Technology');
            echo $this->element('Comun/btn_new_item', array('url' => $url, 'label' => $label)); ?>
        </div>

        <div class="large-12 cell ">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1"><?php echo $this->Paginator->sort('Technologies.name', __('Name')); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Fuels.renewable', __('Renewable') ); ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($technologies as $technology){ ?>
                        <tr>
                            <td class="p-left-1"><?php echo h($technology->name) ?></td>
                            <td class="ta-center"><?php echo ($technology->renewable == ConstantesBooleanas::SI) ? __('YES') : __('NO'); ?></td>
                            <td class="actions">
                                <?php
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="eye"></ion-icon></span>', 
                                    [
                                        'controller' => 'technologies',
                                        'action' => 'view',
                                        $technology->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('View')
                                    ]
                                );
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="create"></ion-icon></span>',
                                    [
                                        'controller' => 'technologies',
                                        'action' => 'edit',
                                        $technology->id
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
                                        'controller' => 'technologies',
                                        'action' => 'delete', 
                                        $technology->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('Delete?'),
                                        'confirm' => __('Are you sure you want to delete technology: {0}?', $technology->name)
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
