<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Countries data'), ['controller' => 'home', 'action' => 'homeCountries'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Countries'), ['controller' => 'countries', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( $country['name'], ['controller' => 'countries', 'action' => 'view', $country['id']], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('New region'), ['controller' => 'regions', 'action' => 'add', $country['id']], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<div class="grid-container p-1">
    <div class="grid-x">
        <div class="large-10 cell ta-left">
            <h1><?= __('New Region') ?></h1>
        </div>
        <?php 
        $url = ['controller' => 'countries' , 'action' => 'view', $id_country];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
    </div>

    <?php echo $this->element('../Regions/Elements/form'); ?>

</div>