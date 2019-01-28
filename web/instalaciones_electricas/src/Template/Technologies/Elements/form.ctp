<?php 
echo $this->Form->create($technology); ?>

<div class="grid-x cnt-form">

    <?php $title = __('Name of the technology.')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'name',
            [
                'label' => __('Name') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('If it\'s a renewable technology.')?>
    <div class="large-4 p-1 p-form">
        <?php
        echo $this->Form->input(
            'renewable',
            array(
                'type' => 'checkbox',
                'label' => __('Renewable') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'escape' => false
            )
        );
        ?>
    </div>

    <?php $title = __('Waste of water per generation of one megawatt. (m3/MWh)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'wat_wit',
            [
                'label' => __('Wat Wit') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Market price per megawatt ($/MWh)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'genco_pri',
            [
                'label' => __('Genco Pri') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Plant capacity. (MW)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'cap',
            [
                'label' => __('Cap') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Cost per megawatt due to installation. ($/MW)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'new_cap_cos',
            [
                'label' => __('New Cap Cos') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Cost per megawatt due to maintenance of old plants. ($/MWh)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'man_cos',
            [
                'label' => __('Man Cos') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Cost per megawatt due to maintenance of new plants. ($/MWh)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'man_cos_new_cap',
            [
                'label' => __('Man Cos New Cap') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Cost per megawhatt-hour generated for old plants. ($/MWh)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'gen_cos',
            [
                'label' => __('Gen Cos') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Cost per megawhatt-hour generated for new plants. ($/MWh)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'gen_cos_new_cap',
            [
                'label' => __('Gen Cos New Cap') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'life_time',
            [
                'label' => __('Life Time') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Tons of CO2 produced per megawhatt-hour. (CO2/MWh)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'ghg_emi',
            [
                'label' => __('Ghg Emi') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'inv_cap_emp',
            [
                'label' => __('Inv Cap Emp') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'man_cap_emp',
            [
                'label' => __('Man Cap Emp') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'dec_cam_emp',
            [
                'label' => __('Dec Cam Emp') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'om_cap_emp',
            [
                'label' => __('Om Cap Emp') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'fue_cap_emp',
            [
                'label' => __('Fue Cap Emp') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

    <?php $title = __('Water consumption per megawatt generation. (m3/MWh)')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'wat_con',
            [
                'label' => __('Wat Con') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >',
                'type' => 'number',
                'escape' => false
            ]
        );
        ?>
    </div>

</div>


<?php
$url = ['controller' => 'technologies' , 'action' => 'home'];
echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

<?php echo $this->Form->end() ?>