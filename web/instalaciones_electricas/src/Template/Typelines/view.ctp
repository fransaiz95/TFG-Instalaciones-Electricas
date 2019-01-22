<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Technologies'), ['controller' => 'home', 'action' => 'homeTechnologies'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Types of lines'), ['controller' => 'typelines', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Type line') . ': ' . $typeline['lin_cap'] . ' MW', ['controller' => 'typelines', 'action' => 'view', $typeline['id']], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<div class="grid-container" >
    <div class="grid-x grid-padding-x">

        <div class="large-10 cell ta-left">
            <h1><?= __('Typeline') ?></h1>
        </div>
        <?php 
        $url = ['controller' => 'typelines' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Lin cap:') ?>
            </span>
            <?php echo h($typeline['lin_cap']) . ' MW'; ?>
        </div>

        <div class="large-4 medium-4 cell p-form">
            <span class="titles-view">
                <?php echo __('Tension:') ?>
            </span>
            <?php 
            echo h($typeline['tension']) . ' kV'; ?>
        </div>

    </div>
</div>