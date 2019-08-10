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

$job_id = $_GET["job_id"];
$job_dir = '/var/www/rattan/scripts/gsea/tmp/'.$job_id;

$str = 'perl /var/www/rattan/scripts/gsea/11.pl '.$job_dir.'/gene.sorted_detail '.$job_dir.'/gene.sorted_detail.0.05';
exec($str);

$str = 'perl /var/www/rattan/scripts/gsea/Module_table.pl '.$job_dir.'/gene.sorted_detail.0.05 '.$job_dir.'/gene.Module.table';
exec($str);

$file_path = $job_dir.'/gene.Module.table';
$return_data = new stdClass();
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
  
      $object->geneSetName= $line[0];
      $object->description= $line[1];
      $object->category = $line[2];
      $object->overlap = $line[3];
      $object->pvalue = $line[4];
      $object->fdr = $line[5];
  
      array_push($outArr, $object);
    }
  } while(!feof($file_arr));


  echo(json_encode($outArr));
}
?>