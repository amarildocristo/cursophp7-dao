<?php 

	require_once("config.php");

	/*Carrega apenas um usuario.*/
	//$user = new Usuario();
	//$user->loadById(7);
	//echo $user;

	/*Carrega uma lista de usuarios*/
	//$lista = Usuario::getList();
	//echo json_encode($lista); 

	/*Carrega uma lista de usuarios buscando pelo login*/
	//$search = Usuario::search("se");
	//echo json_encode($search);

	/*Carrega um usuario usando logon e senha*/
	//$usuario = new Usuario();
	//$usuario->authentication("Maria", "123");
	//echo $usuario;

	/*Inserir usuarios na tabela*/
	//$aluno = new Usuario();
	//$aluno->setDeslogin("aluno");
	//$aluno->setDessenha("@alun0");
	//$aluno->insert();
	//echo $aluno;

	/*Alterar um usuario na tabela*/
	//$usuario = new Usuario();
	//$usuario->loadById(8);
	//$usuario->update("Diniz", "999");
	//echo $usuario;

	$usuario = new Usuario();
	$usuario->loadById(36);
	$usuario->delete();
	echo $usuario;

 ?>