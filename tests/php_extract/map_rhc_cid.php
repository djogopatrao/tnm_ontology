<?php
// php extract dump configuration file
$config = array(
        'mysqli' => array('192.18.0.146','infomed','lbc02bio','bancos_clinicos'),
        'maps'=>array(
//MAP_CID
                array(
                        'sql' => "SELECT ID, if(char_length(TOPO)=4, concat(substring( TOPO,1,3),'_',substring(TOPO,4,4)),substring_index( TOPO,'','1')) as cd_cid  FROM bancos_clinicos.RHC",
                        'rdf' => '<http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest{ID}> a <http://cipe.accamargo.org.br/ontologies/tnm_6e_icdo_topographies.owl#{cd_cid}> .
'
                ),
        )
);
