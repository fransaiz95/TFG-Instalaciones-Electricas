<?php echo $this->Html->script('arcs.js'); ?>

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
            echo $this->Form->hidden(
                'id_region_1',
                [
                    'value' => $region->id,
                ]
            );
            echo $this->Form->input(
                ' ',
                [
                    'label' => __('Origin region'),
                    'readonly' => true,
                    'value' => $region->name,
                    'required' => true
                ]
            );
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
                'ArcsTypelines.id_typeline', 
                [
                    'label' => __('Typeline (Lin Cap)'),
                    'type' => 'select',
                    'id' => 'typeline_id-js',
                    'class' => 'js-example-basic-single',
                    'multiple' => false,
                    'options' => $typelines, 
                    'empty' => true,
                    // 'required' => true
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
                    'id' => 'num_lines-js',
                    'type' => 'number',
                    'empty' => true,
                    // 'required' => true
                ]
            );
            ?>
        </div>
    </div>

</div>

<?php
$url = ['controller' => 'regions' , 'action' => 'view', $region->id];
echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

<?php echo $this->Form->end() ?>