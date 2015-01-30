# ===========================
#  Jordan Brooker
#  Extracting Primate alignments
# ===========================

import re

def extraction(fileName):
	InputFileName = fileName
	InFile = open(InputFileName, 'r')
	score = 0
	s_lines = ''
	info = ''
	stringy = ''
	strings = ''
	for line in InFile:
		#a = re.search('^a\s+(.+)',line)
		# only need to search for ten sources (primates, human, mouse)...
		s = re.search('^s\s+((hg19|papHam1|otoGar1|panTro2|gorGor1|calJac1|tarSyr1|ponAbe2|micMur1|rehMac2|mm9)\..+)\s+(\d+)\s+(\d+)\s+([+,-])\s+\d+\s+(.+)$',line)
		#s = re.search('^s\s+(.+\..+)\s+(\d+)\s+\d+\s+([+,-])\s+\d+\s+(.+)$',line)
		ss = re.search('([A*a*C*c*G*g*T*t*\-]*)',line)
		# could add a search for q
		i = re.search('^i\s+(hg19|papHam1|otoGar1|panTro2|gorGor1|calJac1|tarSyr1|ponAbe2|micMur1|rehMac2|mm9)\..+\s+(.+)',line)
		e = re.search('^\s*$',line)
		#if a:
		#	score = a.group(1)
		if s:
			s_lines = s_lines + "\n" + str(s.group(1) + " " + str(s.group(3)) + " " + str(s.group(4)) + " " + str(s.group(5)) + " "
		if ss:
			s_lines = s_lines + ss.group(1)
		if i:
			info = info + "\n" + i.group(1)
		if e:
			stringy = score + "\n" + s_lines + info + "\n\n"
			strings = strings + stringy
			s_lines = ''
			stringy = ''
			info = ''
	InFile.close()
	OutFileName = 'extract2.txt'
	OutFile = open(OutFileName,'w')
	OutFile.write(strings)
	OutFile.close()

#extraction("chr1.maf")
#extraction("chr2.maf")
#extraction("chr3.maf")
#extraction("chr4.maf")
#extraction("chr5.maf")
#extraction("chr6.maf")
#extraction("chr7.maf")
#extraction("chr8.maf")
#extraction("chr9.maf")
#extraction("chr10.maf")
#extraction("chr11.maf")
#extraction("chr12.maf")
#extraction("chr13.maf")
#extraction("chr14.maf")
#extraction("chr15.maf")
#extraction("chr16.maf")
#extraction("chr17.maf")
#extraction("chr18.maf")
#extraction("chr19.maf")
#extraction("chr20.maf")
#extraction("chr21.maf")
#extraction("chr22.maf")
#extraction("chrX.maf")
#extraction("chrY.maf")

extraction("example.maf")


