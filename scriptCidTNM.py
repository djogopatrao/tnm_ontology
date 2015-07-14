#!/usr/bin/python

import math
import os
import sys
import getopt

options, remainder = getopt.getopt(sys.argv[1:], 'p:c:', ['prefix=prefixICD10='])

errmsg = 'Error. You need to pass the URI parameters. For example, run \"./scriptCidTNM.py -p http://TNMURI/ -c http://prefixICD10/\" ';

if not sys.argv[2:]:sys.exit(errmsg);

prefix = 0;
prefixICD10 = 0;

for opt, arg in options:
    if opt in ('-p', '--prefixTNM'):
       prefix = 'tnm';
       uri = arg;
    if opt in ('-c', '--prefixICD10'):
       uriICD10 = arg;
       prefixICD10 = 'icd10';


if not prefix or not prefixICD10:
    sys.exit(errmsg);


# print header RDF
print '''<?xml version="1.0"?>


<!DOCTYPE rdf:RDF [
	<!ENTITY terms "http://purl.org/dc/terms/" >
	<!ENTITY owl "http://www.w3.org/2002/07/owl#" >
	<!ENTITY xsd "http://www.w3.org/2001/XMLSchema#" >
	<!ENTITY rdfs "http://www.w3.org/2000/01/rdf-schema#" >
	<!ENTITY rdf "http://www.w3.org/1999/02/22-rdf-syntax-ns#" >
 	<!ENTITY ncit "http://ncicb.nci.nih.gov/xml/owl/EVS/Thesaurus.owl#" >
	<!ENTITY %s "%s#" >
	<!ENTITY %s "%s#" >
]>


<rdf:RDF xmlns="http://cipe.accamargo.org.br/ontologies/tnm_annotations#"
 	xml:base="http://cipe.accamargo.org.br/ontologies/tnm_annotations"
 	xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
 	xmlns:terms="http://purl.org/dc/terms/"
 	xmlns:owl="http://www.w3.org/2002/07/owl#"
 	xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
 	xmlns:ncit="http://ncicb.nci.nih.gov/xml/owl/EVS/Thesaurus.owl#"
 	xmlns:%s="%s#"
 	xmlns:%s="%s#"
 	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
	<owl:Ontology rdf:about="http://cipe.accamargo.org.br/ontologies/tnm_annotations">
        <terms:license rdf:resource="http://www.apache.org/licenses/LICENSE-2.0"/>
	</owl:Ontology>
	
''' % (prefixICD10,uriICD10,prefix,uri,prefixICD10,uriICD10,prefix,uri);

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

           tnmClassWithICD10 = "&" + prefix + ";" + hashMap['cid10'] + "_" + j;
           tnmClass = "&" + prefix + ";" + j;
           icd10Class = "&" + prefixICD10 + ";" + hashMap['cid10'];

           descList = hashMap[j].split("|");
           description = descList[0];
           nciThesaurusCode = "";
           if len(descList)>1:
                   nciThesaurusIRI = "&ncit;"+descList[1];
	           nciThesaurusCode = "<owl:equivalentClass rdf:resource=\"" + nciThesaurusIRI + "\"/>";

	   if len(hashMap['cid10'].split(",")) == 1:
	   
		print '''	<!-- %s -->

	<owl:Class rdf:about="%s">
    	<rdfs:subClassOf rdf:resource="%s"/>
    	<rdfs:subClassOf rdf:resource="%s"/>
    	<terms:description xml:lang="%s">%s (pagina %s)</terms:description>
	%s
	</owl:Class>

	<owl:Class>
    	<rdfs:subClassOf rdf:resource="%s"/>
    	<owl:intersectionOf rdf:parseType="Collection">
        	<rdf:Description rdf:about="%s"/>
        	<rdf:Description rdf:about="%s"/>
    	</owl:intersectionOf>
	</owl:Class>''' % ( tnmClassWithICD10, 
                            tnmClassWithICD10,
                            icd10Class,
                            tnmClass, 
                            hashMap['mappingLanguage'], description, hashMap['page'], 
                            nciThesaurusCode,
                            tnmClassWithICD10,
                            icd10Class,
                            tnmClass)

	   else:
		print '''	<owl:Class rdf:about="&%s;%s">
		<rdfs:subClassOf rdf:resource="&tnm;TopographicsGroups"/>
	</owl:Class>

	<owl:Class>
        <terms:description>This is an automatically generated class</terms:description>
    	<rdfs:subClassOf rdf:resource="&%s;%s"/>
    	<owl:intersectionOf rdf:parseType="Collection">''' % (prefix, hashMap['classNameBase'], prefix, hashMap['classNameBase'])

		for cid in hashMap['cid10'].split(","):
			print '''        	<rdf:Description rdf:about="&%s;%s"/>''' % (prefixICD10, cid.replace('.','_'))
			
		print '''    	</owl:intersectionOf>
	</owl:Class>

	<!-- &%s;%s_%s -->

	<owl:Class rdf:about="&%s;%s_%s">
    	<rdfs:subClassOf rdf:resource="&%s;%s"/>
    	<rdfs:subClassOf rdf:resource="&%s;%s"/>
	%s
    	<terms:description xml:lang="%s">%s (pages %s)</terms:description>
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
                           nciThesaurusCode,
                           hashMap['mappingLanguage'], description, hashMap['page'],
                           prefix, hashMap['classNameBase'], j,
                           prefix, hashMap['classNameBase'], 
                           prefix, j)

print ''
print '''</rdf:RDF>'''   
