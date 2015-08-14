<?php
// php extract dump configuration file
$config = array(
        'mysqli' => array('192.18.0.146','infomed','lbc02bio','bancos_clinicos'),
        'maps'=>array(
                array(
                        'sql' => "select RHC, idade from bancos_clinicos.RHC where idade > '044'",
//MAP_Patient_Age45OrMore
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RHC}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#Age45OrMore> .
'
                ),
                array(
                        'sql' => "select RHC, idade from bancos_clinicos.RHC where idade < '045'",
//MAP_Patient_AgeLessThan45
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RHC}> a <http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#AgeLessThan45> .
'
                ),

        )
);

