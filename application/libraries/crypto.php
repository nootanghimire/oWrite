<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 



	class Crypto{

		protected $algorithm, $mode, $key, $iv;
		protected $dir_algorithm, $dir_mode;
		protected $td;
		protected $cr_mode='';


		/*
   		 * @param algorithm
   		 * @param mode
   		 * @param dir_algorithm
   		 * @param dir_mode
   		 * 
   		 * return-type @bool
   		 * 
		 */
		public function init($algorithm, $mode, $dir_algorithm="", $dir_mode=""){
				$this->algorithm = $algorithm;
				$this->mode = $mode;
				$this->dir_algorithm = $dir_algorithm;
				$this->dir_mode = $dir_mode;
				if($this->td = mcrypt_module_open($this->algorithm, $this->dir_algorithm, $this->mode, $this->dir_mode)){
					return true;
				} else {
					return false;
				}
		}



		/*
		 * @param data
		 * @param key
		 * @param iv
		 *
		 * return-type @string , @bool
		 */
		public function encrypt($data, $key, $iv){
			if(!$this->td){return false;}
			$this->iv = $iv;
			$this->key = $key;
			mcrypt_generic_init($this->td, $this->key, $this->iv);
			$encrypted = mcrypt_generic($this->td, $data);
			mcrypt_generic_deinit($this->td);
			$this->cr_mode = "Encrypted";
			return $encrypted;
		}


		public function decrypt($data, $key, $iv){
			if(!$this->td){return false;}
			$this->iv  = $iv;
			$this->key = $key;
			mcrypt_generic_init($this->td, $this->key, $this->iv);
			$decrypted = mdecrypt_generic($this->td, $data);
			mcrypt_generic_deinit($this->td);
			$this->cr_mode = "Decrypted";
			return $decrypted;
		}

		public function getLastIV(){
			return $this->iv;
		}

		public function getLastKey(){
			return $this->key;
		}

		public function __destruct(){
			if(!$this->td) {return;} //virtually impossible
			mcrypt_module_close($this->td);
		}

		public function setAlgorithm($alg, $alg_dir=""){
			$this->algorithm = $alg;
			$this->dir_algorithm = $alg_dir;
		}

		public function setAlgorithmMode($mode, $mode_dir= ""){
			$this->mode = $mode;
			$this->dir_mode = $mode_dir;
		}
	}



/* Usage
 * $something = new Crypto($algorithm, $mode, $optionalAlgDir, $optionalModeDir);
 * $enc = $something->encrypt($data, $iv, $key);
 * $dec = $something->decrypt($data, $iv, $key);
 */
?>