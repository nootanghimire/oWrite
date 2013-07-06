<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * encrypt.class.php -- class for controlling encryption and decryption
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Core_Classes
 * @package   Security_Module
 * @author    Nootan Ghimire <nootan.ghimire@gmail.com>
 * @copyright 2012 Nootan Ghimire
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      http://www.facebook.com/noootan.ghimire
 */
 
 
class Encryption {
	protected $a_nam, $a_mod, $iv, $skey, $encrypted_data, $decrypted_data, $td;
	protected $a_dir="", $a_mod_dir="";
	public $ClearedOn=0;

	/**
	 * constructer function
	 *
	 * @param $alg_name
	 * @param $alg_mode 
	 *
	 */
	public function  __construct($alg_name, $alg_mode) {
		$this->a_nam=$alg_name;
		$this->a_mod=$alg_mode;
		$this->td=mcrypt_module_open($this->a_nam,$this->a_dir,$this->a_mod,$this->a_mod_dir);
	}
	
	public function get_td() {
		return $this->td;	
	}
	
	public function change_algorithm($new_algorithm){
		$this->a_nam=$new_algorithm;
	}

	public function change_mode($new_mode) {
		$this->a_nam=$new_mode;	
	}
	
	public function set_iv($iv){
		$this->iv=$iv;
	}
	
	public function set_algortihm_dir($dir) {
		$this->a_dir=$dir;
	}
	
	public function set_mode_dir($dir) {
		$this->a_mod_dir=$dir;	
	}
	
	public function set_key($skey) {
		$this->skey=$skey;
	}
	
	protected function make_iv() {
		if((!isset($this->iv)) || $this->iv==""){
			$this->iv=mcrypt_create_iv(mcrypt_enc_get_iv_size($this->td),MCRYPT_DEV_RANDOM);
		}
	}
	
	protected function init() {
		mcrypt_generic_init($this->td,$this->skey, $this->iv);
	}
	
	protected function deinit() {
			mcrypt_generic_deinit($this->td);
	}
 	
	public function get_iv($type="true"){
		if($type=="encoded"){
		return base64_encode($this->iv);	
		}
		else{
		return $this->iv;	
		}
	}
	public function close_module(){
		if(isset($this->td) || (!$this->td="")){
		mcrypt_module_close($this->td);	
		}
	}
	protected function encrypt($key, $data){
		self::close_module();
		self::__construct($this->a_nam, $this->a_mod);
		self::set_key($key);
		self::make_iv();
		self::init();
		$enc=mcrypt_generic($this->td,$data);
		$this->encrypted_data=$enc;
		self::deinit();
		
	}
	
	protected function decrypt($key, $edata, $iv, $bool_base64){
		self::close_module();
		self::__construct($this->a_nam, $this->a_mod);
		self::set_key($key);
		self::set_iv($iv);
		self::make_iv();
		self::init();
		if($bool_base64){
			$data = base64_decode($edata);
		} else {
			$data = $edata;
		}
		$dec=mdecrypt_generic($this->td, $data);		
		$this->decrypted_data=$dec;
		self::deinit();
		
	}
	
	public function getEncrypted($data, $key, $base64){
		self::encrypt($key, $data);
		if($base64) {
			return base64_encode($this->encrypted_data);
		}
		else {
			return $this->encrypted_data;
		}
		
	}
	
	public function getDecrypted($data, $key, $iv, $bool) {
		self::decrypt($key, $data, $iv, $bool);
		return $this->decrypted_data;	
	}
	
	public function get_iv_size() {
		return mcrypt_enc_get_iv_size($this->td);
	}
	
	public function get_key() {
		return $this->skey;	
	}
	
	public function get_last_encrypted_data(){
		return $this->encrypted_data;
	}
	
	public function get_last_decrypted_data() {
		return $this->decrypted_data;
	}
	
	public function get_key_size() {
		return mcrypt_enc_get_key_size($this->td);	
	}
	public function ClearAllData() {
	self::close_module();
	$this->td="";
	$this->a_dir="";
	$this->a_nam="";
	$this->a_mod="";
	$this->a_mod_dir="";	
	$this->skey="";
	$this->iv="";
	$this->encrypted_data="";
	$this->decrypted_data="";
	$this->ClearedOn=time();

	}
	
	
}

/* //Usage Options 

$var=new encrypt("rijndael-256","cbc");
//echo $var->get_iv_size();
//$var->set_iv("anbopkgrwdniogyl");
echo "<br> IV => ";
$enc=$var->getEncrypted("Data", md5("secretkey"), true); //true means, base64 encoded
$niv= $var->get_iv("encoded");
echo $var->get_iv("encoded");
echo "<br> Encrypted => ";
echo $enc;
$var->ClearAllData();
//new var to decrypt the data
$new=new encrypt("rijndael-256","cbc");
$iv=base64_decode($niv);	
echo "<br>";
$dec=$new->getDecrypted($enc,md5("secretkey"),$iv, true); //if previously base64 encoded, use true
echo $new->get_iv("encoded") ."<br>";
echo $dec;
echo "<br>";
echo date("D, M d Y h:m:s",$var->ClearedOn);
echo "<br>";
echo $new->ClearedOn;

*/
?>