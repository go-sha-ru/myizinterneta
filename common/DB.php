<?php

// use \PDO;

class DB
{
	public $db;

	public function __construct()
	{
		$dbinfo = require 'config.php';
		$this->db = new PDO('mysql:host=' . $dbinfo['host'] . ';dbname=' . $dbinfo['dbname'], $dbinfo['login'], $dbinfo['password']);
	}
}