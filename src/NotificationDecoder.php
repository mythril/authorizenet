<?php

namespace Mythril\AuthorizeNet;

use \Exception;

class NotificationDecoder {
	protected $sigKey;

	public function __construct($sigKey) {
		$this->sigKey = $sigKey;
	}

	public function validate($raw, $rsig) {
		$accepted_algos = array('sha512' => true);
		$parts = explode('=', $rsig);
		$algo = $parts[0];
		if (empty($accepted_algos[$algo])) {
			return false;
		}
		$inSig = $parts[1];
		$vSig = strtoupper(hash_hmac($algo, $raw, $this->sigKey));
		return hash_equals($inSig, $vSig);
	}

	public function decodePost() {
		$rawPost = file_get_contents('php://input');
		$headers = getallheaders();
		if (!$this->validate($rawPost, $headers['X-Anet-Signature'])) {
			throw new Exception('Invalid HMAC');
		}
		return json_decode($rawPost, true);
	}
}

