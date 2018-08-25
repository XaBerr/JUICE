<?php
  declare( strict_types = 1 );
  // backward compatibility
  if (!class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
  }
  use PHPUnit\Framework\TestCase;

  final class FileTest extends TestCase {
    public function testAddFileWrongTypeInput() {
      $this->expectException(JException::class);
      $file = $this->getMockForTrait("File");
      $file->addFile(123);
    }
    public function testAddFileRequiredWrongTypeInput() {
      $this->expectException(JException::class);
      $file = $this->getMockForTrait("File");
      $file->addFileRequired(123);
    }
    public function testAddFilesWrongTypeInput() {
      $this->expectException(JException::class);
      $file = $this->getMockForTrait("File");
      $file->addFiles("/file.php");
    }
    public function testAddFilesRequiredWrongTypeInput() {
      $this->expectException(JException::class);
      $file = $this->getMockForTrait("File");
      $file->addFilesRequired("/file.php");
    }
    public function testAddFileBadPathInput() {
      $this->expectException(JException::class);
      $file = $this->getMockForTrait("File");
      $file->addFile("tests/jate/modules/File/file/test2.js");
    }
    public function testAddFileRequiredBadPathInput() {
      $this->expectException(JException::class);
      $file = $this->getMockForTrait("File");
      $file->addFileRequired("tests/jate/modules/File/file/test2.js");
    }
    public function testAddFilesBadPathInput() {
      $this->expectException(JException::class);
      $file = $this->getMockForTrait("File");
      $file->addFiles(["tests/jate/modules/File/file/test2.js"]);
    }
    public function testAddFilesRequiredBadPathInput() {
      $this->expectException(JException::class);
      $file = $this->getMockForTrait("File");
      $file->addFilesRequired(["tests/jate/modules/File/file/test2.js"]);
    }
    public function testAddFileCorrectPathInput() {
      $file = $this->getMockForTrait("File");
      $file->addFile("tests/jate/modules/File/file/test.js");
      $this->assertEquals(["tests/jate/modules/File/file/test.js"], $file->getFiles());
    }
    public function testAddFileRequiredCorrectPathInput() {
      $file = $this->getMockForTrait("File");
      $file->addFileRequired("tests/jate/modules/File/file/test.js");
      $this->assertEquals(["tests/jate/modules/File/file/test.js"], $file->getFilesRequired());
    }
    public function testAddFilesCorrectPathInput() {
      $file = $this->getMockForTrait("File");
      $file->addFiles(["tests/jate/modules/File/file/test.js"]);
      $this->assertEquals(["tests/jate/modules/File/file/test.js"], $file->getFiles());
    }
    public function testAddFilesRequiredCorrectPathInput() {
      $file = $this->getMockForTrait("File");
      $file->addFilesRequired(["tests/jate/modules/File/file/test.js"]);
      $this->assertEquals(["tests/jate/modules/File/file/test.js"], $file->getFilesRequired());
    }
  }
?>
