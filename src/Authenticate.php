<?php

namespace Mythril\AuthorizeNet;

class Authenticate implements APICall {
	public function getPayload(array $credentials) {
		return array(
			'authenticateTestRequest' => array(
				'merchantAuthentication' => $credentials,
			),
		);
	}

	public function processResult(array $result) {
		return $result['messages']['resultCode'] === "Ok";
	}
}
