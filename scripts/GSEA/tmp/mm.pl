$co_enrichment="*05";
@co_enrichments=glob( $co_enrichment);
open OUT,">>dotplot.data";
$line1="DESCRPTION";
foreach $co(@co_enrichments){
	#$line1=$line."\t$co";
	open IN,"$co";
	while(<IN>){
		@arr=split '\t',$_;
		$hash2{$co}=$hash2{$co}.$arr[0];
		$hash1{$arr[0]}="";
	}
}

foreach $arr1(keys %hash1 ){
	foreach $co(@co_enrichments){
		if($hash2{$co}=~/$arr1/){
			$hash1{$arr1}.="1\t";
		}else{
			$hash1{$arr1}.="0\t";
		}
	}


}
#print OUT "$line1\n";
foreach $arr1(keys %hash1 ){
	print OUT "$arr1\t$hash1{$arr1}\n";
}