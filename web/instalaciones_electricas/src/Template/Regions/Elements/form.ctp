
<?php 
$action = $this->request->action;
echo $this->Form->create($region); ?>

<div class="grid-x cnt-form">
    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'name',
            [
                'label' => __('Name'),
                'required' => true
            ]
        );
        ?>
    </div>

    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'id_country', 
            [
                'type' => 'select',
                'class' => 'js-example-basic-single',
                'multiple' => false,
                'options' => $countries, 
                'required' => false,
                'default' => $id_country,
                'empty' => false,
                'disabled' => ($id_country != null && $action == 'add') ? true : false
                ]
        );

        if($id_country != null && $action == 'add'){
            echo $this->Form->hidden(
                'id_country', 
                [
                    'value' => $id_country,
                ]
            );
        }
        ?>
    </div>
    
    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'dem_for',
            [
                'label' => __('Dem for'),
                'type' => 'number',
                'required' => false,
                'empty' => true
            ]
        );
        ?>
    </div>

    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'ren_for',
            [
                'label' => __('Ren for'),
                'type' => 'number',
                'required' => false,
                'empty' => true
            ]
        );
        ?>
    </div>
</div>


<?php
$url = ['controller' => 'countries' , 'action' => 'view', $id_country];
echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

<?php echo $this->Form->end() ?>