#!/usr/bin/python
import os, sys, re, threading, urllib2
from random import uniform

session = sys.argv[1]
species = sys.argv[2]
jobId = sys.argv[3]

affy2locus = {}
query_array = {}
paraList = {}
redundancy =  {}

#print jobId
# print os.getcwd()
# print sys.path[0]
os.chdir(sys.path[0])

for line in open('tmp/'+jobId+'/Module_annotation.conf'):   # fetch para
	list = line.split()
	if len(list) == 2:
		paraList[list[0]] = list[1]

if os.path.isfile('database/%s.affy2locus' % species):
	for line in open('database/%s.affy2locus' % species):
		list = line.strip().split('\t')
		affy2locus[list[0]] = list[1]

for line in open('tmp/'+jobId+'/%s.file' % session):
	list = line.strip().split()
	m = re.match('.*\_at', str(list))
	if len(list) != 1:
		ferr = open('tmp/'+jobId+'/%s.FormatError' % session, 'w')
		ferr.close()
		sys.exit()
	elif m is not None:
		if list[0] in affy2locus:
			fin = open('tmp/'+jobId+'/%s.tmp.query' % session, 'a')
			array = affy2locus[list[0]].split('#')
			for locus in array:
				fin.write('%s\n' % locus)
			fin.close()
	else:
		fin = open('tmp/'+jobId+'/%s.tmp.query' % session, 'a')
		for item in list:
			fin.write('%s\n' % item)
		fin.close()

# remove query redundancy
for line2 in open('tmp/'+jobId+'/%s.tmp.query' % session):
	query_array[line2.strip()] = 1

fin = open('tmp/'+jobId+'/%s.query' % session, 'a')
for key in query_array:
	fin.write('%s\n' % key)
fin.close()

# remove bgList redundancy
if paraList["bgtype"] == "customized":   
	for line3 in open('tmp/'+jobId+'/%s.bgfile' % session):
		query_array[line3.strip()] = 1
	fin = open('tmp/'+jobId+'/%s.background' % session, 'a')
	for key in query_array:
		fin.write('%s\n' % key)
	fin.close()

# create file with redundant list
for line in open('tmp/'+jobId+'/%s.file' % session):
	if line.strip() not in redundancy:
		redundancy[line.strip()] = 1
	else:
		redundancy[line.strip()] += 1
fin = open('tmp/'+jobId+'/%s.redu.query' % session, 'a')
for key in redundancy:
	if redundancy[key] > 1:
		fin.write('%s\n' % key)
fin.close()

os.system("python annotation.py %s %s" % (session,jobId))
