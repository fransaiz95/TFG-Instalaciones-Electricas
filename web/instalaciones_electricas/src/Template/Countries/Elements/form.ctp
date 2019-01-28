
        <?php 
        echo $this->Form->create($country); ?>

        <div class="grid-x cnt-form">
            <?php $title = __('Name of the country.')?>
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
        </div>

        <?php
        $url = ['controller' => 'countries' , 'action' => 'home'];
        echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

        <?php echo $this->Form->end() ?>