<?php $action = $this->request->action ?>


<?php echo $this->Form->create( ($action == 'add') ? $arc : $arc_with_regions); ?>


<?php
if($action == 'edit'){
    echo $this->Form->hidden(
        'id_arc',
        [
            'value' => $arc_with_regions->id
        ]
    );
}
?>

<div class="cnt-form">

    <div class="grid-x">
        <div class="large-6 p-1 input_field">
            <?php
            if( $action == 'add' ){
                echo $this->Form->input(
                    'id_region_1', 
                    [
                        'label' => __('Origin region'),
                        'type' => 'select',
                        'class' => 'js-example-basic-single',
                        'multiple' => false,
                        'options' => $regions, 
                        'required' => true,
                        'empty' => false
                        ]
                );
            }else{
                echo $this->Form->hidden(
                    'id_region_1'
                );
                echo $this->Form->input(
                    ' ',
                    [
                        'label' => __('Origin region'),
                        'readonly' => true,
                        'value' => $arc_with_regions['Regions']['name'],
                        'required' => true
                    ]
                );
            }
            ?>
        </div>

        <div class="large-6 p-1 input_field">
            <?php
            echo $this->Form->input(
                'id_region_2', 
                [
                    'label' => __('Destination region'),
                    'type' => 'select',
                    'class' => 'js-example-basic-single',
                    'multiple' => false,
                    'options' => $regions, 
                    'empty' => false,
                    'required' => true
                ]
            );
            ?>
        </div>
    </div>

    <div class="grid-x">
        <div class="large-6 p-1 input_field">
            <?php
            echo $this->Form->input(
                'distance',
                [
                    'label' => __('Distance'),
                    'type' => 'number',
                ]
            );
            ?>
        </div>

        <div class="large-3 p-1 input_field">
            <?php
            echo $this->Form->input(
                'ArcsTypelines.num_lines', 
                [
                    'label' => __('Num lines'),
                    'type' => 'number',
                    'required' => true
                ]
            );
            ?>
        </div>

        <div class="large-3 p-1 input_field">
            <?php
            echo $this->Form->input(
                'Typelines.id', 
                [
                    'label' => __('Typeline (Lin Cap)'),
                    'type' => 'select',
                    'class' => 'js-example-basic-single',
                    'multiple' => false,
                    'options' => $typelines, 
                    'empty' => true,
                    'required' => true
                ]
            );
            ?>
        </div>
    </div>

</div>

<?php
$url = ['controller' => 'arcs' , 'action' => 'home'];
echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

<?php echo $this->Form->end() ?>