<?php
  declare( strict_types = 1 );
  // backward compatibility
  if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
  }
  use PHPUnit\Framework\TestCase;

  final class ParserTest extends TestCase {
    public function testParserTextWrongParametersInput() {
      $this->expectException(JException::class);
      Parser::parseText("", "");
    }
    public function testParserTextWrongTypeInput() {
      $this->expectException(JException::class);
      Parser::parseText("", [], []);
    }
    public function testParserTextWrongTextInput() {
      $this->expectException(JException::class);
      Parser::parseText([]);
    }
    public function testParserTextCorrectInputMD() {
      $temp = Parser::parseText("# hello", [], "md");
      $this->assertEquals('<h1>hello</h1>', $temp);
    }
    public function testParserTextCorrectInputTWIG() {
      $temp = Parser::parseText("{{h|raw}}", ["h"=>"<h1>hello</h1>"], "twig");
      $this->assertEquals('<h1>hello</h1>', $temp);
    }
    public function testParserTextCorrectInputPUG() {
      $temp = Parser::parseText("h1=h", ["h"=>"hello"], "pug");
      $this->assertEquals('<h1>hello</h1>', $temp);
    }
    public function testParserTextCorrectInputJTAG() {
      $temp = Parser::parseText("<_h_>", ["h"=>"<h1>hello</h1>"], "jate");
      $this->assertEquals('<h1>hello</h1>', $temp);
    }
    public function testParserFileWrongParametersInput() {
      $this->expectException(JException::class);
      Parser::parseFile("", "");
    }
    public function testParserFileWrongTypeInput() {
      $this->expectException(JException::class);
      Parser::parseFile("", [], []);
    }
    public function testParserFileWrongPathInput() {
      $this->expectException(JException::class);
      Parser::parseFile([]);
    }
    public function testParserFileCorrectInputMD() {
      $temp = Parser::parseFile("tests/jate/modules/Parser/file/test.md", [], "md");
      $this->assertEquals('<h1>hello</h1>', $temp);
    }
    public function testParserFileCorrectInputTWIG() {
      $temp = Parser::parseFile("tests/jate/modules/Parser/file/test.twig", ["h"=>"<h1>hello</h1>"], "twig");
      $this->assertEquals('<h1>hello</h1>', $temp);
    }
    public function testParserFileCorrectInputPUG() {
      $temp = Parser::parseFile("tests/jate/modules/Parser/file/test.pug", ["h"=>"hello"], "pug");
      $this->assertEquals('<h1>hello</h1>', $temp);
    }
    public function testParserFileCorrectInputJTAG() {
      $temp = Parser::parseFile("tests/jate/modules/Parser/file/test.jate", ["h"=>"<h1>hello</h1>"], "jate");
      $this->assertEquals('<h1>hello</h1>', $temp);
    }
  }

?>
