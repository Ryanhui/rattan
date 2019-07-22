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

$job_id = time();
$job_dir = '/var/www/rattan/scripts/gsea/tmp/'.$job_id;
mkdir($job_dir, 0777);
chmod($job_dir, 0777);

#echo json_encode($_POST);

$newGeneFile = fopen($job_dir.'/gene.file', "w") or die("Unable to open file!");
$txt = $_POST["textarea"];
fwrite($newGeneFile, $txt);
fclose($newGeneFile);

chmod($job_dir.'/gene.file', 0777);

$Module_annotation_conf = fopen($job_dir.'/Module_annotation.conf', 'w') or die('Unable to open file!');
$species = $_POST["species"];
$background = $_POST["background"];
$testMethod = $_POST["testMethod"];
$mt = $_POST["adjustmentMethod"];
$cutoff = $_POST["level"];
fwrite($Module_annotation_conf ,"species ".$species.PHP_EOL);
fwrite($Module_annotation_conf, "bgtype ".$background.PHP_EOL);
fwrite($Module_annotation_conf, "testMethod ".$testMethod.PHP_EOL);
fwrite($Module_annotation_conf, "mt ".$mt.PHP_EOL);
fwrite($Module_annotation_conf, "cutoff ".$cutoff);
fclose($Module_annotation_conf);
chmod($job_dir.'/Module_annotation.conf', 0777);

$Module_annotation_category = fopen($job_dir.'/Module_annotation.category','w') or die('Unable to open file!'); 
$rawcata = $_POST["database"];
$cata = explode(',', $rawcata);
foreach($cata as $value) {
    fwrite($Module_annotation_category, $species.'_'.$value.PHP_EOL);
}
fclose($Module_annotation_category);
chmod($job_dir.'/Module_annotation.category', 0777);

echo($job_id);
exec("python /var/www/rattan/scripts/gsea/annotation_pre.py gene ".$species.' '.$job_id." 2>&1",$array);

// echo(json_encode($array));
?>