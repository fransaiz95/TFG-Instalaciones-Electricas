
        <?php 
        echo $this->Form->create($typeline); ?>

        <div class="grid-x cnt-form">
            <?php $title = __('Line transmission capacity. (MW)')?>
            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'lin_cap',
                    [
                        'label' => __('Line cap') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                        'type' => 'number',
                        'escape' => false
                    ]
                );
                ?>
            </div>

            <?php $title = __('Line voltage. (MW)')?>
            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'tension',
                    [
                        'label' => __('Voltage') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                        'type' => 'number',
                        'escape' => false
                    ]
                );
                ?>
            </div>

            <?php $title = __('Cost per kilometer of installation. ($/Km')?>
            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'new_lin_cos',
                    [
                        'label' => __('New lin cos') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                        'type' => 'number',
                        'escape' => false
                    ]
                );
                ?>
            </div>

            <?php $title = __('Cost per kilometer of maintenance. ($/Km')?>
            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'man_lin_cos',
                    [
                        'label' => __('Man lin cos') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                        'type' => 'number',
                        'escape' => false
                    ]
                );
                ?>
            </div>

            <?php $title = __('Cost per transmission of one MWh. ($/MWh)')?>
            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'flo_cos',
                    [
                        'label' => __('Flo cos') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                        'type' => 'number',
                        'escape' => false
                    ]
                );
                ?>
            </div>

            <?php $title = __('Base percentage of line efficiency (at a temperature of 20°C). (Values between 0 and 1)')?>
            <div class="large-4 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'eff_lin_bas',
                    [
                        'label' => __('Eff lin bas') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                        'type' => 'number',
                        'escape' => false
                    ]
                );
                ?>
            </div>
        </div>


        <?php
        $url = ['controller' => 'typelines' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>