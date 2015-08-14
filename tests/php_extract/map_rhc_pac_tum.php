<?php
// php extract dump configuration file
$config = array(
        'mysqli' => array('192.18.0.146','infomed','lbc02bio','bancos_clinicos'),
        'maps'=>array(
                array(
                        'sql' => "select RHC, ADM from bancos_clinicos.RHC",
//MAP_Patient
//MAP_Tumor
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RHC}> <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#hasTumor> <http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTestTumor{RHC}_{ADM}> .
<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RHC}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#Patient> .
<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTestTumor{RHC}_{ADM}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#Tumor> .
'
                ),
        )
);

