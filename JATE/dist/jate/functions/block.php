<?php
  jRequire("../modules/Parser/Parser.php");
  jRequire("../modules/JException/JException.php");
  function jBlock() {
    return ob_start();
  }

  function jBlockClose( $_type = "html", $_parameters = [] ) {
    return jBlockEnd($_type, $_parameters);
  }

  function jBlockFile( $_path, $_parameters = [] ) {
    try {
      $temp = Parser::parseFile($_path, $_parameters);
    } catch (Exception $e) {
      throw new JException($e->getMessage(), 1);
    }
    return $temp;
  }

  function view( $_path, $_parameters = [] ) {
    try {
      $temp = jBlockFile("bundles/views/$_path", $_parameters);
    } catch (Exception $e) {
      throw new JException($e->getMessage(), 1);
    }
    return $temp;
  }

  function sql( $_path, $_parameters = [] ) {
    try {
      $temp = jBlockFileMan("bundles/sql/$_path", "sql", $_parameters);
    } catch (Exception $e) {
      throw new JException($e->getMessage(), 1);
    }
    return $temp;
  }

  function jBlockFileMan( $_path, $_type, $_parameters = [] ) {
    try {
      $temp = Parser::parseFileMan($_path, $_parameters, $_type);
    } catch (Exception $e) {
      throw new JException($e->getMessage(), 1);
    }
    return $temp;
  }

  function jBlockEnd( $_type = "html", $_parameters = [] ) {
    $text = ob_get_clean();
    try {
      $temp = Parser::parseText($text, $_parameters, $_type);
    } catch (Exception $e) {
      throw new JException($e->getMessage(), 1);
    }
    return $temp;
  }

  function minifyOutput($_buffer) {
    $search = array ( '/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s' );
    $replace = array ( '>', '<', '\\1' );
    if (preg_match("/\<html/i",$_buffer) == 1 && preg_match("/\<\/html\>/i",$_buffer) == 1)
      $_buffer = preg_replace($search, $replace, utf8_decode($_buffer));
    return utf8_encode($_buffer);
  }
?>
