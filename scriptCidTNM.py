#!/usr/bin/python

import math
import os
import sys

# for file in sorted(os.listdir("./map/annotations")):
    # if file.endswith(".map"):
        # Opening the file and split it by \n
# arq = open("./map/annotations/mama.map");
arq = open("./map/annotations/cavidadeNasalESeiosParanasais.map");
seq = arq.read().strip().split("\n");

key = [""];
value = [""];

for s in seq:
    params = s.split(":",1);
    key.append(params[0]);
    value.append(params[1]);

hashMap = dict(zip(key[1:], value[1:]));

for j in hashMap:
   if ['page','classNameBase','mappingLanguage','mappings','cid10'].count(j) == 1:
      continue;
   print '';
   print j + ' <----> ' + hashMap[j];
   print '';

   if len(hashMap['cid10'].split(",")) == 1:
   
   	print '''	<!-- &prefix;:%s_%s -->

	<owl:Class rdf:about="&prefix;:%s_%s">
    	<rdfs:subClassOf rdf:resource="&prefix;:%s"/>
    	<rdfs:subClassOf rdf:resource="&prefix;:%s"/>
    	<terms:description xml:lang="%s">%s (pagina %s)</terms:description>
	</owl:Class>

	<owl:Class>
    	<rdfs:subClassOf rdf:resource="&prefix;:%s_%s"/>
    	<owl:intersectionOf rdf:parseType="Collection">
        	<rdf:Description rdf:about="&prefix;:%s"/>
        	<rdf:Description rdf:about="&prefix;:%s"/>
    	</owl:intersectionOf>
	</owl:Class>''' % (hashMap['cid10'],j,hashMap['cid10'],j,hashMap['cid10'],j, hashMap['mappingLanguage'], hashMap[j],hashMap['page'], hashMap['cid10'],j,hashMap['cid10'],j)

   else:
	print '''	<owl:Class rdf:about="&prefix;:%s"/>

	<owl:Class>
    	<rdfs:subClassOf rdf:resource="&prefix;:%s"/>
    	<owl:intersectionOf rdf:parseType="Collection">''' % (hashMap['classNameBase'], hashMap['classNameBase'])

	for cid in hashMap['cid10'].split(","):
        	print '''        	<rdf:Description rdf:about="&prefix;:%s"/>''' % (cid)
        	
	print '''    	</owl:intersectionOf>
	</owl:Class>

	<!-- &prefix;:%s_%s -->

	<owl:Class rdf:about="&prefix;:%s_%s">
    	<rdfs:subClassOf rdf:resource="&prefix;:%s"/>
    	<rdfs:subClassOf rdf:resource="&prefix;:%s"/>
    	<terms:description xml:lang="%s">%s (pagina %s)</terms:description>
	</owl:Class>

	<owl:Class>
    	<rdfs:subClassOf rdf:resource="&prefix;:%s_%s"/>
    	<owl:intersectionOf rdf:parseType="Collection">
        	<rdf:Description rdf:about="&prefix;:%s"/>
        	<rdf:Description rdf:about="&prefix;:%s"/>
    	</owl:intersectionOf>
	</owl:Class>''' % (hashMap['classNameBase'], j,hashMap['classNameBase'], j,hashMap['classNameBase'], j, hashMap['mappingLanguage'],hashMap[j],hashMap['page'],hashMap['classNameBase'], j , hashMap['classNameBase'], j)
