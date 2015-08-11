#!/bin/bash
#
# $ ./build-dumps.sh $DUMPS_N3_PATH $MAP_PHP_PATH
# Ex: ./build-dumps.sh /opt/github/tnm_ontology/tests/php_extract/dumps /opt/github/tnm_ontology/tests/php_extract
#
#
DUMPS_N3_PATH=$1
MAP_PHP_PATH=$2

# 
# Elemina dumps antigos, se existirem.
# Erase old dumps, if any.
#
rm $DUMPS_N3_PATH/dump_*.n3

novo_path=`echo $MAP_PHP_PATH | sed 's|/|\\\/|g'`

# Extração de dados de todos os Mapeamentos 
# Data extraction of all Mappings
# Gera os arquivos  *.n3 de acordo com o nome do mapeamento.
# Generates the files * .n3 according to the name mapping.


name="";
echo $MAP_PHP_PATH
ls $MAP_PHP_PATH/map_*.php | while read file; do
	echo $file; name=`echo $file | sed "s/$novo_path//g" | sed 's/\///g'`; name=`echo $name | sed 's/\///g'`;
	time php php_extract_dump.php $file $DUMPS_N3_PATH/dump_$name.n3
# Count using arq of Jena
#	$JENA_ROOT/bin/arq --data=$DUMPS_N3_PATH/dump_$name.n3 --graph=$ONTOLOGIAS_PATH/ontologie.owl --query=$SPARQL_FILES/count_triplas
	
done;

