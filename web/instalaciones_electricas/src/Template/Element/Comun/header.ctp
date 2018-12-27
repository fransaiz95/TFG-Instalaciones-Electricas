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