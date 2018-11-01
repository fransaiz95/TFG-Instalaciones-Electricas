<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Countries')?></h1>
        </div>
        <div class="large-2 cell ta-right">
            <?php
            echo $this->Html->link( 
                __('« ') . '&nbsp' . __(' Back'), 
                array(
                    'controller' => 'home',
                    'action' => 'home'
                ), 
                array(
                    'escape' => false,
                    'class' => 'btn-back',
                    'title' => __('Back')
                )
            );
            ?>
        </div>
        <div class="large-12 cell">
            <table cellpadding="0" cellspacing="0">
            <thead>
                <tr class="table100-head">
                    <th class="p-left-1"><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($countries as $country){ 
                ?>
                <tr>
                    <td class="p-left-1"><?php echo h($country->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $country->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $country->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?>
                    </td>
                </tr>

            <?php
            }?>
            </tbody>
            </table>
            <?php
            if($this->Paginator->numbers() != false){ ?>
                <div class="wrapper">
                    <ul class="pagination">
                        <?php echo $this->Paginator->prev(__('Prev')) ?>
                        <?php echo $this->Paginator->numbers() ?>
                        <?php echo $this->Paginator->next(__('next')) ?>
                    </ul>
                </div>
            <?php    
            }?>
        </div>
    </div>
</div>
