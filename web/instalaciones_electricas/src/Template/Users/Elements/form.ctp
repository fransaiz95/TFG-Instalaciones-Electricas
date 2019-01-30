
<?php 
$user_loged = $Auth->user();
echo $this->Form->create($user); ?>

<div class="grid-x cnt-form">
    
    <?php $title = __('Name to enter into the application.')?>
    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'username',
            [
                'label' => __('Username') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                'type' => 'text',
                'escape' => false,
                'escape' => false,
            ]
        );
        ?>
    </div>

    <?php $title = __('Password to enter into the application.')?>
    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'password',
            [
                'label' => __('Password') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                'type' => 'password',
                'value' => '',
                'escape' => false,
            ]
        );
        ?>
    </div>

    <?php $title = __('Name of the user.')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'name',
            [
                'label' => __('Name') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                'type' => 'text',
                'escape' => false,
            ]
        );
        ?>
    </div>

    <?php $title = __('Surname of the user.')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'surname',
            [
                'label' => __('Surname') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                'type' => 'text',
                'escape' => false,
            ]
        );
        ?>
    </div>

    <?php $title = __('Role he represents.')?>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'id_role', 
            [
                'label' => __('Role') . '<img src="/img/icons/tooltip.png"  class="tooltip-info-js tooltipster-light-preview info-icon" title="' . $title . '" >' ,
                'type' => 'select',
                'class' => 'js-example-basic-single',
                'multiple' => false,
                'options' => $roles, 
                'empty' => false,
                'required' => true,
                'disabled' => ($user_loged['id_role'] == ConstantesRoles::ADMIN) ? false : true,
                'escape' => false,
            ]
        );
        ?>
    </div>
</div>

<?php
$url = ['controller' => 'users' , 'action' => 'home'];
echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

<?php echo $this->Form->end() ?>