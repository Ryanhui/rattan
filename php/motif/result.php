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

  $jobid = $_GET["jobid"];
  $type = $_GET["type"];

  $job_dir = '/var/www/rattan/motif/jobs/'.$jobid;

  if($type == 'sequence') {
    $return_data = new stdClass();
    
    $file_path = $job_dir.'/out.Cis_results';

    if(file_exists($file_path)) {
        $file_arr = fopen($file_path, 'r');
        $detail_data = array();
        do {
            $line = fgets($file_arr);
            $line = str_replace(PHP_EOL, '', $line);
            $line = str_replace("\t", "^", $line);
            $line = explode("^", $line);

            $temp_data = new stdClass();
            $temp_data->motif_id = $line[0];
            $temp_data->motif_name = $line[1];
            $temp_data->motif_pattern = $line[2];
            $temp_data->motif_counts = $line[3];
            $temp_data->bg1k = $line[4];
            $temp_data->bg2k = $line[5];
            $temp_data->bg3k = $line[6];

            array_push($detail_data, $temp_data);
        } while(!feof($file_arr));
      
        $return_data->cis_result = $detail_data;
    }

    $file_path2 = $job_dir.'/promoter_sequence.fa.length';
    if(file_exists($file_path2)) {
      $file_arr = fopen($file_path2, 'r');
      $detail_data = array();
      do {
          $line = fgets($file_arr);
          $line = str_replace(PHP_EOL, '', $line);
          $line = str_replace(" ", "^", $line);
          $line = explode("^", $line);

          $temp_data = new stdClass();
          $temp_data->sequence_id = $line[0];
          $temp_data->length = $line[1];

          array_push($detail_data, $temp_data);
      } while(!feof($file_arr));
    
      $return_data->length = $detail_data;
  }
    echo json_encode($return_data);
  }

  if($type == 'name') {
    echo 'yes';
    $return_data = new stdClass();
    
    $file_path = $job_dir.'/out.Cis-name_scan.results';
    echo $file_path;

    if(file_exists($file_path)) {
      $file_arr = fopen($file_path, 'r');
      $detail_data = array();
      do {
          $line = fgets($file_arr);
          $line = str_replace(PHP_EOL, '', $line);
          $line = str_replace("\t", "^", $line);
          $line = explode("^", $line);

          $temp_data = new stdClass();
          $temp_data->motif_id = $line[0];
          $temp_data->motif_name = $line[1];
          $temp_data->motif_counts = $line[2];

          array_push($detail_data, $temp_data);
      } while(!feof($file_arr));
    
      $return_data->name_result = $detail_data;
    }
    echo json_encode($return_data);
  }
?>