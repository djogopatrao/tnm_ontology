<?php
// php extract dump configuration file
$config = array(
        'mysqli' => array('192.18.0.146','infomed','lbc02bio','bancos_clinicos'),
        'maps'=>array(
//MAP_TNM
//MAP_T0
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=0',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T0 .
'
                ),
//MAP_T1 
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=1',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T1 .
'
                ),
//MAP_T1a 
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=1A',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T1a .
'
                ),
//MAP_T1b 
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=1B',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T1b .
'
                ),
//MAP_T1c
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=1C',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T1c .
'
                ),
//MAP_T1mic
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=1MIC',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T1mic .
'
                ),
//MAP_T2
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=2',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T2 .
'
                ),
//MAP_T2a 
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=2A',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T2a .
'
                ),
//MAP_T2b 
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=2B',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T2b .
'
                ),
//MAP_T2c
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=2C',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T2c .
'
                ),
//MAP_T3
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=3',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T3 .
'
                ),
//MAP_T3a 
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=3A',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T3a .
'
                ),
//MAP_T3b 
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=3B',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T3b .
'
                ),
//MAP_T3c
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=3C',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T3c .
'
                ),
//MAP_T4
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=4',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T4 .
'
                ),
//MAP_T4a 
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=4A',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T4a .
'
                ),
//MAP_T4b 
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=4B',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T4b .
'
                ),
//MAP_T4c
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=4C',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T4c .
'
                ),
//MAP_T4d
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=4D',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#T4d .
'
                ),
//MAP_Tis
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=IS',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#Tis .
'
                ),
//MAP_TX
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where T=X',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#TX .
'
                ),

        )
);
