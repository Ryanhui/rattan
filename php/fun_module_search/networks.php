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

  $id = $_GET["id"];
 
  if (preg_match("/Calsi/i", $id, $matches))
  {
    $file_path = '/var/www/rattan/searchData/Module/Calsi_community/'.$id;
  }
  else
  {
    $file_path = '/var/www/rattan/searchData/Module/Daeje_community/'.$id;
  }

 
  if(file_exists($file_path)) {
    $file_arr = fopen($file_path, "r");
    $outArr = array();
    $firstline = fgets($file_arr);
    do {
      $line = fgets($file_arr);
      #echo($line);
      if($line != '') {
        $line = str_replace("\t", "^", $line);
        $line = explode("^", $line);
        $object = new stdClass();
    
        $object->id= $line[1].$line[2];
        $object->source= $line[1];
        $object->target = $line[2];
        $object->distance = $line[3];
        $object->value2 = $line[4];
        $object->value3 = $line[5];
        $object->value4 = $line[6];
        
        array_push($outArr, $object);
      }
    } while(!feof($file_arr));
  }
  echo json_encode($outArr);
?>