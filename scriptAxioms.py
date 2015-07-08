#!/usr/bin/python

import math
import os
import sys

for file in sorted(os.listdir("./map")):
    if file.endswith(".map"):
	#Opening the file and split it by \n
	arq = open('./map/' + file);
	seq = arq.read().split("\n");

	# The first line is the Class's name
	ClassName = seq[0];

        # The sencond line are CIDs
	cids = seq[1].split(" ");

	# Header
	print '<!-- ' + ClassName + '(',
	for cid in cids:
		print  cid,
	print ') -->'
	
	for cid in cids:
            for axioma in seq[2:(len(seq)-1)]:
                print '''     <owl:Class>
        <rdfs:subClassOf rdf:resource="&tnm;%s"/>
        <owl:intersectionOf rdf:parseType="Collection">
            <rdf:Description rdf:about="&tnm;%s"/>''' % (ClassName,cid)
                x = axioma.split(" ");
                for tnm in x:
                        print '            <rdf:Description rdf:about="&tnm;%s"/>' % (tnm)

                print '''        </owl:intersectionOf>
     </owl:Class>'''

print ''
