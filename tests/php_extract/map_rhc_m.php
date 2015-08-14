<?php
// php extract dump configuration file
$config = array(
        'mysqli' => array('192.18.0.146','infomed','lbc02bio','bancos_clinicos'),
        'maps'=>array(
//MAP_TNM
//MAP_M0
                array(
                        'sql' => "select RHC, ADM from bancos_clinicos.RHC where M='0'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTestTumor{RHC}_{ADM}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#M0> .
'
                ),
//MAP_M1
                array(
                        'sql' => "select RHC, ADM from bancos_clinicos.RHC where M='1'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTestTumor{RHC}_{ADM}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#M1> .
'
                ),
//MAP_M1a
                array(
                        'sql' => "select RHC, ADM from bancos_clinicos.RHC where M='1A'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTestTumor{RHC}_{ADM}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#M1a> .
'
                ),
//MAP_M1b
                array(
                        'sql' => "select RHC, ADM from bancos_clinicos.RHC where M='1B'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTestTumor{RHC}_{ADM}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#M1b> .
'
                ),
//MAP_M1c
                array(
                        'sql' => "select RHC, ADM from bancos_clinicos.RHC where M='1C'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTestTumor{RHC}_{ADM}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#M1c> .
'
                ),
//MAP_MX
                array(
                        'sql' => "select RHC, ADM from bancos_clinicos.RHC where M='X'",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTestTumor{RHC}_{ADM}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#MX> .
'
                ),
        )
);
