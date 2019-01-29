
<?php 
$action = $this->request->action;
echo $this->Form->create($region); ?>

<div class="grid-x cnt-form">

    <?php $title = '0asdfasdfasdf'; ?>

    <?php $title = __('Name of the region.')?>
    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'name',
            [
                'label' => __('Name') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                'required' => true,
                'escape' => false,
            ]
        );
        ?>
    </div>

    <?php $title = __('Name of the country.')?>
    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'id_country', 
            [
                'label' => __('Country') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                'type' => 'select',
                'class' => 'js-example-basic-single',
                'multiple' => false,
                'options' => $countries, 
                'required' => false,
                'default' => $id_country,
                'empty' => false,
                'disabled' => ($id_country != null && $action == 'add') ? true : false,
                'escape' => false
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
    
    <?php $title = __('Reserve margin due to error in demand forecasting.')?>
    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'dem_for',
            [
                'label' => __('Dem for') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                'type' => 'number',
                'required' => false,
                'empty' => true,
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Reserve margin due to error in the renewable generation forecast.')?>
    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'ren_for',
            [
                'label' => __('Ren for') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                'type' => 'number',
                'required' => false,
                'empty' => true,
                'escape' => false
            ]
        );
        ?>
    </div>
</div>


<?php
$url = ['controller' => 'countries' , 'action' => 'view', $id_country];
echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

<?php echo $this->Form->end() ?>