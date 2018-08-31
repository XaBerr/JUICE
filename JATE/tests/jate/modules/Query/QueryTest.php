<?php
  declare( strict_types = 1 );
  // backward compatibility
  if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
  }
  use PHPUnit\Framework\TestCase;

  final class QueryTest extends TestCase {
    public function testAddConnectionWrongPath() {
      $this->expectException(JException::class);
      $Query = $this->getMockForTrait("Query");
      $Query->addConnection("Error");
    }
    public function testAddConnectionCorrectPath() {
      $Query = $this->getMockForTrait("Query");
      $Query->addConnection("tests/jate/modules/Query/file/connection.json");
      $this->assertTrue($Query->currentConnection != null);
    }
    public function testQuery() {
      $jConfig = new JConfig("tests/jate/modules/Connection/file/connection.json");
      $Query = $this->getMockForTrait("Query");
      $Query->addConnection("tests/jate/modules/Query/file/connection.json");
      $Query->newTable(
        "CREATE TABLE IF NOT EXISTS tests (
          id INTEGER PRIMARY KEY,
          test TEXT
          time INTEGER
        )"
      );
      $Query->query(
        "INSERT INTO tests
        (test)
        VALUES
        ('message1'),
        ('message2')
        "
      );
      $this->assertEquals(['message1', 'message2'], $Query->queryArray("SELECT test FROM tests"));
    }
  }
?>
