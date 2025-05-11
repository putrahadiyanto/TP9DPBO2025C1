<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

class DB
{
	var $db_host = 'localhost'; // host
	var $db_user = 'root'; // user basis data
	var $db_password = ''; // password
	var $db_name = 'mvp_php'; // nama basis data
	var $db_link = null; // PDO connection object
	var $result = null; // PDO statement object

	function __construct($db_host = '', $db_user = '', $db_password = '', $db_name = '')
	{
		// konstruktor
		$this->db_host = $db_host;
		$this->db_user = $db_user;
		$this->db_password = $db_password;
		$this->db_name = $db_name;
	}

	function open()
	{
		// membuka koneksi menggunakan PDO
		try {
			$dsn = "mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8mb4";
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES => false
			];
			$this->db_link = new PDO($dsn, $this->db_user, $this->db_password, $options);
		} catch (PDOException $e) {
			die("Database connection failed: " . $e->getMessage());
		}
	}
	function execute($query = "", $params = [])
	{
		// mengeksekusi query dengan PDO
		try {
			$this->result = $this->db_link->prepare($query);
			$this->result->execute($params);
			return $this->result;
		} catch (PDOException $e) {
			die("Query execution failed: " . $e->getMessage());
		}
	}

	function getResult()
	{
		// mengambil hasil eksekusi query
		return $this->result->fetch();
	}
	
	function getAllResult()
	{
		// mengambil semua hasil eksekusi query
		return $this->result->fetchAll();
	}

	function close()
	{
		// menutup koneksi
		$this->db_link = null;
	}
}
