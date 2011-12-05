<?php

include '../../tools/internalBootstrap.php';
include 'yRestClient.php';
include 'yNeo4jRestClient.php';

$neo = new yNeo4jRestClient();
$neo->bind('http://127.0.0.1:7474/db/data/');
//$neo->bind('http://localhost:7474/webadmin/');
//var_dump($neo->getRoot());
//$neo->dump();
//var_dump($neo->getNode(5));
var_dump($neo->getRelations(5, 'in', array('FOLLOWED_BY')));
//$neo->bind('http://olanet.ru/');
//var_dump($neo->getRoot());
//$neo->dump();
