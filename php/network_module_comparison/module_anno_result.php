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

  if (preg_match("/Calsi/i", $moduleA)) {
        $searchTableA = 'Calsi_Module_Annotation';
        $searchTableB = 'Daeje_Module_Annotation';
    }   else {
        $searchTableA = 'Daeje_Module_Annotation';
        $searchTableB = 'Calsi_Module_Annotation';
  }

  $servername = "127.0.0.1";
  $username = "rattan";
  $password = "rattan123";
  $dbname = "RATTAN";


  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
      die("连接失败: " . mysqli_connect_error());
  }

  $data = array();
  $sql = 'SELECT * FROM '. $searchTableA .' WHERE module_id'.'="'. $moduleA . '"';
  
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    // echo json_encode($data);
  } else {
      echo null;
  }

  $sql2 = 'SELECT * FROM '. $searchTableB .' WHERE module_id'.'="'. $moduleB . '"';
  
  $result2 = mysqli_query($conn, $sql2);

  if (mysqli_num_rows($result2) > 0) {
    while($row2 = mysqli_fetch_assoc($result2)) {
        $data[] = $row2;
    }
    // 
  } else {
      echo null;
  }
  echo json_encode($data);
?>