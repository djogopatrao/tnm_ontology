#!/usr/bin/php
<?php


/********************************************/

class ConfigurationFile {

	private $filename = null;

	function __construct($filename) {
		$this->filename=$filename;
	}

	function read() {
		include($this->filename);
		return new ExecuteConfigurationFile($config);
	}
}

class ConfigurationTest {

	private $config = array(
		'mysqli' => array('localhost','root','','bancos_clinicos'),
		'maps'=>array(
			array(
				'sql' => 'SELECT 1 as one, 0 as zero',
				'rdf' => '<http://test/#should_be_zero_{one}> <http://test/#hasProperty> "{zero}"^^xsd:integer .'

			), //... repete
			array(
				'sql' => 'SELECT 1 as one, NULL as zero',
				'rdf' => '<http://test/#should_be_null_{one}> <http://test/#hasProperty> "{zero}" .'

			), //... repete
			array(
				'sql' => 'SELECT "bla balabla bal 
ablbalbal
	ablablabl" as text, 77127 as one',
				'rdf' => '<http://test/#should_be_null_{one}> <http://test/#hasProperty> "{text}" .'

			), //... repete
		)
	);

	function __construct() {
	}

	function read() {
		return new ExecuteConfigurationFile($this->config);
	}
}


/**
 *
 * execute the configuration 
 *
 *
 **/
class ExecuteConfigurationFile {

	function __construct($configuration) {
		$this->configuration =  $configuration;
	}

	function go(OutputStream $output_stream) {
		$mysql_conf=$this->configuration['mysqli'];
		$mysqli = new mysqli($mysql_conf[0],$mysql_conf[1],$mysql_conf[2],$mysql_conf[3]);
		$mysqli->set_charset("utf8");
		$results = array();
		foreach( $this->configuration['maps'] as $m ) {
			$convert = new PhpMySqlToRdf($mysqli,$m['sql'],$m['rdf']);
			$convert->run_map($output_stream);
		}
	}

}



interface CreateFileFromMapping {
	public function go();
}

/**
 * receives an array of rdf statements then creates a rdf file (or save it)
 *
 *
 **/
class CreateTtlFromMapping implements CreateFileFromMapping{
	private $output_stream;
	private $configuration;
	private $ttl_template = <<< EOF
@prefix xsd:	<http://www.w3.org/2001/XMLSchema#> .
@prefix owl:	<http://www.w3.org/2002/07/owl#> .
@prefix rdfs:	<http://www.w3.org/2000/01/rdf-schema#> .
@prefix rdf:	<http://www.w3.org/1999/02/22-rdf-syntax-ns#> .

EOF;


	function __construct( OutputStream $output_stream,$configuration ) {
		$this->output_stream = $output_stream;
		$this->configuration = $configuration;
	}


	public function go() {
		$executor = $this->configuration->read();
		$this->output_stream->out($this->ttl_template);
		$executor->go($this->output_stream);
	}



}


/**
 *  runs a query $sql_query, on the mysqli connection given by $mysql,
 *  and for each row of result, substitute the columns value on the
 *  template $rdf; returns an array of substituted rdfs
 *
 *  TODO could implement an interface, so we could apply to other dbs
 * 
 *
 **/
class PhpMySqlToRdf {

	private $mysqli;
	private $sql_query;
	private $rdf;


	function __construct($mysqli,$sql_query,$rdf) {

		$this->mysqli=$mysqli;
		$this->sql_query = $sql_query;
		$this->rdf = $rdf;

	}

	public function run_map(OutputStream $output_stream) {

		/* check connection */
		if ($this->mysqli->connect_errno) {
		    die(sprintf("Connect failed: %s\n", $this->mysqli->connect_error) );
		}


		$q = $this->mysqli->query($this->sql_query);
		if ( !$q ) {
			die(sprintf("Query error: %s\n",$this->mysqli->error));
		}


		$result = null;
		while($r = $q->fetch_assoc() ) {

			$repl = new RdfReplace($this->rdf, $r);
			$output_stream->out( $repl->go() );
		}

		return $result;

	}
}

/**
 * replace variables in a text (rdf). Variables are inside {} and
 * they're replaced by the value defined in $r;
 *
 *
 * example: this variable {test} will be replaced by $r['test']
 *
 **/
class RdfReplace{

	private $rdf;
	private $r;


	function __construct($rdf,$r) {

		$this->rdf = $rdf;
		$this->r=$r;


	}

	private function callback($matches){

		if ( !empty( $this->r[$matches[1]] ) || $this->r[$matches[1]] === '0' )
			return $this->r[$matches[1]];
		else
			return null;
	}

	private function quote($string) {

		$quote = '"';
		// http://www.w3.org/TeamSubmission/turtle/#scharacter
		// lcharacter (long character)
		if ( strpbrk($string,chr(9).chr(10).chr(13) ) )
		{
			$quote='"""';
			$string = addcslashes($string, '"\\' );
		} else {
		// echaracter
			$string = addcslashes($string,'"'.chr(9).chr(10).chr(13)."\t\n\r\\");
		}

		return $quote . $string . $quote;

	}


	private function callback_quoted($matches){

		if ( !empty( $this->r[$matches[1]] ) || $this->r[$matches[1]] === '0' )
			return $this->quote($this->r[$matches[1]]);
		else
			return '""';
	}

	public function go() {
		$x = $this->rdf;
		$x = preg_replace_callback( '/\"\{([^}]+)\}\"/', array($this,'callback_quoted'), $x );
		$x = preg_replace_callback( '/\{([^}]+)\}/', array($this,'callback'), $x );
		return $x;
	}

}

interface OutputStream {

	public function out($string);
}

class StringStream implements OutputStream{

	private $data = array();

	public function out($string) {
		$this->data []= $string;
	}

	public function read() {
		return $this->data;
	}
}

class StdoutStream implements OutputStream{
	public function out($string) {
		echo $string;
	}
}

class WriteFileStream implements OutputStream {

	private $filename="";
	private $h=null;

	function __construct($filename) {
		$this->filename=$filename;
		$this->h = fopen($filename,"w");
		if ( !$this->h ) {
			throw new Exception("Can't open file '$filename' for writing");
		}
	}

	function __destruct() {
		fclose($this->h);
	}

	public function out($string) {
		fputs($this->h,$string);
	}
}
/**
 * Tests
 *
 *
 **/

/*
$output_stream = new StringStream();
$configuration = new ConfigurationTest();
$rdf = new CreateTtlFromMapping( $output_stream, $configuration );
$rdf->go();
print_r($output_stream->read());
exit;
//*/

/**
 * Main
 *
 *
 **/



if ( count($argv) < 2 || count($argv)>3 ) {
	die("usar: {$argv[0]} <arquivo de configuracao> [<saida.rdf>]\n");
}

$output_file=null;
$conf_file=$argv[1];
if ( count($argv)>=3 ) {
	$output_file = $argv[2];
}

if ( empty($output_file) )
	$output_stream = new StdoutStream();
else
	$output_stream = new WriteFileStream($output_file);

$configuration = new ConfigurationFile($conf_file);
$rdf = new CreateTtlFromMapping( $output_stream, $configuration );

$rdf->go();

