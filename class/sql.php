<?php 
	//Ao inves do php conversar com banco diretamente, ela passará por classes que vão auxiliar a coversa, criadas atraves do DAO(data access object). Essa é uma das grande vantagem do DAO/outa vantagem é a segurança.
	class Sql extends PDO {

		private $conn;

		//Essa função é chamada automaticamente quando a classe for instanciada. Então a conexão com banco de dados é estabelecida no exato momento.
		public function __construct(){

			$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
		}

		private function SetParams($statement, $parameters){

			//Associando os parametros/dados
			foreach ($parameters as $key => $value) {

				$this->setParam($statement, $key, $value);
			}			

		}

		private function SetParam($statement, $key, $value){

			$statement->bindParam($key, $value);	

		}

		//Essa função serve para executar os comandos no banco.
		//$rawQuery- query bruta!
		public function query($rawQuery, $params = array()){

			$stmt = $this->conn->prepare($rawQuery);

			$this->setParams($stmt, $params);

			$stmt->execute();

			return $stmt;
	
		}

		public function select($rawQuery, $params = array()):array
		{

			$stmt = $this->query($rawQuery, $params);
			
			//Traz apenas dados associativos sem os indexs
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $results;
			
		}

	}

 ?>