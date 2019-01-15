<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Climate')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'homeCountries'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>

        <div class="large-12 cell ta-right">
            <div class="large-2 cell ta-right">
                <?php
                echo $this->Html->link( 
                    $this->Html->image('/img/icons/excel.png',array('class'=>'', 'style' => 'width: 25px;')) . __('Download template'), 
                    array(), 
                    array(
                        'label' => __('as'),
                        'escape' => false,
                        'class' => 'download-excel',
                        'style' => '  pointer-events: none; cursor: default;',
                        'title' => __('Download template')
                    )
                );
                ?>
            </div>
        </div>

        <?php 
        echo $this->Form->create($rangemeteos, ['type' => 'file', 'id' => 'form-excel']); 
        ?>

        <div class="large-12 cell p-left-1">
            <h2><?php echo __('Choose a file:') ?></h2>
            <?php
            echo $this->Form->input(
                'excel_file', 
                array(
                    'label' => false,
                    'id' => 'excel_file',
                    'type' => 'file',
                )
            );
            ?>
        </div> 


        <div class="large-12 cell p-1">
            <?php
            $url = ['controller' => 'rangemeteos' , 'action' => 'home'];
            echo $this->element('Comun/btn_actions_form_ajax', array('url' => $url)); ?>
        </div>

        <?php echo $this->Form->end() ?>

    </div>
</div>
