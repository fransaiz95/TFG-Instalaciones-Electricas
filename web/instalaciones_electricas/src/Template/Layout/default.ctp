<?php 
$this->extend('layout');


$this->start('header');
//echo 'Aqui iria la cabecera';
echo $this->element('Comun/header');
echo $this->fetch('content');
$this->end();
