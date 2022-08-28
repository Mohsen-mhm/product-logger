<?php

class DB
{

  protected $host = "localhost";
  protected $dbname = "product_logger";
  protected $username = "root";
  protected $password = "";
  
  public function conn()
  {
    $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
  }
}
