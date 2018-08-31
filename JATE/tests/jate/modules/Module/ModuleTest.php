<?php
  declare( strict_types = 1 );
  // backward compatibility
  if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
  }
  use PHPUnit\Framework\TestCase;

  final class ModuleTest extends TestCase {
    public function testAddModuleWrongTypeInput() {
      $this->expectException(JException::class);
      $module = new Module();
      $module->addModule(123);
    }
    public function testAddModuleWrongClassInput() {
      $this->expectException(JException::class);
      $module = new Module();
      $module->addModule((object)[1,2,3]);
    }
    public function testAddModuleCorrectClassInput() {
      $module = new Module();
      $module->addModule(new ModuleForTest());
      $this->assertEquals(1, count($module->modules));
    }
    public function testAddModulesWrongTypeInput() {
      $this->expectException(JException::class);
      $module = new Module();
      $module->addModules(123);
    }
    public function testAddModulesWrongClassInput() {
      $this->expectException(JException::class);
      $module = new Module();
      $module->addModules([(object)[1,2,3]]);
    }
    public function testAddModulesCorrectClassInput() {
      $module = new Module();
      $module->addModules([new ModuleForTest()]);
      $this->assertEquals(1, count($module->modules));
    }
  }

  class ModuleForTest extends Module {}
?>
