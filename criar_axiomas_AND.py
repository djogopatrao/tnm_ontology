#!/usr/bin/python

import math
import os
import sys 

name = sys.argv[1]
arq = open( './' + name);
seq = arq.read().split("\n");

# Primeira linha eh o nome da Classe
ClassName = seq[0];

# Segunda linha sao os CIDs
cids = seq[1].split(" ");

# Cabecalho
print '<!-- ' + ClassName + '(',
for cid in cids:
	print  cid,
print ') -->'

for cid in cids:
	for axioma in seq[2:(len(seq)-1)]: 	
		print '''     <owl:Class>
        <rdfs:subClassOf rdf:resource="&recruit;%s"/>
        <owl:intersectionOf rdf:parseType="Collection">
	<rdf:Description rdf:about="&recruit;%s"/>''' % (ClassName,cid)
		x = axioma.split(" ");
		for tnm in x:
			print '            <rdf:Description rdf:about="&recruit;%s"/>' % (tnm)

        	print '''        </owl:intersectionOf>
     </owl:Class>'''

print ''
