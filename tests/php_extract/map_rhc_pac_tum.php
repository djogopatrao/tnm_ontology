<?php
// php extract dump configuration file
$config = array(
        'mysqli' => array('192.18.0.146','infomed','lbc02bio','bancos_clinicos'),
        'maps'=>array(
                array(
                        'sql' => "select ID,RHC from bancos_clinicos.RHC",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{RHC}> :hasTumor <http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTestTumor{ID}> .
'
	) ) );

