<!DOCTYPE html>
<html>
<body>
<p style="width: 600px;word-break: break-word;">

<?php
    $servername = "127.0.0.1";
    $username = "rattan";
    $password = "rattan123";
    $dbname = "RATTAN";


    $gene_id = $_GET["gene_id"];
    $species = $_GET["species"];

    $whichDataBase = "Top300_".$species;

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("连接失败: " . mysqli_connect_error());
    }

    $data = array();

    $sql = 'SELECT * FROM '. $whichDataBase .' WHERE gene_from="'. $gene_id . '";';
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        array_push($data, $row);
      }
    }

    $html = '';
    foreach($data as $value){
        $html = $html.$value['gene_from'].' '.$value['gene_to'].' '.$value['polarity'].' '.$value['value']. '<br />';
    }

    echo $html;
?>

</p>
</body>
</html>