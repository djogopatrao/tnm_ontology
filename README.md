# TNM Ontology

This is a formal model representing the rules for clinical stage (CS) evaluation according to the 6th edition of [TNM](https://www.uicc.org/resources/tnm). It was developed at the Center for International Research (CIPE) from the [A.C. Camargo Cancer Center](http://www.accamargo.org.br) (São Paulo, Brazil).

If you use data or code in your work, please cite our [conference paper](http://ceur-ws.org/Vol-1442/paper_6.pdf):

*An Ontology for TNM Clinical Stage Inference. Felipe Massicano, Ariane Sasso, Henrique Amaral-Silva, Michel Oleynik, Calebe Nobrega, and Diogo F. C. Patrão. ONTOBRAS, São Paulo, Brazil. 2015. Available at http://ceur-ws.org/Vol-1442/paper_6.pdf.*


## Creating the axioms

```
    $ ./create_rdf_axioms.py > ontologies/axioms.owl
```


## Creating the annotations

```
    $ ./scriptCidTNM.py [-p|--prefixTNM] uri_tnm [-c|--prefixICD10] uri_icdo > ontologies/annotations.rdf
```

For example:
```
./scriptCidTNM.py -p http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl -c http://cipe.accamargo.org.br/ontologies/tnm_6e_icdo_topographies.owl > ontologies/annotations.rdf
```

[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)
