<?php
include "Logger.php";
include "LoggerType.php";
include "Parser.php";

$parser = new Parser();
$parser->parse();
$logger = new Logger(Parser::$type);
$logger->log(array(1=>2,2=>'string'));
?>