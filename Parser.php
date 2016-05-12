<?php
class Parser {
        
        public static $type;
        public static $host;
        public static $login;
        public static $password;
        public static $dbName;
        public static $filePath;
        protected $parse_array;

        public function __construct() {

            $this->open();
        }
        protected function open() {
            $this->parse_array = parse_ini_file("config.ini");

        }
        public function parse(){
            
            self::$type = $this->parse_array['type'];
            self::$host = $this->parse_array['host'];
            self::$login = $this->parse_array['login'];
            self::$password =$this->parse_array['pswd'];
            self::$dbName = $this->parse_array['namedb'];
            self::$filePath = $this->parse_array['path'];

        }
      
} 
?>