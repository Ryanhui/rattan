#!perl
open IN,"$ARGV[0]";
open OUT,">$ARGV[0].table_out";
while(<>){
	if(/KEGG/){
		$category="KEGG"
		}
	elsif(/GOslim/){
		$category="GO"
		}else{
			$category="GFam"
			};
	s/,\s+GOslin.*?\t//g;
	@arr=split /\t/,$_;
	$arr[0]=~s/.*://;
	@description=split /\s/,$arr[2];
	print "$arr[0]($arr[1])\t$arr[2]\t$category\t$arr[3]\t$arr[4]\t$arr[5]\n";
	}
