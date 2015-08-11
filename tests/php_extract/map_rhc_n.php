<?php
// php extract dump configuration file
$config = array(
        'mysqli' => array('192.18.0.146','infomed','lbc02bio','bancos_clinicos'),
        'maps'=>array(
//MAP_TNM
//MAP_N0
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=0',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N0 .
'
                ),
//MAP_N1
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=1',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N1 .
'
                ),
//MAP_N1a
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=1A',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N1a .
'
                ),
//MAP_N1b
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=1B',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N1b .
'
                ),
//MAP_N2
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=2',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N2 .
'
                ),
//MAP_N2a
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=2A',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N2a .
'
                ),
//MAP_N2b
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=2B',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N2b .
'
                ),
//MAP_N2c
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=2C',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N2c .
'
                ),
//MAP_N3
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=3',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N3 .
'
                ),
//MAP_N3a
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=3A',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N3a .
'
                ),
//MAP_N3b
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=3B',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N3b .
'
                ),
//MAP_N3c
                array(
                        'sql' => 'select RGH_MV from bancos_clinicos.RHC where N=3C',
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RGH_MV}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#N3c .
'
                ),
        )
);
