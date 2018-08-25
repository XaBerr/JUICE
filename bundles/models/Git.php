<?php
  class Git {
    public static function getLog( $_dir = "./" ) {
      if(!file_exists($_dir))
        return [];
      $currentDir = getcwd();
      chdir($_dir);
      $gitHistory  = [];
      $gitLogs    = [];
      $gitPath    = str_replace('\\', '/', exec("git rev-parse --show-toplevel"));
      $rootPath    = str_replace('\\', '/', getcwd ());
      $lastHash    = null;
      if( $gitPath != $rootPath ) {
        chdir($currentDir);
        return [];
      }
      exec("git log --decorate=full --tags", $gitLogs);
      foreach ($gitLogs as $line) {
        $line = trim($line);
        if (!empty($line)) {
          if (strpos($line, 'commit') === 0) {
            $hash = explode(' ', $line);
            $hash = trim(end($hash));
            $gitHistory[$hash] = [
              'tag'     => '-1.0.0',
              'author'  => '',
              'email'   => '',
              'date'    => '',
              'message' => ''
            ];
            $lastHash = $hash;
            if (strpos($line, 'tag') !== false) {
              $tag = explode(':', $line);
              $tag = explode('/', $tag[1]);
              $tag = explode(',', $tag[2]);
              $tag = explode(')', $tag[0]);
              $tag = trim($tag[0]);
              $gitHistory[$lastHash]['tag'] = $tag;
            }
          } else if (strpos($line, 'Author') === 0) {
            $author = explode(':', $line);
            $author = explode('<', trim(end($author)));
            $author = trim(isset($author[0]) ? $author[0] : "");
            $gitHistory[$lastHash]['author'] = $author;
            $email = explode('<', $line);
            $email = explode('>', trim(end($email)));
            $email = trim(isset($email[0]) ? $email[0] : "");
            $gitHistory[$lastHash]['email'] = $email;
          } else if (strpos($line, 'Date') === 0) {
            $date = explode(':', $line, 2);
            $date = trim(end($date));
            $gitHistory[$lastHash]['date'] = date('d/m/Y H:i:s A', strtotime($date));
          } else
            $gitHistory[$lastHash]['message'] .= $line;
        }
      }
      chdir($currentDir);
      return $gitHistory;
    }
    public static function getBranches( $_dir = "./" ) {
      if(!file_exists($_dir))
        return [];
      $currentDir = getcwd();
      chdir($_dir);
      $gitHistory = [];
      $gitLogs    = [];
      $gitPath    = str_replace('\\', '/', exec("git rev-parse --show-toplevel"));
      $rootPath   = str_replace('\\', '/', getcwd ());
      $lastHash   = null;
      if( $gitPath != $rootPath ) {
        chdir($currentDir);
        return [];
      }
      exec("git branch -a", $gitBranches);
      chdir($currentDir);
      return $gitBranches;
    }
    public static function getContributors( $_dir = "./" ) {
      if(!file_exists($_dir))
        return [];
      $currentDir = getcwd();
      chdir($_dir);
      $gitHistory = [];
      $gitLogs    = [];
      $gitPath    = str_replace('\\', '/', exec("git rev-parse --show-toplevel"));
      $rootPath   = str_replace('\\', '/', getcwd ());
      $lastHash   = null;
      if( $gitPath != $rootPath ) {
        chdir($currentDir);
        return [];
      }
      exec("git log --format='%aN' | sort -u ", $gitContributors);
      chdir($currentDir);
      return $gitContributors;
    }
  }
?>
