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

  $geneA = trim($_GET["geneA"]);
  $geneB = trim($_GET["geneB"]);

  $servername = "127.0.0.1";
  $username = "rattan";
  $password = "rattan123";
  $dbname = "RATTAN";

  $dataBaseA = '';
  $dataBaseB = '';
  $dataBaseCalsi_Daeje_doublemax3 = 'Calsi_Daeje_doublemax3';
  
  $geneAData = array();
  $geneBData = array();
  $geneRelation = array();

  if (preg_match("/Calsi/i", $geneA)) {
        $dataBaseA = 'CalsiMR';
        $dataBaseB = 'DaejeMR';
    } else {
        $dataBaseA = 'DaejeMR';
        $dataBaseB = 'CalsiMR';
    }
//   $whichDataBase  = 'Calsi_Daeje_doublemax3';

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
      die("连接失败: " . mysqli_connect_error());
  }

  $sql = 'SELECT * FROM '. $dataBaseA .' WHERE gene1="'. $geneA . '"';
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($geneAData, $row);
    }
  } else {
    //   array_push($geneAData, null);
  }
  $selfobject = array("gene2"=>$geneA, 'isRootA'=>true);
  array_push($geneAData, $selfobject);

  $sql = 'SELECT * FROM '. $dataBaseB .' WHERE gene1="'. $geneB . '"';
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      array_push($geneBData, $row);
    }
  } else {
    //   array_push($geneBData, null);
  }
  $selfobject = array("gene2"=>$geneB, 'isRootB'=>true);
  array_push($geneBData, $selfobject);

  foreach($geneAData as $singleGeneA) {
    foreach($geneBData as $singleGeneB) {
        $sql = 'SELECT * FROM '. $dataBaseCalsi_Daeje_doublemax3 .' WHERE gene_a="'. $singleGeneA["gene2"] . '" AND gene_b="'. $singleGeneB["gene2"] . '"';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              array_push($geneRelation, $row);
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
  
  $object->geneAdata = $geneAData;
  $object->geneBdata = $geneBData;
  $object->geneRelation = $geneRelation;
  $object->tableData = $tableData;
  echo json_encode($object);
?>