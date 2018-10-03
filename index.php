<?php 

	require_once("config.php");

	$user = new Usuario();

	$user->loadById(7);

	echo $user;


 ?>