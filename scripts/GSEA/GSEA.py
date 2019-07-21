#!/usr/bin/python
import os, sys, re, urllib2, threading, operator
from random import uniform

class GSEA_analysis:
	'''The class is used to do the GeneSet Enrichment Analysis
	'''

	def __init__(self, session, jobId):
				self.session = session
				self.query = []
				self.genes_Group = {}
				self.geneSets_Group = {}
				self.paraList = {}
				self.overlap_num = {}
				self.geneSet_geNum = {}
				self.geneSet_desp = {}
				self.overlap = {}
				self.customizedDB = []
				self.tmpGeneList = []
				self.locus2set = {}
				self.category = []
				self.jobId = jobId

		
		
	def fetchparam(self):
		for line in open('tmp/'+self.jobId+'/Module_annotation.conf'):   # fetch para
			list = line.split()
			if len(list) == 2:
				self.paraList[list[0]] = list[1]#
		for line in open('Category_Num.txt'):
			list = line.strip().split('\t')
			self.genes_Group[list[0]] = list[1]#species gene number
			self.geneSets_Group[list[0]] = list[2]#species geneset number
		for line in open('tmp/'+self.jobId+'/%s.query' % self.session):
			self.query.append(line.strip())

	def OverlapAnalysis(self, grp_type):
		flag = 0
		for line in open('database/%s' % grp_type):
			match = 0
			self.locus2set = {}
			list=line.strip().split('\t')
			self.geneSet_desp[list[0]] = list[1]
			for locus in list[2].split(','):
				self.locus2set[locus.upper()] = list[0]
			for li in self.query:
				if li.upper() in self.locus2set.keys():
					match += 1	
					if list[0] not in self.overlap:
						self.overlap[list[0]] = [li]
					else:
						self.overlap[list[0]].append(li)
			if match == 0:
				pass
			else:
				flag +=1
				Rinput = '%s\t%s\t%s\t%s\t%s\n' % (list[0],match,len(self.query),len(list[2].split(',')),self.genes_Group[grp_type] ) 
				open('tmp/'+self.jobId+'/%s_%s.RInputFile' % (self.session,grp_type), 'a+').write(Rinput)
				self.overlap_num[list[0]] = match 
				self.geneSet_geNum[list[0]] = len(list[2].split(','))

		if flag == 0:
			ferr = open('tmp/'+self.jobId+'/%s_%s.NullResult' % (self.session,grp_type), 'w')
			ferr.close()

		# 2)create R command files
		self.Rcommandwrite(grp_type)

	def CustomizedOverlapAnalysis(self, grp_type):
		# create tmp database for each category
		for line in open('tmp/'+self.jobId+'/%s.background' % self.session):
			self.customizedDB.append(line.strip())

		flag = 0
		for line in open('database/%s' % grp_type):
			self.tmplocus2set = {}
			self.locus2set = {}
			match = 0
			list=line.strip().split('\t')
			self.geneSet_desp[list[0]] = list[1]
			for locus in list[2].split(','):
				self.locus2set[locus.upper()] = list[0]
			for li in self.customizedDB:
				if li.upper() in self.locus2set.keys():
					self.tmplocus2set[li.upper()] = list[0]
				
			for li2 in self.query:
				if li2.upper() in self.tmplocus2set.keys():
					match += 1
					if list[0] not in self.overlap:
						self.overlap[list[0]] = [li2]
					else:
						self.overlap[list[0]].append(li2)
			if match == 0:
				pass
			else:
				flag +=1
				Rinput = '%s\t%s\t%s\t%s\t%s\n' % (list[0],match,len(self.query),len(self.tmplocus2set.keys()),len(self.customizedDB) )
				open('tmp/'+self.jobId+'/%s_%s.RInputFile' % (self.session,grp_type), 'a+').write(Rinput)
				self.overlap_num[list[0]] = match
				self.geneSet_geNum[list[0]] = len(self.tmplocus2set.keys())

		if flag == 0:
			ferr = open('tmp/'+self.jobId+'/%s_%s.NullResult' % (self.session,grp_type), 'w')
			ferr.close()

		# 2)create R command files
		self.Rcommandwrite(grp_type)

	def Rcommandwrite(self, grp_type):
		fout = open('tmp/'+self.jobId+'/%s_%s.RcommandFile' % (self.session,grp_type), 'w')
		tm = self.paraList['testMethod']
		method = {'dhyper': 'mat2<-matrix(c(d[i,2],d[i,4],d[i,3]-d[i,2],d[i,5]-d[i,4]),nrow=2)\npv[i]<-fisher.test(mat2,alternative="greater")$p.value\n',
		'fisher': 'mat2<-matrix(c(d[i,2],d[i,4],d[i,3]-d[i,2],d[i,5]-d[i,4]),nrow=2)\npv[i]<-fisher.test(mat2,alternative="greater")$p.value\n',
		'chi2': 'mat2<-matrix(c(d[i,2],d[i,4],d[i,3]-d[i,2],d[i,5]-d[i,4]),nrow=2)\npv[i]<-chisq.test(mat2)$p.value\nif(d[i,2]/d[i,3]<d[i,4]/d[i,5]){pv[i]=1}\n',
		}

		str_pre="""
		d<-read.delim("tmp/"""+self.jobId+"""/%s_%s.RInputFile", header=F)
		pv<-array(dim=dim(d)[1])
		for(i in 1:dim(d)[1]){
		%s
		}
		pa<-p.adjust(pv,"%s")
		output<-list(d[,1], pv, pa)
		write.table(output,file="tmp/"""+self.jobId+"""/%s_%s.Routput",col.names=FALSE,row.names=FALSE,sep="\\t",quote=F)
		""" 
		str = str_pre % (self.session, grp_type, method[tm], self.paraList['mt'], self.session,grp_type)
        #.Routput
		#DESCRIPTION	p-value(fisher or....)	p-adjust_value
		#CARBOHYDRATE_METABOLIC_PROCESS	0.472677619897233	1
		#REGULATION_OF_TRANSCRIPTION,_DNA-DEPENDENT	0.0429980067278948	0.363367403341223
		#OXIDATION-REDUCTION_PROCESS	0.203314444852545	0.757113067561071
		#
		#
		#.RInputFile
		#AP2_CONFIRMED	3	237	165	28775
		#ATBHLH15_CONFIRMED	1	237	189	28775
		#ATMYB124_CONFIRMED	1	237	13	28775
		fout.write(str)
		fout.close()		

	def RstatisticAnalysis(self):
		# call R, using threads to shorten process time
		for line in open('tmp/'+self.jobId+'/Module_annotation.category'):
			self.category.append(line.strip())
		threads = []
		nloops = range(len(self.category))
		
		for i in self.category:
			t = threading.Thread(target=self.callR, args=(self.session, i))
			threads.append(t)
		
		for i in nloops:
			threads[i].start()
	
		for i in nloops:
			threads[i].join()
		
	def callR(self, session, grp_type):
		str_pre = 'R CMD BATCH tmp/'+self.jobId+'/%s_%s.RcommandFile tmp/'+self.jobId+'/%s_%s.Rout'
		os.system(str_pre % (self.session,grp_type,self.session,grp_type))
		


	def detail(self, grp_type):
		str_pre = 'tmp/'+self.jobId+'/%s_%s.Routput'
		if os.path.exists(str_pre % (self.session,grp_type)):
			for line in open(str_pre % (self.session,grp_type) ):
				list=line.strip().split('\t')
				#object_1=re.match(r'Module(\d+)', self.session)
				#number_1=object_1.group(1)
				detail = '%s\t%s\t%s\t%s\t%s\t%s\t%s\n' % (list[0],self.geneSet_geNum[list[0]],self.geneSet_desp[list[0]],self.overlap_num[list[0]],list[1],list[2],self.overlap[list[0]] )
				#CARBOHYDRATE_METABOLIC_PROCESS	507	GO:0005975   carbohydrate metabolic process,    GOslim:biological_process	1	0.472677619897233	1	['PH01000086G1290']
				#REGULATION_OF_TRANSCRIPTION,_DNA-DEPENDENT	1060	GO:0006355   regulation of transcription, DNA-dependent,    GOslim:biological_process	4	0.0429980067278948	0.363367403341223	['PH01000044G0540', 'PH01000138G0430', 'PH01000305G0690', 'PH01000069G1210']
				#OXIDATION-REDUCTION_PROCESS	1244	GO:0055114   oxidation-reduction process,    GOslim:biological_process	3	0.203314444852545	0.757113067561071	['PH01001044G0510', 'PH01000019G1400', 'PH01250366G0010']
				open('tmp/'+self.jobId+'/%s.detail' % (self.session), 'a+').write(detail)

