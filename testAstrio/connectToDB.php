<?php
	session_start();

	function connectToDataBase(){

		$configDB = require 'configForConnectDB.php';

		try{
			$pdo = new PDO (
		    	"{$configDB['driver']}:dbname={$configDB['db_name']};host={$configDB['host']};port={$configDB['port']}",
		   		$configDB['user'],
				$configDB['password']
			);
			$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		}catch(PDOException $e) {
			$_SESSION['errorBd'] = $e->getMessage();
		}
		session_write_close();
	}