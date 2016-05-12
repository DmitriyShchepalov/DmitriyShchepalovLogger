<?php
class Logger {

    protected $type;

    public function __construct($type) {
        $this->type = $type;

    }

    public function log($message) {
        if (gettype($message) == 'array') {
            $message = implode("," , $message);
        } elseif (gettype($message) == 'object') {
            $message =serialize($message);
        } else {
            $message = (string)$message;
        }
        $log='';
        $date = '['.date('Y-m-d H:i:s',time()).'] ';
        $this->type = strtolower($this->type);
        switch($this->type) {
            case 'file':
                $log = $log . $message ." ". $date. "\n";
                $file = new LoggerType();
                $file->_write($log);
                break;
            case 'sql':
                $log = $log . $message;
                $mysql = new LoggerType();
                $mysql->_mysql($log, $date);
                break;
            case 'print':
                $log = $log . $message ." ". $date. "\n";
                $print = new LoggerType();
                $print->_echo($log);
                break;
            default:
                echo "a = 0";
                break;    
        }
    }
}
?>