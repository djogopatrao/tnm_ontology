<?php 

parse_str(implode('&', array_slice($argv, 1)), $_GET);

// Diretório onde estão os arquivos .map (definido pela linha de comando)
// Directory where the .map archives are (defined by command line)
$dir = $_GET['dir'];
$files = scandir($dir, 1);

// Abro o arquivo rdf de saída, cujo nome foi definido pela linha de comando
// Opens the ouputFile, whose name was defined by the command line
$outFile = fopen($_GET['output'] . '.rdf',"w");

// Header do arquivo rdf
// Header of the rdf file
$rdfHeader = '<?xml version="1.0"?>


<!DOCTYPE rdf:RDF [
    <!ENTITY owl "http://www.w3.org/2002/07/owl#" >
    <!ENTITY xsd "http://www.w3.org/2001/XMLSchema#" >
    <!ENTITY rdfs "http://www.w3.org/2000/01/rdf-schema#" >
    <!ENTITY rdf "http://www.w3.org/1999/02/22-rdf-syntax-ns#" >
    <!ENTITY tnm_test "http://cipe.accamargo.org.br/ontologies/tnm_test#" >
    <!ENTITY tnm "http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#" > 
]>


<rdf:RDF xmlns="http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#"
     xml:base="http://cipe.accamargo.org.br/ontologies/tnm_test"
     xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
     xmlns:tnm_test="http://cipe.accamargo.org.br/ontologies/tnm_test#"
     xmlns:owl="http://www.w3.org/2002/07/owl#"
     xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
     xmlns:tnm="http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#" >
    <owl:Ontology rdf:about="http://cipe.accamargo.org.br/ontologies/tnm_test"/>
    
    <!-- 
    ///////////////////////////////////////////////////////////////////////////////////////
    //
    // Object Properties
    //
    ///////////////////////////////////////////////////////////////////////////////////////
     -->

    


    <!-- http://cipe.accamargo.org.br/ontologies/tnm_test#hasTumor -->

    <owl:ObjectProperty rdf:about="&tnm_test;hasTumor"/>


  <!-- ///////////////////////////////////////////////////////////////////////////////////////
       //
       // Individuals
       //
       ///////////////////////////////////////////////////////////////////////////////////////
  -->
' . "\n";

// Escreve o header no arquivo de saída
// Writes header in the output file
fwrite($outFile, utf8_encode($rdfHeader));

// Variável para numerar os pacientes de teste (1, 2, 3 ...)
// Variable to numerate the test patients (1, 2, 3, ....)
$i = 1;

// Para cada arquivo no diretório passado pelo usuário, faça
// For every file in the directory given by the user, do
foreach($files as $file) {
	// Verifica se o arquivo é .map
	// Verifies if the file has the .map extension
	if(preg_match("/^.\w+.map$/", $file)) {
		$map = fopen($dir.'/'.$file, "r");
		$line = array();

		while(!feof($map)) {
			array_push($line, trim(fgets($map)));
		}
		fclose($map);

		// Descrição do arquivo .map, exemplo: Tireoide_EC_IVC
		// Description of the .map file, example: Tireoide_EC_IVC
		$description = $line[0];
		
		// Topografias no arquivo
		// Topographies in the file
		$topos = preg_split('/\s+/', $line[1]);

		// Para cada topografia escrevo um teste
		// Writes a test for each topography
		foreach($topos as $topo) {
			unset($line[0]);
			unset($line[1]);

			// Escreve um teste para cada combinação do TNM
			// Writes a test for each combination of TNM
			foreach($line as $tnm) {
				if(!empty($tnm)){
					$commentPatient = "<!-- " . $description . " --> \n";
					$commentPatient .=  "<!-- http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#PatientTest" . $i . " --> \n";
					$commentTumor =  "<!-- http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest". $i . '_Tumor"' . " --> \n";

					$owlHeader = '<owl:NamedIndividual rdf:about="http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest'. $i . '">' . "\n";
					$owlHeaderTumor = '<owl:NamedIndividual rdf:about="http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest'. $i . '_Tumor">' . "\n";
					$topography = "\t" . '<rdf:type rdf:resource="http://cipe.accamargo.org.br/ontologies/tnm_6e_icdo_topographies.owl#'. $topo . '" />'. "\n";
					$hasTumor = "\t" . '<tnm_test:hasTumor rdf:resource="&tnm_test;PatientTest'. $i . '_Tumor"/>' . "\n";
					$data = preg_split('/\s+/', $tnm);
					$categoriesTumor = null;
					$categoriesPatient = null;

					// Para cada categoria como T, N, M ou, por exemplo, Age45OrMore escrevo uma linha no teste
					// Writes a line in the test for each category, such as T, N, M or, for example, Age45OrMore
					foreach($data as $category) {
						if (strpos($category,'Age') !== false) {
						   $categoriesPatient .= "\t" . '<rdf:type rdf:resource="http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#'.  $category . '" />'. "\n";
						}else
						{
						$categoriesTumor .= "\t" . '<rdf:type rdf:resource="http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#'.  $category . '" />'. "\n";
						}
						
					}

					$footer = "\t" . '<rdf:type rdf:resource="http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#Patient"/>' . "\n";
					$footerTumor = "\t" . '<rdf:type rdf:resource="http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#Tumor"/>' . "\n";
					$expectedCs = "\t" . '<rdfs:comment rdf:datatype="&xsd;string">Expected CS: ' . $description . '</rdfs:comment>' . "\n";
					$owlFooter = '</owl:NamedIndividual>' . "\n\n";

					$rdfPatient = $commentPatient . $owlHeader . $footer . $expectedCs . $categoriesPatient . $hasTumor . $owlFooter;
					fwrite($outFile, utf8_encode($rdfPatient));
	
					$rdfTumor = $commentTumor . $owlHeaderTumor . $topography . $categoriesTumor . $footerTumor . $owlFooter;
					fwrite($outFile, utf8_encode($rdfTumor));

					$i++;
				}
			}
		}
	}
}

$rdfFooter = "</rdf:RDF>";
fwrite($outFile, utf8_encode($rdfFooter));
fclose($outFile);
