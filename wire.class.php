<?php
//author:	aaron renzelmann
//description:	advanced encryption standard class, 2 way encrpytion
//date create: 	2013-02-26

/*
MCRYPT is required for this to work
very useful:	http://www.php.net/manual/en/mcrypt.installation.php#114609
*/

class wire {
	private $enc_hash=null, $enc_type='AES-256-CBC', $iv_size=16; 
	
	//construct with key to be used as hash
	public function __construct($key){
		$this->set_key($key);
	}

	//set hash based off of input key, default is md5, requires 32 bit for default enc_type
	public function set_key($key,$hash_type='md5'){
		$this->enc_hash = hash($hash_type,$key);
	}

	//encrypts data with iv for highest level of security, returns value with iv pre-appended for storage
	public function encrypt($data){
		$iv = mcrypt_create_iv($this->iv_size, MCRYPT_RAND);
		$encrypted = openssl_encrypt($data, $this->enc_type, $this->enc_hash, 0, $iv);
		return $iv.$encrypted;
	}

	public function decrypt($data){
		$iv = substr($data, 0, $this->iv_size);
		$data = substr($data, $this->iv_size);
		$decrpyted = openssl_decrypt($data, $this->enc_type, $this->enc_hash, 0, $iv);
		return $decrpyted;
	}
}
?>
