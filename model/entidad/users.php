<?php
   interface collecion{
      public function validData();
   }

   class users extends connect implements collecion{
      public $user;
      protected $pwd;
      public $data;
      public function __construct($user, $pwd,$path){
         parent::__construct($path);
         $this->user = $user;
         $this->pwd = $pwd;
         $this->data = $this->getData()[__CLASS__];
      }
      public function validData(){
         $arg = (array) func_get_args();
         $arg = array_pop($arg);
         $arg = (array) array_pop($arg);
         $arg2 = $this->data[0];
         return (array_diff_key($arg, $arg2)) ? null :$arg;
      }
      public function getUser(){
         $listUser = array_combine(array_column($this->data, 'user'), array_column($this->data, 'pwd'));
         $listIndex = array_combine(array_column($this->data, 'user'), array_keys($this->data));
         return ($listUser[$this->user] ?? null) == $this->pwd
         ? $this->data[$listIndex[$this->user]] 
         : ["succes"=> "Error"];  
      }
      public function postUser(){
         
         //$this->postData();
         return  $this->validData(func_get_args());
      }
   }
?>


