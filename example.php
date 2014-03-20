<?php
//object to store multiple keys
$keychain = new stdClass;
//store main key
$keychain->main = 'w1r3tr@nzf3R';
//store alternative key
$keychain->alt = 'ar-15';


//load in path to wire class
require_once 'wire.class.php';

//construct new wire, pass along a 'key' that will be converted to a hash. value is not stored as part of enc value
$wire = new wire($keychain->main);

//--example: basics
	//string we wanna encrypt
	$string = 'Atomic batteries to power. Turbines to speed.';

	//encrypt string, returns the encrypted value based off of the hash with the iv attached
	$encrypt = $wire->encrypt($string);

	//decrypt value. hash has to match the save as what was used for encryption, value is not stored in encrypted value
	$decrypt = $wire->decrypt($encrypt);

	//display values
	echo 'default: '.$string;
	echo '<br/>';
	echo 'encrypt: '.$encrypt;
	echo '<br/>';
	echo 'decrypt: '.$decrypt;
//==example: basics


//--example: key change
	$string = 'Ready to move out.';

	//using key from object construction
	$encrypt_main = $wire->encrypt($string);
	$decrypt_main = $wire->decrypt($encrypt_main);

	//switch to alternative key
	$wire->set_key($keychain->alt);

	//using alternative key
	$encrypt_alt = $wire->encrypt($string);
	$decrypt_alt = $wire->decrypt($encrypt_alt);

	//display differences
	echo '<br/><br/><br/>';
	echo 'encrypt v1: '.$encrypt_main;
	echo '<br/>';
	echo 'encrypt v2: '.$encrypt_alt;
	echo '<br/>';
	echo 'decrypt v1: '.$decrypt_main;
	echo '<br/>';
	echo 'decrypt v2: '.$decrypt_alt;
	echo '<br/>';

//==example: keychange
?>