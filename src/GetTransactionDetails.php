<?php

namespace Mythril\AuthorizeNet;

class GetTransactionDetails implements APICall {
	protected $txId;
	public function __construct($txId) {
		$this->txId = $txId;
	}

	public function getPayload(array $credentials) {
		$payload = array(
			'getTransactionDetailsRequest' => array(
				'merchantAuthentication' => $credentials,
				'transId' => $this->txId,
			),
		);

		return $payload;
	}

	public function processResult(array $result) {
		return $result;
	}
}
