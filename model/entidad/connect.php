<?php
    class connect{
        private $path;
        protected $data;
        function __construct($path){
            $this->path = $path;
            $this->data = json_decode(file_get_contents($this->path), true);
        }
        public function setData(){
            $this->data = func_get_arg(0);
        }
        public function getData(){
            return $this->data;
        }
        public function postData(){

        }
    }
?>