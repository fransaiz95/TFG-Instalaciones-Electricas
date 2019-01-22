<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Technologies'), ['controller' => 'home', 'action' => 'homeTechnologies'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Generation Technologies'), ['controller' => 'technologies', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('New Technology'), ['controller' => 'technologies', 'action' => 'add'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<div class="grid-container p-1">
    <div class="grid-x">
        <div class="large-10 cell ta-left">
            <h1><?= __('New Technology') ?></h1>
        </div>
        <?php 
        $url = ['controller' => 'technologies' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
    </div>

    <?php echo $this->element('../Technologies/Elements/form'); ?>

</div>