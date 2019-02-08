<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
<?php
echo $this->Html->css('lib/foundation-6.4.2/css/foundation.css');
echo $this->Html->css('../js/lib/jquery-ui-1.10.4/themes/base/minified/jquery-ui.min.css');
echo $this->Html->css('estilos.css'); 
echo $this->Html->script('lib/jquery-1.11.1.min.js');
echo $this->Html->script('lib/jquery-ui-1.10.4/ui/minified/jquery-ui.min.js');
echo $this->fetch('script');
?>


<div class="users form">
<?php echo $this->Flash->render('auth') ?>

<div class="login-form">

    <?php echo $this->Flash->render('flash')?>

    <?php echo $this->Form->create() ?>
        <fieldset>
            <span class="login-cnt-img">
            <?php
            echo $this->Html->image(
                '/img/login/weblectric.png',
                array(
                    'class'=>''
                    )
                )
            ?>
            </span>

            <div class="cnt-login">
                <div class="grid-x">
                    <div class="large-12 p-1 login-input">
                        <?php
                        echo $this->Form->input(
                            'username',
                            [
                                'label' => __('Username'),
                                'type' => 'text',
                                'autocomplete' => 'off',
                                'required' => true
                            ]
                        );
                        ?>
                    </div>

                    <div class="large-12 p-1 login-input">
                        <?php
                        echo $this->Form->input(
                            'password',
                            [
                                'label' => __('Password'),
                                'type' => 'password',
                                'required' => true
                            ]
                        );
                        ?>
                    </div>
                </div>
                <div class="login-cnt-bnt-save">
                    <?php echo
                    $this->Form->button(
                        __('Login'),
                        array(
                            'class' => 'login-bnt-save',
                            'title' => __('Login')
                        )
                    );?>
                </div>
            </div>
                
        </fieldset>
        
    <?php echo $this->Form->end() ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(".close-flash-icon-js").off('click').on('click', function(e){
            $(this).parent().addClass('d-none');
        });
    });
</script>