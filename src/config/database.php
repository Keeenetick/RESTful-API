<?php

class Database{
	private $dbhost = 'localhost';
	private $dbname = 'slim';
	private $dbuser = 'root';
	private $dbpassword = '';

	public function connect(){
		$dsn = "mysql:host=$this->dbhost;dbname=$this->dbname";
		$connect = new PDO($dsn, $this->dbuser, $this->dbpassword);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $connect;
	}
}