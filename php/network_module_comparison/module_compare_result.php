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

  $servername = "127.0.0.1";
  $username = "rattan";
  $password = "rattan123";
  $dbname = "RATTAN";

  $moduleA = trim($_GET["moduleA"]);
  $moduleB = trim($_GET["moduleB"]);
  // echo $moduleA,$moduleB;

  if (preg_match("/Calsi/i", $moduleA)) {
        $dirA = '/var/www/rattan/web_data/rattan_eo-expression/Module/Calsi_K6_community/';
        $dirB = '/var/www/rattan/web_data/rattan_eo-expression/Module/Daeje_community/';
    } else {
      $dirA = '/var/www/rattan/web_data/rattan_eo-expression/Module/Daeje_community/';
      $dirB = '/var/www/rattan/web_data/rattan_eo-expression/Module/Calsi_K6_community/';
    }

    $file_path_a = $dirA.$moduleA;
    $gene_array_a = array();
    $file_path_b = $dirB.$moduleB;
    $gene_array_b = array();

    function getRowdata($file_path) {
      $gene_array = array();
      if(file_exists($file_path)) {
        $file_arr = fopen($file_path, "r");
        do {
          $line = fgets($file_arr);
          $line = str_replace("\t", "^", $line);
          $line = explode("^", $line);
          $object = new stdClass();
      
          $object->gene_a = $line[1];
          $object->gene_b = $line[2];
      
          array_push($gene_array, $line[1], $line[2]);
        } while(!feof($file_arr));
        return array_values(array_filter(array_unique($gene_array)));
        //return array_unique($gene_array);
        // echo json_encode($returnData);
      }
    }
    $gene_array_a = getRowdata($file_path_a);
    $gene_array_b = getRowdata($file_path_b);

    // echo gettype($gene_array_a);
    // return;
    // echo json_encode($gene_array_a), json_encode($gene_array_b);


  $servername = "127.0.0.1";
  $username = "rattan";
  $password = "rattan123";
  $dbname = "RATTAN";

//   $dataBaseA = '';
//   $dataBaseB = '';
  $dataBaseCalsi_Daeje_doublemax3 = 'Calsi_Daeje_doublemax3';
  
  // $geneAData = array();
  // $geneBData = array();
  $geneRelation = array();

//   if (preg_match("/Calsi/i", $geneA)) {
//         $dataBaseA = 'CalsiMR';
//         $dataBaseB = 'DaejeMR';
//     } else {
//         $dataBaseA = 'DaejeMR';
//         $dataBaseB = 'CalsiMR';
//     }
// //   $whichDataBase  = 'Calsi_Daeje_doublemax3';

//   $conn = mysqli_connect($servername, $username, $password, $dbname);

//   // Check connection
//   if (!$conn) {
//       die("连接失败: " . mysqli_connect_error());
//   }

//   $sql = 'SELECT * FROM '. $dataBaseA .' WHERE gene1="'. $geneA . '"';
//   $result = mysqli_query($conn, $sql);
//   if (mysqli_num_rows($result) > 0) {
//     while($row = mysqli_fetch_assoc($result)) {
//       array_push($geneAData, $row);
//     }
//   } else {
//     //   array_push($geneAData, null);
//   }
//   $selfobject = array("gene2"=>$geneA, 'isRootA'=>true);
//   array_push($geneAData, $selfobject);

//   $sql = 'SELECT * FROM '. $dataBaseB .' WHERE gene1="'. $geneB . '"';
//   $result = mysqli_query($conn, $sql);
//   if (mysqli_num_rows($result) > 0) {
//     while($row = mysqli_fetch_assoc($result)) {
//       array_push($geneBData, $row);
//     }
//   } else {
//     //   array_push($geneBData, null);
//   }
//   $selfobject = array("gene2"=>$geneB, 'isRootB'=>true);
//   array_push($geneBData, $selfobject);

  foreach($gene_array_a as $singleGeneA) {
    foreach($gene_array_b as $singleGeneB) {
        $sql = 'SELECT * FROM '. $dataBaseCalsi_Daeje_doublemax3 .' WHERE gene_a="'. $singleGeneA . '" AND gene_b="'. $singleGeneB . '"';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              array_push($geneRelation, $row);
            }
        }
        $sql2 = 'SELECT * FROM '. $dataBaseCalsi_Daeje_doublemax3 .' WHERE gene_a="'. $singleGeneB . '" AND gene_b="'. $singleGeneA . '"';
        $result2 = mysqli_query($conn, $sql2);
        if (mysqli_num_rows($result2) > 0) {
            while($row2 = mysqli_fetch_assoc($result2)) {
              array_push($geneRelation, $row2);
            }
        }
    }
  }

  $tableData = array();
  foreach($geneRelation as $item) {
    $sql = 'SELECT * FROM Calsi_Daeje_double_Annotation' .' WHERE gene_a="'. $item["gene_a"] . '" AND gene_b="'. $item["gene_b"] . '"';
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          array_push($tableData, $row);
        }
    }
  }

  $object = new stdClass();
  
  // echo gettype($gene_array_a);
  $object->moduleAdata = $gene_array_a;
  $object->moduleBdata = $gene_array_b;
  $object->geneRelation = $geneRelation;
  $object->tableData = $tableData;
  echo json_encode($object);
?>