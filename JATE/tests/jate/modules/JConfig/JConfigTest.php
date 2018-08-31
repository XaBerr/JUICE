<?php
  declare( strict_types = 1 );
  // backward compatibility
  if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
  }
  use PHPUnit\Framework\TestCase;

  final class JConfigTest extends TestCase {
    public function testWrongTypeInput() {
      $this->expectException(JException::class);
      $jConfig = new JConfig(0);
    }
    public function testWrongPath() {
      $this->expectException(JException::class);
      $jConfig = new JConfig("something.json");
    }
    public function testBadJson() {
      $this->expectException(JException::class);
      $jConfig = new JConfig("tests/jate/modules/JConfig/json/bad.json");
    }
    public function testCorrectPath() {
      $this->assertInstanceOf(
        JConfig::class,
        new JConfig("tests/jate/modules/JConfig/json/array.json")
      );
    }
    public function testArray() {
      $jConfig = new JConfig("tests/jate/modules/JConfig/json/array.json");
      $this->assertEquals([1,2,3], $jConfig->data);
    }
    public function testObject() {
      $jConfig = new JConfig("tests/jate/modules/JConfig/json/object.json");
      $this->assertEquals(1, $jConfig->par1);
    }
  }
?>
