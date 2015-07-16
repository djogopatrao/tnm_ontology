<?php 

parse_str(implode('&', array_slice($argv, 1)), $_GET);

// Diretório onde estão os arquivos .map (definido pela linha de comando)
// Directory where the .map archives are (defined by command line)
$dir = $_GET['dir'];
$files = scandir($dir, 1);

// Abro o arquivo rdf de saída, cujo nome foi definido pela linha de comando
// Opens the ouputFile, whose name was defined by the command line
$outFile = fopen($_GET['output'] . '.rdf',"a");

// Header do arquivo rdf
// Header of the rdf file
$rdfHeader = '<?xml version="1.0"?>


<!DOCTYPE rdf:RDF [
    <!ENTITY owl "http://www.w3.org/2002/07/owl#" >
    <!ENTITY xsd "http://www.w3.org/2001/XMLSchema#" >
    <!ENTITY rdfs "http://www.w3.org/2000/01/rdf-schema#" >
    <!ENTITY rdf "http://www.w3.org/1999/02/22-rdf-syntax-ns#" >
]>


<rdf:RDF xmlns="http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#"
     xml:base="http://cipe.accamargo.org.br/ontologies/tnm_test"
     xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
     xmlns:owl="http://www.w3.org/2002/07/owl#"
     xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
    <owl:Ontology rdf:about="http://cipe.accamargo.org.br/ontologies/tnm_test"/>
    


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
					$comment = "<!-- " . $description . " --> \n";
					$comment .=  "<!-- http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#PatientTest" . $i . " --> \n";
					$owlHeder = '<owl:NamedIndividual rdf:about="http://cipe.accamargo.org.br/ontologies/tnm_test#PatientTest'. $i . '">' . "\n";
					$topography = "\t" . '<rdf:type rdf:resource="http://cipe.accamargo.org.br/ontologies/tnm_6e_icdo_topographies.owl#'. $topo . '" />'. "\n";

					$data = preg_split('/\s+/', $tnm);
					$categories = null;

					// Para cada categoria como T, N, M ou, por exemplo, Age45OrMore escrevo uma linha no teste
					// Writes a line in the test for each category, such as T, N, M or, for example, Age45OrMore
					foreach($data as $category) {
						$categories .= "\t" . '<rdf:type rdf:resource="http://cipe.accamargo.org.br/ontologies/tnm_6th_edition.owl#'.  $category . '" />'. "\n";
					}

					$footer = "\t" . '<rdf:type rdf:resource="http://cipe.accamargo.org.br/ontologies/tnm_test#Patient"/>' . "\n";
					$owlFooter = '</owl:NamedIndividual>' . "\n\n";

					$rdf = $comment . $owlHeder . $topography . $categories . $footer . $owlFooter;
					fwrite($outFile, utf8_encode($rdf));
	
					$i++;
				}
			}
		}
	}
}

$rdfFooter = "</rdf:RDF>";
fwrite($outFile, utf8_encode($rdfFooter));
fclose($outFile);