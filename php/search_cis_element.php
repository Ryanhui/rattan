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


  $gene_id = $_GET["gene_id"];
  $species = $_GET["species"];

  if($species == 'Calsi') {
    $whichDataBase = "Cis_Element_Calsi";
  } else {
    $whichDataBase = "Cis_Element_Daeje";
  }

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
  }
  
  $sql = 'SELECT * FROM '. $whichDataBase .' WHERE gene_id= "'. $gene_id . '";';
  
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $data = array();
    while($row = mysqli_fetch_assoc($result)) {
      array_push($data, $row);
    }
    echo json_encode($data);
  }
?>