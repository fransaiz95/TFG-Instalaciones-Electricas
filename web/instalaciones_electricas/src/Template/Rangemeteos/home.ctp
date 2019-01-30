<?php echo $this->Html->script('jquery.fileDownload.js', array('block' => 'script'));?>
<?php echo $this->Html->script('excels.js', array('block' => 'script'));?>

<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Countries data'), ['controller' => 'home', 'action' => 'homeCountries'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Climate'), ['controller' => 'rangemeteos', 'action' => 'home'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

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
                    $this->Html->image('/img/icons/excel.png',array('class'=>'', 'style' => 'width: 25px;')) . __('Download current data'), 
                    array(
                        'controller' => 'rangemeteos',
                        'action' => 'ajaxDownloadExcel', 
                    ), 
                    array(
                        'escape' => false,
                        'class' => 'download-excel btn_excel_rangemeteos-js',
                        'title' => __('Download current data'),
                        'data-url' => \Cake\Routing\Router::url([
                            'controller' => 'rangemeteos',
                            'action' => 'ajaxDownloadExcel', 
                        ], true),
                    )
                );
                ?>
            </div>
        </div>

        <div class="grid-x grid-padding-x cnt-info-download">
            <div class="large-12 cell p-0 p-left-1">
                <ion-icon name="information-circle-outline"></ion-icon>
                <span><?php echo __('The process of downloading and importing may take several minutes depending on the number of records transported.')?></span>
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
            $url = ['controller' => 'home', 'action' => 'homeCountries'];
            echo $this->element('Comun/btn_actions_form', array('url' => $url)); ?>
        </div>

        <?php echo $this->Form->end() ?>

    </div>
</div>
