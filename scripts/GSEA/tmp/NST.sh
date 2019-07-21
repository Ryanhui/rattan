for i in `ls *gene`;do echo "python annotation_pre.py $i Calsi"; done >VND_enrichment.sh
for i in `ls *gene`;do `mv $i $i.file`; done
mv VND_enrichment.sh ../
cd ../
nohup ParaFly -c VND_enrichment.sh -CPU 50 2>&1 &
cd tmp/
for i in `ls *sorted_detail`;do `perl ../11.pl $i`;done
