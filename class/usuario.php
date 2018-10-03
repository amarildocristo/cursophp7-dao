<?php 

	class Usuario {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario(){
			return $this->idusuario;
		}

		public function setIdusuario($value){
			$this->idusuario = $value;
		}

		public function getDeslogin(){
			return $this->deslogin;
		}

		public function setDeslogin($value){
			$this->deslogin = $value;
		}

		public function getDessenha(){
			return $this->dessenha;
		}

		public function setDessenha($value){
			$this->dessenha = $value;
		}

		public function getDtcadastro(){
			return $this->dtcadastro;
		}

		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}

		//Função para carregar nome do usuario pelo ID
		public function loadById($id){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			if(count($results) > 0) {
				$this->setData($results[0]);
			}
		}

		//Por não usar o $this, atribui o static para que este metodo possa ser chamado sem instanciar a classe.
		//Lista todos os usuarios da tabela.
		public static function getList(){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

			return $results;

		}

		//Busca na tabela logins com qualquer letras iguais.
		public static function search($login){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
				':SEARCH'=>"%".$login."%"
			));
		}

		public function authentication($login, $password){

			$sql = new Sql();	

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password
			));

			if(count($results) > 0) {
				$this->setData($results[0]);
			}else{
				throw new Exception("Login e/ou senha invalidos", 1);		
			}
		} 

		public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));	
				
		}
		
		//Neste metodo criou-se uma procedure para trazer o id do usuario.
		public function insert(){//não funcinou ainda!!

			$sql = new Sql();	

			$results = $sql->select("CALL sp_usuario_insert(:LOGIN, :PASSWORD)", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha()
			));

			if(count($results) > 0){
				$this->setData($results[0]);
			}

		} 
		

		public function update($login, $password){

			$this->setDeslogin($login);
			$this->setDessenha($password);

			$sql = new Sql();

			$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
				'LOGIN'=>$this->getDeslogin(),
				'PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()
			));
		}

		public function delete(){

			$sql = new Sql();
			$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
				':ID'=>$this->getIdusuario()
			));

			$this->setIdusuario(0);
			$this->setDeslogin("");
			$this->setDessenha("");
			$this->setDtcadastro(new DateTime());

		}

		//Mostrar na tela o resultado.
		public function __toString(){

			return json_encode(array(
				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));	

		}
	}

 ?>