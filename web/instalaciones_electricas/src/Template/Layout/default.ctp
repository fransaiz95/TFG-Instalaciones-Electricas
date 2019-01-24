<?php 
$this->extend('layout');


$this->start('header');
//echo 'Aqui iria la cabecera';
echo $this->element('Comun/header');
?>
<div style="padding-top: 90px;">
<?php
echo $this->fetch('content');
?>
</div>
<?php
$this->end();?>
