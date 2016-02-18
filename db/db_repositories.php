<?php
/* Database connection */
require("db_pdo.php");

/**
 * Class for storing data to DB
 *
 */
class DB_Repositories extends DB_PDO{
	
	/**
	 * Save a set of data 
	 * @param array  The list data to save
	 * @access public
	 */
	public function save($data = array()){
		foreach($data as $row){
			if( $this->exist($row['id']) ){
				$this->update($row);
			} else {
				$this->insert($row);
			}
		}		
	}
	
	/**
	 * Insert new row
	 * @param array  The data to insert
	 * @access public
	 */
	public function insert($data){
		$sql = "INSERT INTO repositories (id, name, url, description, created, pushed, stars) 
				VALUES (:id, :name, :url, :description, :created, :pushed, :stars)";
				
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':id', $data['id']);
		$stmt->bindParam(':name', $data['name']);
		$stmt->bindParam(':url', $data['url']);
		$stmt->bindParam(':description', $data['description']);	
		$stmt->bindParam(':created', $data['created']);
		$stmt->bindParam(':pushed', $data['pushed']);
		$stmt->bindParam(':stars', $data['stars']);
		$stmt->execute();
		
		print "inserting.. \n";
	}
	
	/**
	 * Update existing data
	 * @param array  The record to update
	 * @access public
	 */
	public function update($data){
		$sql = "UPDATE repositories SET (name=:name, url=:url, description=:description, 
				created=:created, pushed=:pushed, stars=:stars) WHERE id=:id";
		
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':name', $data['name']);
		$stmt->bindParam(':url', $data['url']);
		$stmt->bindParam(':description', $data['description']);	
		$stmt->bindParam(':created', $data['created']);
		$stmt->bindParam(':pushed', $data['pushed']);
		$stmt->bindParam(':stars', $data['stars']);
		$stmt->bindParam(':id', $data['id']);
		$stmt->execute();	

		print "updating.. \n";		
	}
	
	/**
	 * Check if ID exists in table
	 * @param integer  Repository ID number
	 * @access public
	 */
	public function exist($id){
		$sql = "SELECT id FROM repositories WHERE id=:id";
		$stmt = $this->db->prepare($sql);
		
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		
		if( $stmt->rowCount() > 0 ){
			return true;
		} 
		
		return false;
	}

	/**
	 * Retrieve all repositories
	 * @access public
	 */
	public function getList($limit = 40){
		$sql = "SELECT * FROM repositories ORDER BY stars DESC limit {$limit}";
		return $this->db->query($sql);
	}
}
