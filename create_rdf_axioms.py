#!/usr/bin/python

# Generate rdf file (ontology) of the axioms in owl extension
# Example usage: ./create_rdf_axioms.py> ontologies/axiomas.owl


import math
import os
import sys
import re

# print header RDF
print '''<?xml version="1.0"?>


<!DOCTYPE rdf:RDF [
	<!ENTITY terms "http://purl.org/dc/terms/" >
	<!ENTITY owl "http://www.w3.org/2002/07/owl#" >
	<!ENTITY xsd "http://www.w3.org/2001/XMLSchema#" >
	<!ENTITY rdfs "http://www.w3.org/2000/01/rdf-schema#" >
	<!ENTITY rdf "http://www.w3.org/1999/02/22-rdf-syntax-ns#" >
	<!ENTITY skos "http://www.w3.org/2004/02/skos/core#" >
    	<!ENTITY rdfs "http://www.w3.org/2000/01/rdf-schema#" >
    	<!ENTITY rdf "http://www.w3.org/1999/02/22-rdf-syntax-ns#" >
    	<!ENTITY recruit "http://cipe.accamargo.org.br/ontologias/recruit.owl#" >
    	<!ENTITY recruit_cid10 "http://cipe.accamargo.org.br/ontologias/recruit_cid10.owl#" >
    	<!ENTITY icdo "http://cipe.accamargo.org.br/ontologias/tnm_6e_icdo_topographies.owl#" >
    	<!ENTITY tnm "http://cipe.accamargo.org.br/ontologias/tnm_6a_edicao.owl#" >
 	<!ENTITY ncit "http://ncicb.nci.nih.gov/xml/owl/EVS/Thesaurus.owl#" >
]>


<rdf:RDF xmlns="http://cipe.accamargo.org.br/ontologias/axiomas.owl#"
 	xml:base="http://cipe.accamargo.org.br/ontologias/axiomas.owl"
 	xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
 	xmlns:terms="http://purl.org/dc/terms/"
 	xmlns:owl="http://www.w3.org/2002/07/owl#"
 	xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
 	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	xmlns:recruit_cid10="http://cipe.accamargo.org.br/ontologias/recruit_cid10.owl#"
    	xmlns:icdo="http://cipe.accamargo.org.br/ontologias/tnm_6e_icdo_topographies.owl#"
     	xmlns:recruit="http://cipe.accamargo.org.br/ontologias/recruit.owl#"
     	xmlns:skos="http://www.w3.org/2004/02/skos/core#"
 	xmlns:ncit="http://ncicb.nci.nih.gov/xml/owl/EVS/Thesaurus.owl#"
     	xmlns:tnm="http://cipe.accamargo.org.br/ontologias/tnm_6a_edicao.owl#">
    	<owl:Ontology rdf:about="http://cipe.accamargo.org.br/ontologias/axiomas.owl"/>

	
'''



for file in sorted(os.listdir("./map")):
    if file.endswith(".map"):
	#Opening the file and split it by \n
	arq = open('./map/' + file);
	seq = arq.read().split("\n");

	line = 0;
	# The first line is the Class's name
	ClassName = seq[line];
	line = line + 1;

	# if the second line begins with "ncit:", then that's the corresponding NCI thesaurus concept
	ncit_equivalent_to = "";
	m = re.compile("^ncit:\s*(.*)\s*$").match(seq[line]);
	if m:
		ncit_equivalent_to =  "<owl:equivalentClass rdf:resource=\"&ncit;" + m.group(1) + "\"/>";
		line = line + 1;

        # The sencond line are CIDs
	cids = seq[line].split(" ");
	line = line + 1;

	# Header
	print '<!-- ' + ClassName + '(',
	for cid in cids:
		print  cid,
	print ') -->'
	
	for cid in cids:
            for axioma in seq[line:(len(seq)-1)]:
		if ncit_equivalent_to:
			print '<owl:Class rdf:about="&tnm;%s">%s</owl:Class> ' % ( ClassName,ncit_equivalent_to );
                print '''     <owl:Class>
        <rdfs:subClassOf rdf:resource="&tnm;%s"/>
        <owl:intersectionOf rdf:parseType="Collection">
            <rdf:Description rdf:about="&icdo;%s"/>''' % (ClassName,cid)
                x = axioma.split(" ");
                for tnm in x:
                        print '            <rdf:Description rdf:about="&tnm;%s"/>' % (tnm)

                print '''        </owl:intersectionOf>
     </owl:Class>'''

print ''
print '''</rdf:RDF>'''   
