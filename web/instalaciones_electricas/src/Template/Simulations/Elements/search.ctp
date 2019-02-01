<?php
echo $this->Form->create(
    'Searcher',
    array(
        'url' => array(
            'controller' => 'users',
            'action' => 'home'
        ),
        'type' => 'get',
        'class' => 'well form-inline buscador'
    )
);?>
<div class="grid-container p-1">
    <div class="grid-x cnt-form">
        <div class="large-12 title-searcher">
            <?php echo __('Search:') ?>
        </div>
        <div class="large-3 p-1 input_field p-bottom-0">
            <?php echo $this->Form->input(
                'name',
                array(
                    'type' => 'text',
                    'label' => __('Name'),
                    'div' => '',
                )
            );
            ?>
        </div>
        <div class="large-3 p-1 input_field">
            <?php
            echo $this->Form->input(
                'surname', 
                [
                    array(
                        'type' => 'text',
                        'label' => __('Surname'),
                        'div' => '',
                    )
                ]
            );
            ?>
        </div>
        <div class="large-2 p-1 input_field">
            <?php
            echo $this->Form->input(
                'username', 
                [
                    array(
                        'type' => 'text',
                        'label' => __('Username'),
                        'div' => '',
                    )
                ]
            );
            ?>
        </div>
        <div class="large-2 p-1 input_field">
            <?php
            echo $this->Form->input(
                'id_role', 
                [
                    'type' => 'select',
                    'label' => 'Role',
                    'class' => 'js-example-basic-single',
                    'multiple' => false,
                    'options' => $roles, 
                    'empty' => true
                ]
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