### TNM Ontology

This is an formal model representing the rules for clinical stage (CS) evaluation according to the 6th edition of TNM. For details, please refer to our conference paper:

https://www.researchgate.net/publication/283089126_An_Ontology_for_TNM_Clinical_Stage_Inference?ev=prf_pub


### Creating the axioms.
-----------------------

    $ ./create_rdf_axioms.py > ontologies/axioms.owl

### Creating the annotations.
---------------------------

    $ ./scriptCidTNM.py [-p|--prefixTNM] uri_tnm [-c|--prefixICD10] uri_icdo > ontologies/annotations.rdf

    Ex: ./scriptCidTNM.py -p http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl -c http://cipe.accamargo.org.br/ontologies/tnm_6e_icdo_topographies.owl > ontologies/annotations.rdf
