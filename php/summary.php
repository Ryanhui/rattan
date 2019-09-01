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

  $TF_Daeje = '/var/www/rattan/annotation_summary/TF/Daeje';
  $TF_Calsi = '/var/www/rattan/annotation_summary/TF/Calsi';
  $Cazy_Daeje = '/var/www/rattan/annotation_summary/Cazy/Daeje';
  $Cazy_Calsi = '/var/www/rattan/annotation_summary/Cazy/Calsi';

  $object = new stdClass();
  
  $handler = opendir($TF_Daeje);
  while (($filename = readdir($handler)) !== false) {//务必使用!==，防止目录下出现类似文件名“0”等情况
      if ($filename != "." && $filename != "..") {
              $files[] = $filename;
         }
     }
  $object->TF_Daeje = $files;
  closedir($handler);

  $handler = opendir($TF_Calsi);
  unset($files);
  while (($filename = readdir($handler)) !== false) {//务必使用!==，防止目录下出现类似文件名“0”等情况
      if ($filename != "." && $filename != "..") {
              $files[] = $filename;
         }
     }
  $object->TF_Calsi = $files;
  closedir($handler);

  $handler = opendir($Cazy_Daeje);
  unset($files);
  while (($filename = readdir($handler)) !== false) {//务必使用!==，防止目录下出现类似文件名“0”等情况
      if ($filename != "." && $filename != "..") {
              $files[] = $filename;
         }
     }
  $object->Cazy_Daeje = $files;
  closedir($handler);

  $handler = opendir($Cazy_Calsi);
  unset($files);
  while (($filename = readdir($handler)) !== false) {//务必使用!==，防止目录下出现类似文件名“0”等情况
      if ($filename != "." && $filename != "..") {
              $files[] = $filename;
         }
     }
  $object->Cazy_Calsi = $files;
  closedir($handler);

  echo json_encode($object);
  //打印所有文件名
  // foreach ($files as $value) {
  //   echo $value;
  // }
  //echo json_encode($files);
?>