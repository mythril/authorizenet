<?php

namespace Mythril\AuthorizeNet;

class API extends Request{
	protected $name;
	protected $transactionKey;
	protected $sandBox;

	const SANDBOX = 'https://apitest.authorize.net/xml/v1/request.api';
	const LIVE = 'https://api.authorize.net/xml/v1/request.api';

	public function __construct($name, $transactionKey, $sandBox){
		$this->name = $name;
		$this->transactionKey = $transactionKey;
		$this->sandBox = !!$sandBox;
	}

	public function endPoint() {
		return $this->sandBox ? self::SANDBOX : self::LIVE;
	}

	public function execute(APICall $call) {
		$payload = $call->getPayload(array(
			'name' => $this->name,
			'transactionKey' => $this->transactionKey,
		));

		$nobom = ltrim(strval($this->post($this->endPoint(), $payload)), pack('CCC', 0xEF, 0xBB, 0xBF));
		$result = mb_convert_encoding($nobom, "UTF-8");
		$json = json_decode($result, true);
		
		return $call->processResult($json);
	}
}
