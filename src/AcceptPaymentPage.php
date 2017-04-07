<?php

namespace Mythril\AuthorizeNet;

class AcceptPaymentPage {
	protected $token;
	public function __construct(array $result) {
		if ($result['messages']['resultCode'] === 'Ok') {
			$this->token = $result['token'];
		} else {
			$msg = $result['messages']['message'][0]['text'];
			$code = $result['messages']['message'][0]['code'];
			throw new \Exception("Error [$code] : $msg");
		}
	}
	public function getToken() {
		return $this->token;
	}
}