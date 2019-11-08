<?php
  header('Content-Type: application/x-www-form-urlencoded');

  #$iname = $_POST("gene");
  function cors() {
  
      // Allow from any origin
      if (isset($_SERVER['HTTP_ORIGIN'])) {
          // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
          // you want to allow, and if so:
          header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
          header('Access-Control-Allow-Credentials: true');
          header('Access-Control-Max-Age: 86400');    // cache for 1 day
      }
  
      // Access-Control headers are received during OPTIONS requests
      if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  
          if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
              // may also be using PUT, PATCH, HEAD etc
              header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
  
          if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
              header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
  
          exit(0);
      }
  
      #echo "You have CORS!";
  }
  cors();

  $gene_list = $_POST["gene_list"];
  $species = $_POST["species"];
  $jobid = $_POST["jobid"];

  $dir = '/var/www/rattan/motif/jobs/'.$jobid;
 
  if(!file_exists($dir)){//检查文件夹是否存在
    mkdir ($dir);    //没有就创建一个新文件夹
  }

  chmod($dir, 0777);

  $fafile = fopen($dir."/gene_list.file", "w") or die("Unable to open file!");

  fwrite($fafile, $gene_list);
  fclose($fafile);
  chmod($dir."/gene_list.file", 0777);

  $cmd = "perl /var/www/rattan/motif/scripts/Cis-name_scan.pl ".$species." " .$dir."/gene_list.file ".$dir."/out";
  #$cmd = 'perl /var/www/rattan/motif/scripts/Cis-sequence_scan.pl /var/www/rattan/motif/jobs/s1573127584000/promoter_sequence.fa Calsi /var/www/rattan/motif/jobs/s1573127584000/result';
  # echo($cmd);
  exec($cmd);
?>