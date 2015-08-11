<?php
// php extract dump configuration file
$config = array(
        'mysqli' => array('192.18.0.146','infomed','lbc02bio','bancos_clinicos'),
        'maps'=>array(
//MAP_TNM_G
//MAP_G1
                array(
                        'sql' => "select ID from bancos_clinicos.RHC where G='1'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{ID}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#G1> .
'
                ),
//MAP_G2
                array(
                        'sql' => "select ID from bancos_clinicos.RHC where G='2'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{ID}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#G2> .
'
                ),
//MAP_G3
                array(
                        'sql' => "select ID from bancos_clinicos.RHC where G='3'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{ID}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#G3> .
'
                ),
//MAP_G4
                array(
                        'sql' => "select ID from bancos_clinicos.RHC where G='4'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{ID}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#G4> .
'
                ),
        )
);
