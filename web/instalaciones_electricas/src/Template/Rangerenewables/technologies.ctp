<?php echo $this->Html->script('technologies.js'); ?>

<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Renewable Sources')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'homeCountries'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12 cell p-top-1">
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
                                    $this->Html->image('/img/icons/excel.png',array('class'=>'', 'style' => 'width: 23px;')),
                                    [
                                        'controller' => 'rangerenewables',
                                        'action' => 'home',
                                        $technology->id
                                    ], 
                                    [
                                        'escape' => false,
                                        'title' => __('View')
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
