
<?php 
echo $this->Form->create($user); ?>

<div class="grid-x cnt-form">
    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'username',
            [
                'label' => __('Username'),
                'type' => 'text'
            ]
        );
        ?>
    </div>

    <div class="large-6 p-1 input_field">
        <?php
        echo $this->Form->input(
            'password',
            [
                'label' => __('Password'),
                'type' => 'password'
            ]
        );
        ?>
    </div>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'name',
            [
                'label' => __('Name'),
                'type' => 'text'
            ]
        );
        ?>
    </div>
    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'surname',
            [
                'label' => __('Surname'),
                'type' => 'text'
            ]
        );
        ?>
    </div>

    <div class="large-4 p-1 input_field">
        <?php
        echo $this->Form->input(
            'id_role', 
            [
                'label' => __(''),
                'type' => 'select',
                'class' => 'js-example-basic-single',
                'multiple' => false,
                'options' => $roles, 
                'empty' => false,
                'required' => true
            ]
        );
        ?>
    </div>
</div>

<?php
$url = ['controller' => 'home' , 'action' => 'home'];
echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>

<?php echo $this->Form->end() ?>