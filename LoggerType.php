<?php
class LoggerType {
    protected $fs;
    public function __construct() {
        $this->open();
    }

   public function open() {
        if(Parser::$filePath==null) {
            return ;
        }
        $this->fs = fopen(Parser::$filePath,'a+');
    }

    public function _write($message) {
        fwrite($this->fs, $message);
        fclose($this->fs);   
    }
    public function _mysql($message, $time) {
        $mysqli = new mysqli(Parser::$host,Parser::$login,Parser::$password,Parser::$dbName);
        if (mysqli_connect_errno()) {
            echo "Error ".mysqli_connect_error();
        }
        $mysqli->query("INSERT INTO `log_db`.`log_table` (idLog, Log, dateLog) values (null,'".$message."', '".$time."')");
        $mysqli->close();
    }
    public function _echo($message) {
        echo $message;
    }


}
?>