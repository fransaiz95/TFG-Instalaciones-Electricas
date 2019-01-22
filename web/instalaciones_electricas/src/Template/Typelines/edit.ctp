<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Technologies'), ['controller' => 'home', 'action' => 'homeTechnologies'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Types of lines'), ['controller' => 'typelines', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Type line') . ': ' . $typeline['lin_cap'] . ' MW', ['controller' => 'typelines', 'action' => 'edit', $typeline['id']], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<div class="grid-container p-1">

    <div class="grid-x">
        <div class="large-10 cell ta-left">
            <h1><?= __('Edit Typeline') ?></h1>
        </div>
        <?php 
        $url = ['controller' => 'typelines' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
    </div>

    <?php echo $this->element('../Typelines/Elements/form'); ?>

</div>