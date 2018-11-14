<?php
echo $this->Form->create(
    'Searcher',
    array(
        'url' => array(
            'controller' => 'countries',
            'action' => 'view',
            $country['id']
        ),
        'type' => 'get',
        'class' => 'well form-inline buscador'
    )
);?>
<div class="grid-container p-vertical-0 p-horizontal-1">
    <div class="grid-x cnt-form">
        <div class="large-12 title-searcher">
            <?php echo __('Search:') ?>
        </div>
        <div class="large-3 p-1 input_field p-bottom-0">
            <?php echo $this->Form->input(
                'region_name',
                array(
                    'type' => 'text',
                    'label' => __('Region'),
                    'div' => '',
                )
            );
            ?>
        </div>
        <div class="large-1 p-1">
            <?php echo $this->Form->button(
                '<span class="c-primary"><ion-icon name="search"></ion-icon></span>',
                array(
                    'escape' => false,
                    'class' => 'btn-search',
                    'value' => 'submit'
                )
            );?>
        </div>
    </div>
</div>
<?php echo $this->Form->end();?>