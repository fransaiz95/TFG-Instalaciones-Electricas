
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
        </div>


        <?php
        $url = ['controller' => 'typelines' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>