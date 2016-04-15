<?php
    
      class Logger 
{   
    public static $PATH;
    public static $a;
    public static $Choice;
    public static $fp;
    public static $Host;
    public static $Login;
    public static $Password;
    public static $DBName;
 
 
    public static function open(){
        if(self::$PATH==null){
            return ;
        }
 
        self :: $fp = fopen(self::$PATH,'a+');
    }
    public static function log($message,$a){
        
    if (gettype($message) == 'array') {

        $message = implode("," , $message);
    }
    elseif (gettype($message) != 'string') {

        $message = (string) $message;
    }
        $log='';
        $date = '['.date('Y-m-d H:i:s',time()).'] ';
        switch($a){
            case 1:
                $log = $log . $message . $date. "\n";
                self::open();
                self::_write($log);
                break;
            case 2:
            $log = $log . $message;
                self::_mysql($log, $date);
                break;
            case 3:
                $log = $log . $message . $date. "\n";
                self :: _echo($log);
                break;
            default:
                echo "a = 0";
                break;    
        } 
    }

    protected static function _write($string){
        fwrite(self:: $fp, $string);
        fclose(self:: $fp);
        
    }
   public static function _mysql($string, $time){
        self::$Host = $_POST['Host'];
        self::$Login = $_POST['Login'];
        self::$Password = $_POST['Password'];
        self::$DBName = $_POST['DBName'];
        $mysqli = new mysqli(self::$Host,self::$Login,self::$Password,self::$DBName);
        if (mysqli_connect_errno()) {
            echo "Error ".mysqli_connect_error();
        }
        $mysqli->query("INSERT INTO `logger_db`.`tablelog` (idLog, Log, dateLog) values (null,'".$string."', '".$time."')");
        $mysqli->close();
    }
    protected static function _echo($string){
        echo $string;
    }
    
}
if( isset( $_POST['LogButton'] ) )
    {       
        Logger::$Choice = $_POST['Choice'];
        echo Logger::$Choice . "\n";
        switch (Logger::$Choice){
            case 'SQL':
                Logger::$a = 2;
                Logger::log(123412,Logger::$a);
                break;
            case 'File':
                Logger:: $a = 1;
                Logger:: $PATH = $_POST['file'];
               Logger::log(['Array'],Logger::$a);
                break;
            case 'Print':
                Logger:: $a = 3;
                Logger::log(1231412,Logger::$a);
                break;
            default:
                echo "Fail";

        }
        
}
?>
<form method = "POST">
    <select name = "Choice">
        <option value = "SQL">MySQL
        <option value = "File">File
        <option value = "Print"> Print
    </select><br /><br />
    <input type="text" name = "Host" value = "Host"><br /><br />
    <input type="text" name = "Login" value = "Login"><br /><br />
    <input type="text" name = "Password" value = "Password"><br /><br />
    <input type="text" name = "DBName" value = "DB Name"><br /><br />
    <input type="submit" name="LogButton" value="Log" > <br /><br />
    <input type = "file" name = "file">
</form>

   
     