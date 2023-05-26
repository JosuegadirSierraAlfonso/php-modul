<?php
   interface collecion{
      public function validData();
   }

   class users extends connect implements collecion{
      public $user;
      protected $pwd;
      public $dataUser;
      public function __construct($user, $pwd,$path){
         parent::__construct($path);
         $this->user = $user;
         $this->pwd = $pwd;
      
         $this->dataUser = $this->getData()[__CLASS__];
      }
      public function tokenId(){
         $brand = $_SERVER["REQUEST_TIME_FLOAT"];
         $data = crypt(__CLASS__, $brand);
         $options = ['cost' => 10];
         $has = password_hash($data, CRYPT_BLOWFISH, $options);
         return ["brand"=> $brand, "token"=> $has, "id"=>substr($has,-5) ];
      }
      public function validData(){
         $arg = (array) func_get_args();
         $arg = array_pop($arg);
         $arg = (array) array_pop($arg);
         $arg2 = $this->dataUser[0];

         $res = match(count($arg)+1==count($arg2)){
            true=> (array_diff_key($arg, $arg2)) ? null :$arg,
            false=> in_array($arg["id"], array_column($this->getData()[__CLASS__], 'id'))
         };
         var_dump($res);
         // return $res;
      }
      public function getUser(){
         $listUser = array_combine(array_column($this->dataUser, 'user'), array_column($this->dataUser, 'pwd'));
         $listIndex = array_combine(array_column($this->dataUser, 'user'), array_keys($this->dataUser));
         return ($listUser[$this->user] ?? null) == $this->pwd
         ? ["succes"=> "Ok", "data"=>$this->dataUser[$listIndex[$this->user]] ]
         : ["succes"=> "Error", "message"=>"The supplied credentials are incorrect"];  
      }
      public function postUser(){
         return ($this->validData(func_get_args()) ?? null) ? $this->postData(__CLASS__,$this->validData(func_get_args())) : ["succes"=> "Error", "message"=>"The requested data structure is incorrect"];
      }
      public function deleteUser(){
         $this->validData(func_get_args());
      }
   }
?>