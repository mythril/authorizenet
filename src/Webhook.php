<?php

namespace Mythril\AuthorizeNet;

use Exception;

class Webhook {
	protected $apiLogin;
	protected $txKey;
	protected $sandBox;

	const SANDBOX = 'https://apitest.authorize.net/rest/v1/';
	const LIVE = 'https://api.authorize.net/rest/v1/';

	public function __construct($apiLogin, $txKey, $sandBox) {
		$this->apiLogin = $apiLogin;
		$this->txKey = $txKey;
		$this->sandBox = !!$sandBox;
	}

	public function url($url, array $data = null) {
		return ($this->sandBox ? self::SANDBOX : self::LIVE)
				. ltrim($url, '/')
				. (empty($data) ? '' : ('?' . http_build_query($data)));
	}

	protected function request($url, $method, array $data = array()) {
		$c = curl_init();
		$getData = null;

		if (strtolower($method) !== 'get') {
			curl_setopt($c, CURLOPT_CUSTOMREQUEST, strtoupper($method));
			curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept:', 'Expect:', 'Content-Type: application/json'));
			curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($data));
		} else {
			curl_setopt($c, CURLOPT_HTTPGET, true);
			$getData = $data;
		}

		$options = array(
			CURLOPT_URL => $this->url($url, $getData),
			CURLOPT_TIMEOUT => 30,
			CURLOPT_FAILONERROR => 1,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
			CURLOPT_USERPWD => $this->apiLogin . ':' . $this->txKey,
		);

		curl_setopt_array($c, $options);

		$response = curl_exec($c);

		if ($response === false) {
			$code = curl_errno($c);
			$error = curl_error($c);
			curl_close($c);
			throw new Exception("cURL issued an error while trying to contact $url: [$code] $error");
		}

		curl_close($c);

		return $response;
	}

	public function post($url, array $data = array()) {
		return $this->request($url, __FUNCTION__, $data);
	}

	public function get($url, array $data = array()) {
		return $this->request($url, __FUNCTION__, $data);
	}

	public function delete($url, array $data = array()) {
		return $this->request($url, __FUNCTION__, $data);
	}

	public function put($url, array $data = array()) {
		return $this->request($url, __FUNCTION__, $data);
	}
}
