<?php
/**
 * Class for connecting to the Database
 *
 */
class DB_PDO{
	
	/**
	 * DB public object
	 * @var PDO
	 */
	protected $db;
	
	/**
	 * Constructor
	 *
	 */
	function __construct(){
		$host     = "localhost";
		$dbname   = "github_repo";
		$username = "root";
		$password = "";
			
		try {
			$this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
		} catch(PDOException $e) {
			echo $e->getMessage();
			exit();
		}		
	}
	
}
