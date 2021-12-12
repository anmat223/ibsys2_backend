<?php
class DatabaseService
{
  private $servername = "db5005991693.hosting-data.io";
  private $username = "dbu1651509";
  private $password = "iYc9FjJMnxSx";
  private $databaseName = "dbs5019310";
  private $connectionString = "mysql:host=";

  public function __get($property)
  {
    if (property_exists($this, $property)) {
      return $this->property;
    }
  }

  function createDatabase()
  {
    try {
      $conn = new PDO("$this->connectionString$this->servername", $this->username, $this->password);

      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DROP DATABASE IF EXISTS $this->databaseName";

      $conn->exec($sql);

      $sql = "CREATE DATABASE $this->databaseName";

      $conn->exec($sql);
    } catch (PDOException $e) {
      echo $e->getMessage();
    } finally {
      $conn = null;
    }
  }

  function createTables()
  {
    try {
      $conn = new PDO("$this->connectionString$this->servername;dbname=$this->databaseName", $this->username, $this->password);

      $sql = file_get_contents('start.sql');

      $conn->exec($sql);
    } catch (PDOException $e) {
      echo $e->getMessage();
    } finally {
      $conn = null;
    }
  }

  function insertPredifinedData()
  {
    try {
      $conn = new PDO("$this->connectionString$this->servername;dbname=$this->databaseName", $this->username, $this->password);

      $sql = file_get_contents('data.sql');

      $conn->exec($sql);
    } catch (PDOException $e) {
      echo $e->getMessage();
    } finally {
      $conn = null;
    }
  }

  function insert($table, $values)
  {
    try {
      $conn = new PDO("$this->connectionString$this->servername;dbname=$this->databaseName", $this->username, $this->password);

      $sql = "INSERT INTO $table VALUES ($values)";

      $conn->exec($sql);
    } catch (PDOException $e) {
      echo $e->getMessage();
    } finally {
      $conn = null;
    }
  }

  function read($table, $columns, $join = "", $arguments = "", $order = "")
  {
    try {
      $conn = new PDO("$this->connectionString$this->servername;dbname=$this->databaseName", $this->username, $this->password);

      $sql = "SELECT $columns FROM $table ";

      if (isset($join) && $join !== "") {
        $sql = $sql . "$join ";
      }

      if (isset($arguments) && $arguments !== "") {
        $sql = $sql . "WHERE $arguments ";
      }

      if (isset($order) && $order !== "") {
        $sql = $sql . "ORDER BY $order";
      }

      $sql = $sql . ";";

      $q = $conn->query($sql);

      $q->setFetchMode(PDO::FETCH_ASSOC);

      $results = [];

      while ($row = $q->fetch()) {
        array_push($results, $row);
      }

      return $results;
    } catch (PDOException $e) {
      echo $e->getMessage();
    } finally {
      $conn = null;
    }
  }
}
