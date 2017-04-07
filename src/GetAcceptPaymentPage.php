<?php

namespace Mythril\AuthorizeNet;

class GetAcceptPaymentPage implements APICall {
	protected $txRequest;
	protected $settings;
	public function __construct(TransactionRequest $txRequest, HostedPaymentSettings $settings) {
		$this->txRequest = $txRequest;
		$this->settings = $settings;
	}

	public function getPayload(array $credentials) {
		$payload = array(
			'getHostedPaymentPageRequest' => array(
				'merchantAuthentication' => $credentials,
				$this->txRequest->getFieldName() => $this->txRequest->getData(),
				$this->settings->getFieldName() => $this->settings->getData(),
			),
		);

		return $payload;
	}

	public function processResult(array $result) {
		return new AcceptPaymentPage($result);
	}
}
