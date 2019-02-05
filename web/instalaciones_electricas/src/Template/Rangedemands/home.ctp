<?php echo $this->Html->script('jquery.fileDownload.js', array('block' => 'script'));?>
<?php echo $this->Html->script('excels.js', array('block' => 'script'));?>

<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Countries data'), ['controller' => 'home', 'action' => 'homeCountries'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Demand'), ['controller' => 'rangedemands', 'action' => 'home'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<?php 
echo $this->Form->create($rangedemands, ['type' => 'file', 'id' => 'form-excel']); 
?>

<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Demand')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'homeCountries'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>

        <div class="large-12 cell ta-right">
            <div class="large-8 cell ta-right">
                <div class="grid-x grid-padding-x">
                    <div class="large-9 cell ta-right input_field_year">
                        <?php
                        echo $this->Form->input(
                            'year', 
                            [
                                'label' => false,
                                'id' => 'year-js',
                                'type' => 'select',
                                'class' => 'js-example-basic-single',
                                'multiple' => false,
                                'options' => $years, 
                                'required' => false,
                                'empty' => false,
                                'escape' => false,
                                'style' => 'width: 150px;'
                                ]
                        );?>
                    </div>  

                    <div class="large-3 cell ta-right">
                        <?php
                        echo $this->Html->link( 
                            $this->Html->image('/img/icons/excel.png',array('class'=>'', 'style' => 'width: 25px;')) . __('Download current data'), 
                            array(), 
                            array(
                                'escape' => false,
                                'class' => 'download-excel btn_excel_rangedemands-js',
                                'title' => __('Download current data'),
                                'data-url' => \Cake\Routing\Router::url([
                                    'controller' => 'rangedemands',
                                    'action' => 'ajaxDownloadExcel', 
                                ], true),
                                'data-url_count_results' => \Cake\Routing\Router::url([
                                    'controller' => 'rangedemands',
                                    'action' => 'ajax_count_results', 
                                ], true),
                            )
                        );
                        ?>
                    </div> 
                </div> 
            </div>
        </div>

        <div class="grid-x grid-padding-x cnt-info-download">
            <div class="large-12 cell p-0 p-left-1">
                <ion-icon name="information-circle-outline"></ion-icon>
                <span><?php echo __('The process of downloading and importing may take several minutes depending on the number of records transported.')?></span>
            </div>
        </div>

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
            $url = ['controller' => 'home', 'action' => 'homeCountries'];
            echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>
        </div>

        <?php echo $this->Form->end() ?>

    </div>
</div>
