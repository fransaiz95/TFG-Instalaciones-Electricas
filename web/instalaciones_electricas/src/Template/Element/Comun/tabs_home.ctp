<?php echo $this->Html->script('tabs-home.js'); ?>

<div class="grid-container">

    <div class="grid-x grid-padding-x buttons-tabs-home ta-center">
        <div class="large-12 medium-12 cell p-top-1 ta-center">
            
            <?php
            if(in_array(ConstantesTabs::COUNTRIES, $enabled_tabs)){

                $active = ($active_tab == ConstantesTabs::COUNTRIES) ? 'active-tab' : '';

                echo $this->Html->link( 
                    $this->Html->image('/img/portal/countries.png',array('class'=>'')), 
                    [], 
                    [
                        'escape' => false,
                        'id' => 'tab-countries-js',
                        'class' => 'tab-home countries ' . $active,
                        'data-cnt_div' => 'cnt-countries',
                        'title' => __('Countries')
                    ]
                );
            }
            if(in_array(ConstantesTabs::REGIONS, $enabled_tabs)){

                $active = ($active_tab == ConstantesTabs::REGIONS) ? 'active-tab' : '';

                echo $this->Html->link( 
                    $this->Html->image('/img/portal/regions.png',array('class'=>'')), 
                    [], 
                    [
                        'escape' => false,
                        'id' => 'tab-regions-js',
                        'class' => 'tab-home regions ' . $active,
                        'data-cnt_div' => 'cnt-regions',
                        'title' => __('Regions')
                    ]
                );
            }
            
            if(in_array(ConstantesTabs::FUELS, $enabled_tabs)){

                $active = ($active_tab == ConstantesTabs::FUELS) ? 'active-tab' : '';

                echo $this->Html->link( 
                    $this->Html->image('/img/portal/fuels.png',array('class'=>'')), 
                    [], 
                    [
                        'escape' => false,
                        'class' => 'tab-home fuels ' . $active,
                        'title' => __('Fuels')
                    ]
                );
            }
           
            if(in_array(ConstantesTabs::TECHNOLOGIES, $enabled_tabs)){

                $active = ($active_tab == ConstantesTabs::TECHNOLOGIES) ? 'active-tab' : '';

                echo $this->Html->link( 
                    $this->Html->image('/img/portal/technologies.png',array('class'=>'')), 
                    [], 
                    [
                        'escape' => false,
                        'id' => 'tab-technologies-js',
                        'class' => 'tab-home technologies ' . $active,
                        'data-cnt_div' => 'cnt-technologies',
                        'title' => __('Technologies')
                    ]
                );
            }
           
            if(in_array(ConstantesTabs::ARCS, $enabled_tabs)){

                $active = ($active_tab == ConstantesTabs::ARCS) ? 'active-tab' : '';

                echo $this->Html->link( 
                    $this->Html->image('/img/portal/arcs.png',array('class'=>'')), 
                    [], 
                    [
                        'escape' => false,
                        'id' => 'tab-arcs-js',
                        'class' => 'tab-home arcs ' . $active,
                        'data-cnt_div' => 'cnt-arcs',
                        'title' => __('Arcs')
                    ]
                );
            }
            ?>

        </div>
    </div>

</div>