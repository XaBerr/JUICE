<?php
  jRequire("PdoAdapterMysql.php");
  class PdoAdapterSqLiteFile extends PdoAdapterMysql {
      public $connection;
      public function __construct( $_srv, $_db, $_usr, $_pass ) {
        try {
          $this->connection = new PDO("sqlite:$_srv");
        } catch( Exception $e ) {
          throw new JException($e->getMessage());
        }
      }
      public function newTable( $_sql ) {
        try {
          $temp = $this->connection->exec($_sql);
        } catch (Exception $e) {
          throw new JException($e->getMessage());
        }
        return $temp;
      }
  }
?>
