### Creating the axioms.
-----------------------

    $ ./create_rdf_axioms.py> ontologies/axiomas.owl

### Creating the annotations.
---------------------------

    $ ./scriptCidTNM.py [-p|--prefixTNM] uri_tnm [-c|--prefixICD10] uri_icdo > ontologies/annotations.rdf

    Ex: ./scriptCidTNM.py -p http://cipe.accamargo.org.br/ontologias/tnm_6a_edicao.owl -c http://cipe.accamargo.org.br/ontologias/tnm_6e_icdo_topographies.owl > ontologies/annotations.rdf
