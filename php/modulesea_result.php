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

$rfile_path = $job_dir.'/ModuleSea_plot.R';
$rfile=fopen($rfile_path, "w");
$rstr='
library("ggplot2")
library("export")
setwd("/var/www/rattan/scripts/gsea/tmp/'.$job_id.'")
plot_data = read.csv("/var/www/rattan/scripts/gsea/tmp/'.$job_id.'/gene.Module.table",header=FALSE,check.names = FALSE,sep = "\t")
plot_data<-plot_data[-1,]
plot_data$V4<-as.matrix(plot_data$V4)
plot_data$V6<-as.matrix(plot_data$V6)
plot_data$V5<-as.matrix(plot_data$V5)
plot_data$V6<-as.numeric(plot_data$V6)
plot_data$V4<-as.numeric(plot_data$V4)
plot_data$V5<-as.numeric(plot_data$V5)
GSEA_dotplot<-ggplot(plot_data,aes(-log10(V6),V1)) +geom_point(aes(size=V4,color=V6))+scale_color_gradient(low="orange",high ="light blue")+labs(color=expression(FDR),size="Gene counts",x="-log10(FDR)",y="Gene sets",title="Gene set enrichment")
ggsave("GSEA_dotplot.pdf",GSEA_dotplot)
dotplot_filename<-"dotplot"
graph2ppt(x=GSEA_dotplot,file=dotplot_filename)

plot_data = plot_data[order(plot_data[,6]),]
GSEA_barplot<-ggplot(plot_data,aes(x=reorder(V1,-V6),y=V4))+geom_bar(stat="identity",aes(fill=V6))+coord_flip()+scale_color_gradient(low="light blue",high ="orange")+labs(x="Gene sets",y="Gene counts",title="Gene set enrichment")+labs(fill = "FDR")+coord_flip()+scale_fill_gradient(high = "light blue", low = "orange", na.value = "grey50", space = "Lab",lim = c(min(plot_data$V6), max(plot_data$V6)))
ggsave("GSEA_barplot.pdf",GSEA_barplot)
barplot_filename<-"barplot"
graph2ppt(x=GSEA_barplot,file=barplot_filename)
';
fputs($rfile, $rstr);
fclose($rfile);

$str = 'Rscript '.$job_dir.'/ModuleSea_plot.R';
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