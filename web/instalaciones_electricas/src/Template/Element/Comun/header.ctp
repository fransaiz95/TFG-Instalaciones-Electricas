<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Weblectric</title>
 
	<link rel="stylesheet" href="estilos.css">
</head>
 
<body>
	<header id="main-header">
		<a id="logo-header" href="#">
			<span class="site-name"><?php echo __('WEBLECTRIC'); ?></span>
			<span class="site-desc"><?php echo __('La herramienta web ...'); ?></span>
		</a>
 
		<nav>
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
				<li>
					<?php
					echo $this->Html->link( 
						__('ABOUT US'),
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
				<li>
					<?php
					echo $this->Html->link( 
						__('CONTACT US'),
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
			</ul>
		</nav>
	</header>
</body>
</html>