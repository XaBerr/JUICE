<?php
  declare( strict_types = 1 );
  // backward compatibility
  if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
  }
  use PHPUnit\Framework\TestCase;

  final class RouterTest extends TestCase {
    public function testRouterWrongParametersInput() {
      $this->expectException(JException::class);
      setServerVar();
      $router = new Router([]);
    }
    public function testRouterWrongPathInput() {
      $this->expectException(JException::class);
      setServerVar();
      $router = new Router("tests/jate/modules/Router/file/test.json");
    }
    public function testRouterCorrectHomePage() {
      setServerVar();
      $router = new Router("tests/jate/modules/Router/file/testHome.json");
      $this->assertEquals(["Home",[]], $router->getPage());
    }
    public function testRouterCorrectDefaultPage() {
      setServerVar();
      $router = new Router("tests/jate/modules/Router/file/testDefault.json");
      $this->assertEquals(["Page404",[]], $router->getPage());
    }
    public function testRouterCorrectParameters() {
      setServerVar();
      $router = new Router("tests/jate/modules/Router/file/testParameters.json");
      $this->assertEquals(["Home",[1,2,3]], $router->getPage());
    }
    public function testRouterCasesensitivePage() {
      setServerVar();
      $router = new Router("tests/jate/modules/Router/file/testCasesensitive.json", true);
      $this->assertEquals(["Page404",[]], $router->getPage());
    }
  }

  function setServerVar() {
    $_SERVER["HTTP_HOST"]   = "localhost";
    $_SERVER["REQUEST_URI"] = "/JUICE/projects/JATE/examples/01essential/Home";
    $_SERVER["PHP_SELF"]    = "/JUICE/projects/JATE/examples/01essential/index.php";
  }
?>
