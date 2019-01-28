
        <?php 
        echo $this->Form->create($fuel); ?>

        <div class="grid-x cnt-form">

            <?php $title = __('Name of the fuel.')?>
            <div class="large-6 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'name',
                    [
                        'label' => __('Name') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                        'escape' => false
                    ]
                );
                ?>
            </div>

            <?php $title = __('Cost per unit of imported fuel. ($/MMBTU)')?>
            <div class="large-6 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'fue_cos',
                    [
                        'label' => __('Fue cos') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                        'type' => 'number',
                        'escape' => false
                    ]
                );
                ?>
            </div>

            <?php $title = __('National fuel reserve. (MMBTU)')?>
            <div class="large-6 p-1 input_field">
                <?php
                echo $this->Form->input(
                    'production',
                    [
                        'label' => __('Production') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                        'type' => 'number',
                        'escape' => false
                    ]
                );
                ?>
            </div>
        </div>


        <?php
        $url = ['controller' => 'fuels' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>