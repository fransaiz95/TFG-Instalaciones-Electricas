<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Typelines')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'home'];
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
                            <th class="ta-center"><?php echo $this->Paginator->sort('Typelines.new_line_cos', __('New line cos') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Typelines.man_lin_cos', __('Man lin cos') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Typelines.flo_cos', __('Flo cos') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Typelines.new_lim_emp', __('New lim emp') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Typelines.man_lim_emp', __('Man lim emp') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Typelines.flo_emp', __('Flo emp') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Typelines.eff_lin', __('Eff lin') ); ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($typelines as $typeline){?>
                        <tr>
                            <td class="p-left-1 ta-center"><?php echo h($typeline->lin_cap) ?></td>
                            <td class="ta-center"><?php echo h($typeline->new_line_cos) ?></td>
                            <td class="ta-center"><?php echo h($typeline->man_lin_cos) ?></td>
                            <td class="ta-center"><?php echo h($typeline->flo_cos) ?></td>
                            <td class="ta-center"><?php echo h($typeline->new_lim_emp) ?></td>
                            <td class="ta-center"><?php echo h($typeline->man_lim_emp) ?></td>
                            <td class="ta-center"><?php echo h($typeline->flo_emp) ?></td>
                            <td class="ta-center"><?php echo h($typeline->eff_lin) ?></td>
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
                                echo $this->Form->postLink( 
                                    '<span class="c-primary"><ion-icon name="trash"></ion-icon></span>',
                                    [
                                        'controller' => 'typelines',
                                        'action' => 'delete', 
                                        $typeline->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('Delete?'),
                                        'confirm' => __('Are you sure you want to delete typeline with line_cap: {0}?', $typeline->lin_cap)
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
