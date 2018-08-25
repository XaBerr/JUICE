<?php
  declare( strict_types = 1 );
  // backward compatibility
  if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
  }
  use PHPUnit\Framework\TestCase;

  final class HtmlTest extends TestCase {
    public function testNoTemplateSet() {
      $this->expectException(JException::class);
      $app = new JConfig("tests/jate/modules/Html/file/app.json");
      $html = new TestHtml();
      $html->init();
      $html->setParameters(["app" => $app, "page" => []]);
      $html->draw();
    }
    public function testCorrectTemplateSet() {
      $app = new JConfig("tests/jate/modules/Html/file/app.json");
      $html = new TestHtml();
      $html->init();
      $html->setParameters(["app" => $app, "page" => []]);
      $html->setTemplate();
      $this->assertEquals("aaa", trim($html->draw()));
    }
  }
  class TestHtml extends Html {
    public function init() {
      setServerVar();
    }
    public function setTemplate() {
      $this->template = "tests/jate/modules/Html/file/template.html";
    }
  }
?>
