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
        <?php $title = __('Name of the origin region.')?>
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
                    'label' => __('Origin region') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                    'readonly' => true,
                    'value' => $region->name,
                    'required' => true,
                    'escape' => false
                ]
            );
            ?>
        </div>

        <?php $title = __('Name of the destination region.')?>
        <div class="large-6 p-1 input_field">
            <?php
            echo $this->Form->input(
                'id_region_2', 
                [
                    'label' => __('Destination region') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                    'type' => 'select',
                    'class' => 'js-example-basic-single',
                    'multiple' => false,
                    'options' => $regions, 
                    'empty' => false,
                    'required' => true,
                    'escape' => false
                ]
            );
            ?>
        </div>
    </div>

    <div class="grid-x">

        <?php $title = __('Distance between the two regions. (Km)')?>
        <div class="large-6 p-1 input_field">
            <?php
            echo $this->Form->input(
                'distance',
                [
                    'label' => __('Distance') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                    'type' => 'number',
                    'escape' => false
                ]
            );
            ?>
        </div>

        <?php $title = __('Type of line.')?>
        <div class="large-3 p-1 input_field">
            <?php
            echo $this->Form->input(
                'ArcsTypelines.id_typeline', 
                [
                    'label' => __('Typeline (Lin Cap)') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                    'type' => 'select',
                    'id' => 'typeline_id-js',
                    'class' => 'js-example-basic-single',
                    'multiple' => false,
                    'options' => $typelines, 
                    'empty' => true,
                    // 'required' => true,
                    'escape' => false
                ]
            );
            ?>
        </div>
        
        <?php $title = __('Number of lines of each type.')?>
        <div class="large-3 p-1 input_field">
            <?php
            echo $this->Form->input(
                'ArcsTypelines.num_lines', 
                [
                    'label' => __('Num lines') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                    'id' => 'num_lines-js',
                    'type' => 'number',
                    'empty' => true,
                    // 'required' => true,
                    'escape' => false
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