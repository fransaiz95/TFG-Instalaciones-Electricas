<div class="breadcrumbs">
    <?php 
    $this->Breadcrumbs->add( __('Home'), ['controller' => 'home', 'action' => 'home'], ['class' => 'cf']); 
    $this->Breadcrumbs->add( __('Users'), ['controller' => 'users', 'action' => 'home'], ['class' => 'cf']); 
    echo $this->Breadcrumbs->render();?>
</div>

<?php $current_user = $Auth->user(); ?>

<div class="grid-container p-1">
    <div class="grid-x grid-padding-x">
        <div class="large-10 cell ta-left">
            <h1><?php echo __('Users')?></h1>
        </div>
        <?php 
        $url = ['controller' => 'home' , 'action' => 'home'];
        echo $this->element('Comun/btn_back', array('url' => $url));?>
        
        <div class="large-12">
            <?php echo $this->element('../Users/Elements/search'); ?>
        </div>

        <div class="large-12 cell ta-right">
            <?php
            $url = ['controller' => 'users' , 'action' => 'add'];
            $label = __('New User');
            echo $this->element('Comun/btn_new_item', array('url' => $url, 'label' => $label)); ?>
        </div>

        <div class="large-12 cell ">
            <div class="large-12 cell">
                
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="table100-head">
                            <th class="p-left-1"><?php echo $this->Paginator->sort('Users.name', __('Name')); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Users.surname', __('Surname'))?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Users.username', __('Username') ); ?></th>
                            <th class="ta-center"><?php echo $this->Paginator->sort('Users.id_role', __('Role') ); ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($users as $user){ 
                        ?>
                        <tr>
                            <td class="p-left-1"><?php echo h($user->name) ?></td>
                            <td class="ta-center"><?php echo h($user->surname) ?></td>
                            <td class="ta-center"><?php echo h($user->username) ?></td>
                            <td class="ta-center"><?php echo h($user->Roles['name']) ?></td>
                            <td class="actions">
                                <?php
                                echo $this->Html->link( 
                                    '<span class="c-primary"><ion-icon name="create"></ion-icon></span>',
                                    [
                                        'controller' => 'users',
                                        'action' => 'edit',
                                        $user->id
                                    ],
                                    [
                                        'escape' => false,
                                        'style' => 'padding-left:4px;',
                                        'title' => __('Edit')
                                    ]
                                );
                                if($current_user['id'] != $user['id']){
                                    echo $this->Html->link( 
                                        '<span class="c-primary"><ion-icon name="trash"></ion-icon></span>',
                                        [], 
                                        [
                                            'escape' => false,
                                            'class' => 'delete-js',
                                            'title' => __('Delete?'),
                                            'data-title' => __('Are you sure you want to delete user: {0}?', $user->name . ' ' . $user->surname),
                                            'data-text' => __('Changes can\'t be revert'),
                                            'data-url' => \Cake\Routing\Router::url([
                                                'controller' => 'users',
                                                'action' => 'delete', 
                                            ], true),
                                            'data-url_redirect' => \Cake\Routing\Router::url([
                                                'controller' => 'users',
                                                'action' => 'home', 
                                            ], true),
                                            'data-id' => $user->id
                                        ]
                                    );
                                }
                                ?>
                            </td>
                        </tr>

                    <?php
                    }?>
                    </tbody>
                </table>
                <?php echo $this->element('Comun/paginator'); ?>
            </div>
        </div>
    </div>
</div>
