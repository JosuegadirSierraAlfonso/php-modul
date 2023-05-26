<?php
    class connect{
        private $path;
        protected $data;
        function __construct($path){
            $this->path = $path;
            $this->data = json_decode(file_get_contents($this->path), true);
        }
        public function getData(){
            return $this->data;
        }
        public function postData(){
            array_unshift($this->data[func_get_arg(0)], func_get_arg(1));
            $f = fopen($this->path, "w+");
            fwrite($f, json_encode($this->getData(),JSON_PRETTY_PRINT));
            fclose($f);
            return ["succes"=> "Ok", "data"=> func_get_arg(1)];
        }
    }
?>