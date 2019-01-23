<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Countries data'), ['controller' => 'home', 'action' => 'homeCountries'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Countries'), ['controller' => 'countries', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( $country['name'], ['controller' => 'countries', 'action' => 'view', $country['id']], ['class' => 'cf']); 
    $this->Breadcrumbs->add( $region['name'], ['controller' => 'regions', 'action' => 'view', $region['id']], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<?php echo $this->element('Comun/tabs_home');  ?>

<?php echo $this->element('../Regions/Elements/cnt-regions'); ?>

<?php echo $this->element('../Regions/Elements/cnt-regions_arcs'); ?>

<?php echo $this->element('../Regions/Elements/cnt-regions_technologies'); ?>



