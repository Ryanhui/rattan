<?php
#header('Access-Control-Allow-Origin:*'); 
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

$genes=explode("\n", $_POST["genes"]);
$dataBase=$_POST["database"];
$type=$_POST["type"];

// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}
if ($dataBase == 'calsi') {
    $whichDataBase = 'CalsiMR';
} else {
    $whichDataBase = 'DaejeMR';
}

if($type == 'Positive') {
    $whichOrder = '>';
} else if($type == 'Negative'){
    $whichOrder = '<';
} else {
    $whichOrder = '<>';
}

$node = array();
$edge = array();

foreach ($genes as $gene) {
    $gene = trim($gene);
    $sql = 'SELECT * FROM '. $whichDataBase .' WHERE gene1="'. $gene . '"' . ' AND length' . $whichOrder .'0';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $__node = array();

        while($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
            array_push($node, $row["gene2"]);
            array_push($__node, $row["gene2"]);
            array_push($edge, array('id' => $row["gene1"].'-'.$row["gene2"], 'source' => $row["gene1"], 'target' => $row["gene2"], 'length' => $row["length"], 'mr' => $row["num1"]));
        }

        # search child node
        foreach ($__node as $childNode) { 
            $sql = 'SELECT gene1, gene2, num1, length  FROM '. $whichDataBase .' WHERE gene1="'. $childNode . '"' . '  AND length' . $whichOrder .'0';  
            $result2 = mysqli_query($conn, $sql) ;    
            if (mysqli_num_rows($result2) > 0) { 
                while($row = mysqli_fetch_assoc($result2)) { 
                    if(in_array($row["gene2"], $__node)) {  
                        array_push($edge, array('id' => $row["gene1"].'-'.$row["gene2"],'source' => $row["gene1"], 'target' => $row["gene2"], 'length' => $row["length"], 'mr' => $row["num1"]));
                    }
                }
            }
        }

    }    
}
    class RowData {

    }

    $rowData = new RowData();
    $rowData->root = $genes;
    $rowData->node = $node;
    $rowData->edge = $edge;
    
    echo json_encode($rowData);

?>