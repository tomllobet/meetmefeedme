<?php // Connect Script

$host		=	"external-db.s88915.gridserver.com";
$dbname		=	"db88915_meetfeed";
$mysqluser  =	"db88915_control";
$mysqlpass	=	"grg75sniffles";

mysql_connect($host, $mysqluser, $mysqlpass);
mysql_select_db($dbname);

?>