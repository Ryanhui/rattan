#!perl
open IN,"communities_links";
while(<IN>){
	chomp;
	if(/:/){
		$_=~s/://g;
		$arr1=sprintf "%04d", $_;
		open OUT,">Module$arr1";
	}else{
		print OUT "$_\n";
		
		}

}