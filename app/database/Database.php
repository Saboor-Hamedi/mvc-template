<?php

namespace fastmvc\database;

use Dotenv\Dotenv;
use PDO;
use Exception;
use fastmvc\functions\Response;
use PDOException;

class Database
{
  protected $db;
  protected $statement;
  public function __construct()
  {
    $env =  Dotenv::createImmutable(__DIR__ . '../../../');
    $env->load();
    $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_DATABASE'];
    try {
      $opts = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false,
      ];
      $this->db = new PDO($dsn,  $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $opts);
    } catch (PDOException $e) {
      throw new Exception('Database: something went wrong' . $e->getMessage());
    }
  }
  public function prepare($sql)
  {
    return $this->db->prepare($sql);
  }
  public function query($sql, $params = [])
  {
    $this->statement = $this->prepare($sql);
    $this->statement->execute($params);
    return $this;
  }
  public function fetch()
  {
    return $this->statement->fetch();
  }
  public function get()
  {
    return $this->statement->fetchAll();
  }
  public function find()
  {
    return $this->statement->fetch();
  }
  public function findOrFail()
  {
    $result = $this->find();
    if (!$result) {
      $this->abort(Response::FORBIDDENT);
    }
    // solve the issue of Database::paragraph not found
    foreach ($result as $key => $value) {
      if ($value === null) {
        throw new Exception("Database: Missing attribute '$key'");
      }
    }
    return $result;
  }


  protected  function abort($code = 404)
  {
    http_response_code(404);
    require_once "views/{$code}.php";
    die();
  }
}
