### Creating the axioms.
-----------------------

    $ ./create_rdf_axioms.py > ontologies/axioms.owl

### Creating the annotations.
---------------------------

    $ ./scriptCidTNM.py [-p|--prefixTNM] uri_tnm [-c|--prefixICD10] uri_icdo > ontologies/annotations.rdf

    Ex: ./scriptCidTNM.py -p http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl -c http://cipe.accamargo.org.br/ontologies/tnm_6e_icdo_topographies.owl > ontologies/annotations.rdf
