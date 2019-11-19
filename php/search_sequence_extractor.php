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

    $species = $_POST["species"];
    $sequences = $_POST["sequences"];
    $type = $_POST["type"];

    if($type == 'promoter1k') {
        $whichDataBase = "SE_".$species.'_1k_promoter';
    }

    if($type == 'promoter2k') {
        $whichDataBase = "SE_".$species.'_2k_promoter';
    }

    if($type == 'promoter3k') {
        $whichDataBase = "SE_".$species.'_3k_promoter';
    }

    if($type == 'domainCds') {
        $whichDataBase = "SE_".$species.'_Domain_Cds';
    }

    if($type == 'domainPep') {
        $whichDataBase = "SE_".$species.'_Domain_Pep';
    }

    if($type == 'geneWhole') {
        $whichDataBase = "SE_".$species.'_Gene_Whole';
    }

    if($type == 'geneCds') {
        $whichDataBase = "SE_".$species.'_Gene_Cds';
    }

    if($type == 'genePep') {
        $whichDataBase = "SE_".$species.'_Gene_Pep';
    }


    $conn = mysqli_connect($servername, $username, $password, $dbname);
  
    if (!$conn) {
      die("连接失败: " . mysqli_connect_error());
    }

    $data = array();
    $sequences = explode("\n", $sequences);
    
    foreach ($sequences as $key => $value) {
      $sql = 'SELECT * FROM '. $whichDataBase .' WHERE gene_id="'. $value . '";';
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          array_push($data, $row);
        }
      }
    }
    
    echo json_encode($data);
?>