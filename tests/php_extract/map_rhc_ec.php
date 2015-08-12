<?php
// php extract dump configuration file
$config = array(
        'mysqli' => array('192.18.0.146','infomed','lbc02bio','bancos_clinicos'),
        'maps'=>array(
//MAP_EC like comment
//MAP_EC_0
//MAP_EC_I
//MAP_EC_IA
//MAP_EC_IB
//MAP_EC_IC
//MAP_EC_II
//MAP_EC_IIA
//MAP_EC_IIB
//MAP_EC_IIC
//MAP_EC_III
//MAP_EC_IIIA
//MAP_EC_IIIB
//MAP_EC_IIIC
//MAP_EC_IV
//MAP_EC_IVA
//MAP_EC_IVB
//MAP_EC_IVC
                array(
                        'sql' => "SELECT ID, if(char_length(TOPO)=4, concat(substring( TOPO,1,3),'_',substring(TOPO,4,4)),substring_index( TOPO,'','1')) as cd_cid, DSCTOPO, ec  FROM bancos_clinicos.RHC",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{ID}> <http://www.w3.org/2000/01/rdf-schema#comment> "Expected CS: {cd_cid}={DSCTOPO} - EC_{ec}"^^xsd:string .
'
                ),
                array(
                        'sql' => "SELECT ID, ec  FROM bancos_clinicos.RHC",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{ID}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#EC_{ec}> .
'
                ),

        )
);
