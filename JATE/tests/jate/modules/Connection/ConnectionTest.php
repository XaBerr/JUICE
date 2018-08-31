<?php
  declare( strict_types = 1 );
  // backward compatibility
  if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
  }
  use PHPUnit\Framework\TestCase;

  final class ConnectionTest extends TestCase {
    public function testWrongTypeInput() {
      $this->expectException(JException::class);
      $connection = new Connection("Error");
    }
    public function testCorrectTypeInput() {
      $jConfig = new JConfig("tests/jate/modules/Connection/file/connection.json");
      $this->assertInstanceOf(Connection::class, new Connection($jConfig));
    }
  }
?>
