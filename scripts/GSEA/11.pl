#!perl
open IN,"$ARGV[0]";
open OUT,">$ARGV[1]";
#open OUT1,">Module_id_0.05";
while(<IN>){
	chomp;
	@arr=split '\t',$_;
	if($arr[5]<0.05){
		print OUT "$_\n";
		$hash{$arr[0]}=1;
	}
	
}
foreach(sort (keys %hash)){
#	print OUT1 $_,"\n";
}

