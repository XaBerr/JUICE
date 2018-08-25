<?php
  class Project {
    public static function getDetail( $_project ) {
      $dir = getcwd();
      $projectPath = "$dir/projects/$_project";
      $logs = Git::getLog($projectPath);
      $projectLogs = [];
      $project = [];
      if($logs != []) {
        // Git project
        foreach ( $logs as $log ) {
          $project = [];
          $project["name"]    = $_project;
          $project["author"]  = " - ";
          $project["tag"]     = "1.0.0";
          $project["date"]    = " - ";
          $project["message"] = " - ";
          $project["percent"] = 100;
          $project["buttons"] = false;
          $project["open"]    = false;
          // $gitBranches        = Git::getBranches($projectPath);
          // $gitContributors    = Git::getContributors($projectPath);
          // $project["numerOfCommits"]       = count($logs);
          // $project["numberOfBranches"]     = count($gitBranches);
          // $project["numberOfContributors"] = count($gitContributors);
          if(is_array($log)) {
            $projectTemp = $log;
            $project["author"]  = explode("<",$projectTemp["author"])[0];
            $project["tag"]     = $projectTemp["tag"];
            $project["date"]    = $projectTemp["date"];
            $project["message"] = $projectTemp["message"];
          }
          if(isset($project["tag"])) {
            $percent = explode(".", $project["tag"]);
            if(count($percent) > 2)
              $percent = 100 * intval($percent[0]) + 10 * intval($percent[1]) + intval($percent[2]);
            $project["percent"] = $percent;
          }
          $project["percentUnit"] = $project["percent"]%100;
          $projectLogs[] = $project;
        }
      } else {
        // NOT git project
        $project = [];
        $project["name"]    = $_project;
        $project["author"]  = " - ";
        $project["tag"]     = "1.0.0";
        $project["date"]    = " - ";
        $project["message"] = " - ";
        $project["percent"] = 100;
        $project["buttons"] = false;
        $project["open"]    = false;
        $projectLogs[] = $project;
      }
      return $projectLogs;
    }
  }
?>
