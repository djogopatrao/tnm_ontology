#!/usr/bin/python

import math
import os
import sys
import getopt

options, remainder = getopt.getopt(sys.argv[1:], 'p:', ['prefix='])

if not sys.argv[1:]:sys.exit('Error. You need to pass the prefix. For example, run \"./scriptCidTNM.py -p prefix\" ');

for opt, arg in options:
    if opt in ('-p', '--prefix'):
       prefix = arg;
    else:
       sys.exit('Error. You need to pass the prefix. For example, run \"./scriptCidTNM.py -p prefix\" ');


# print header RDF
print '''<?xml version="1.0"?>


<!DOCTYPE rdf:RDF [
	<!ENTITY terms "http://purl.org/dc/terms/" >
	<!ENTITY owl "http://www.w3.org/2002/07/owl#" >
	<!ENTITY xsd "http://www.w3.org/2001/XMLSchema#" >
	<!ENTITY rdfs "http://www.w3.org/2000/01/rdf-schema#" >
	<!ENTITY rdf "http://www.w3.org/1999/02/22-rdf-syntax-ns#" >
]>


<rdf:RDF xmlns="http://www.semanticweb.org/djogo/ontologies/2015/6/untitled-ontology-190#"
 	xml:base="http://www.semanticweb.org/djogo/ontologies/2015/6/untitled-ontology-190"
 	xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
 	xmlns:terms="http://purl.org/dc/terms/"
 	xmlns:owl="http://www.w3.org/2002/07/owl#"
 	xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
 	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
	<owl:Ontology rdf:about="http://www.semanticweb.org/djogo/ontologies/2015/6/untitled-ontology-190">
    	<owl:imports rdf:resource="http://www.w3.org/2004/02/skos/core"/>
	</owl:Ontology>
	
'''

for file in sorted(os.listdir("./map/annotations")):
    if file.endswith(".map"):
        # Opening the file and split it by \n
	arq = open("./map/annotations/" + file);
        seq = arq.read().rstrip().splitlines();

	key = [""];
	value = [""];

	for s in seq:	    
	    params = s.split(":",1);
	    key.append(params[0]);
	    value.append(params[1]);
            
	hashMap = dict(zip(key[1:], value[1:]));
	
	print ''
	print '''	<!-- %s --> ''' %(hashMap['classNameBase']);

	for j in hashMap:
	   if ['page','classNameBase','mappingLanguage','mappings','cid10'].count(j) == 1:
	      continue;

	   print '';

	   if len(hashMap['cid10'].split(",")) == 1:
	   
		print '''	<!-- &%s;:%s_%s -->

	<owl:Class rdf:about="&%s;%s_%s">
    	<rdfs:subClassOf rdf:resource="&%s;%s"/>
    	<rdfs:subClassOf rdf:resource="&%s;%s"/>
    	<terms:description xml:lang="%s">%s (pagina %s)</terms:description>
	</owl:Class>

	<owl:Class>
    	<rdfs:subClassOf rdf:resource="&%s;%s_%s"/>
    	<owl:intersectionOf rdf:parseType="Collection">
        	<rdf:Description rdf:about="&%s;%s"/>
        	<rdf:Description rdf:about="&%s;%s"/>
    	</owl:intersectionOf>
	</owl:Class>''' % ( prefix, hashMap['cid10'], j, 
                            prefix, hashMap['cid10'], j,
                            prefix, hashMap['cid10'],
                            prefix, j, 
                            hashMap['mappingLanguage'], hashMap[j], hashMap['page'], 
                            prefix, hashMap['cid10'], j,
                            prefix, hashMap['cid10'],
                            prefix, j)

	   else:
		print '''	<owl:Class rdf:about="&%s;%s"/>

	<owl:Class>
    	<rdfs:subClassOf rdf:resource="&%s;%s"/>
    	<owl:intersectionOf rdf:parseType="Collection">''' % (prefix, hashMap['classNameBase'], prefix, hashMap['classNameBase'])

		for cid in hashMap['cid10'].split(","):
			print '''        	<rdf:Description rdf:about="&%s;%s"/>''' % (prefix, cid.replace('.','_'))
			
		print '''    	</owl:intersectionOf>
	</owl:Class>

	<!-- &%s;%s_%s -->

	<owl:Class rdf:about="&%s;%s_%s">
    	<rdfs:subClassOf rdf:resource="&%s;%s"/>
    	<rdfs:subClassOf rdf:resource="&%s;%s"/>
    	<terms:description xml:lang="%s">%s (pagina %s)</terms:description>
	</owl:Class>

	<owl:Class>
    	<rdfs:subClassOf rdf:resource="&%s;%s_%s"/>
    	<owl:intersectionOf rdf:parseType="Collection">
        	<rdf:Description rdf:about="&%s;%s"/>
        	<rdf:Description rdf:about="&%s;%s"/>
    	</owl:intersectionOf>
	</owl:Class>''' % (prefix, hashMap['classNameBase'], j,
                           prefix, hashMap['classNameBase'], j,
                           prefix, hashMap['classNameBase'], 
                           prefix, j, 
                           hashMap['mappingLanguage'], hashMap[j], hashMap['page'],
                           prefix, hashMap['classNameBase'], j,
                           prefix, hashMap['classNameBase'], 
                           prefix, j)

print ''
print '''</rdf:RDF>'''   
