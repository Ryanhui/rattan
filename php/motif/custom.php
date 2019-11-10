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
  #echo json_encode($_POST);

  $gene_list = $_POST["gene_list"];
  $species = $_POST["species"];
  $motifs = $_POST["motifs"];
  $jobid = $_POST["jobid"];

  $dir = '/var/www/rattan/motif/jobs/'.$jobid;

  if(!file_exists($dir)){//检查文件夹是否存在
    mkdir ($dir);    //没有就创建一个新文件夹
  }

  chmod($dir, 0777);

  $fafile = fopen($dir."/promoter_sequence.fa", "w") or die("Unable to open file!");

  fwrite($fafile, $gene_list);
  fclose($fafile);
  chmod($dir."/promoter_sequence.fa", 0777);

  $cmd = "perl /var/www/rattan/motif/scripts/custom_search.pl ".$dir."/promoter_sequence.fa ".$motifs." ".$dir."/result1 ".$dir."/resutl2";
  exec($cmd);
?>