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
//MAP_T1a 
//MAP_T1b 
//MAP_T1c
//MAP_T1mic

//MAP_T2
//MAP_T2a 
//MAP_T2b 
//MAP_T2c

//MAP_T3
//MAP_T3a 
//MAP_T3b 
//MAP_T3c

//MAP_T4
//MAP_T4a 
//MAP_T4b 
//MAP_T4c
//MAP_T4d

//MAP_Tis
//MAP_TX
        )
);
