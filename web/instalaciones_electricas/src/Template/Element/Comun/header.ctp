<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Weblectric</title>
 
	<link rel="stylesheet" href="estilos.css">
</head>
 
<body></body>
	<header id="main-header">
		<?php echo $this->Html->image('/img/logos/white_2.png',array('class'=>'header_logo'))?>
		<?php $user = $Auth->user(); ?>
		<nav id="nav-header">
			<ul>
				<li>
					<?php
					echo $this->Html->link( 
						__('HOME'),
						array(
							'controller' => 'home',
							'action' => 'home'
						), 
						array(
							'escape' => false,
						)
					);
					?>
				</li>
				<?php if($user['id_role'] == ConstantesRoles::ADMIN){ ?>
					<li>
						<?php
						echo $this->Html->link( 
							__('RESTORE DATA BASE'),
							array(), 
							array(
								'escape' => false,
								'id' => 'restore_bd-js',
								'data-url_delete' => \Cake\Routing\Router::url([
									'controller' => 'home',
									'action' => 'ajaxDeleteDatabase', 
								], true),
								'data-url_create' => \Cake\Routing\Router::url([
									'controller' => 'home',
									'action' => 'ajaxCreateDatabase', 
								], true),
							)
						);
						?>
					</li>
				<?php
				} ?>
				<li>
					<div class="cnt-img-user-header">

						<div class="div-img-user-header">
							<?php echo $this->Html->image('/img/header/user.png',array('class'=>'img-user-header'));?>
						</div>
						<div class="cnt-user-name">
							<span class="ta-left">
								<?php echo $user['name'] . ' ' . $user['surname']?>
							</span>
						</div>
					</div>

					<ul>
						<li>
							<?php
							echo $this->Html->link( 
								__('MY DATA'),
								array(
									'controller' => 'users',
									'action' => 'edit',
									$user['id']
								), 
								array(
									'escape' => false,
								)
							);
							?>
						</li>
						<li>
							<?php
							echo $this->Html->link( 
								__('LOGOUT'),
								array(
									'controller' => 'users',
									'action' => 'logout'
								), 
								array(
									'escape' => false,
								)
							);
							?>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>